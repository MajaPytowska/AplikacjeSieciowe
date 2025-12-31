<?php

namespace app\controllers;

use app\forms\AppointmentForm;
use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use app\transfer\Doctor;
use app\transfer\Office;
use app\transfer\VisitReason;
use app\transfer\Appointment;
use core\ParamUtils;
use core\Validator;
use app\forms\LoginForm;
use app\transfer\User;
use core\RoleUtils;

class EditAppointmentCtrl{
	private $appointmentId;
	private $appointment;
	private $offices;
	private $visitReasons;
	private $doctors;
	public function __construct(){	
		$this->appointment = new AppointmentForm();
	}
	private function getParams(){
		$v = new Validator();

		$this->appointmentId = $v->validateFromCleanURL(1,[
			'int'=>true,
			'is_numeric' => true,
			'default' => null
		]);

		$this->appointment->doctorId = Utils::intValidateFromRequest($v, 'doctorId', "Wybierz lekarza z listy.");
		$date = $v->validateFromRequest('date', [
			'date_format' => 'd/m/Y',
			'required' => true,
			'required_message' => 'Podaj datę wizyty.',
			'validator_message' => 'Podaj poprawną datę wizyty - dd/mm/yyyy.',
			'default' => null
		]);
		if($date && $v->isLastOK())
			$this->appointment->date = $date->format('d/m/Y');

		$startTime= $v->validateFromRequest('startTime', [
			'date_format' => 'H:i',
			'required' => true,
			'required_message' => 'Podaj godzinę rozpoczęcia wizyty.',
			'validator_message' => 'Podaj poprawną godzinę rozpoczęcia wizyty - HH:MM.',
			'default' => null
		]);
		if($v->isLastOK() && $startTime)
			$this->appointment->startTime = $startTime->format('H:i');

		$endTime = $v->validateFromRequest('endTime', [
			'date_format' => 'H:i',
			'required' => true,
			'required_message' => 'Podaj godzinę zakończenia wizyty.',
			'validator_message' => 'Podaj poprawną godzinę zakończenia wizyty - HH:MM.',
			'default' => null
		]);
		if($endTime && $v->isLastOK())
			$this->appointment->endTime = $endTime->format('H:i');

		$this->appointment->officeId = Utils::intValidateFromRequest($v, 'officeId', "Wybierz gabinet z listy.");
	}

	private function loadAppointment(){
		if(!$this->appointmentId){
			return;
		}
		$db_appointment = App::getDB()->get('appointment', [
			'startdatetime(startDatetime)',
			'enddatetime(endDatetime)', 
			'isavailable',
			'iddoctor(doctorId)',
			'idoffice(officeId)',
			'idvisitreason(visitReasonId)',
			'customvisitreason(customVisitReason)'

		], [
			'idappointment' => $this->appointmentId
		]);
		if($db_appointment){
			$this->appointment->preload($db_appointment);
		}
		
	}

	private function loadOffices(){
		$this->offices = array_map(
		function($office) { return new Office($office); },
		App::getDB()->select('office', [
			'office.idoffice(officeId)',
			'office.nameoffice(officeName)'
		], [
			'ORDER' => ['office.nameoffice' => 'ASC']
		]));
	}
	
	private function loadVisitReasons(){
		$this->visitReasons = array_map(
		function($visitReason) { return new VisitReason($visitReason); },
		App::getDB()->select('visit_reason', [
			'visit_reason.idvisitreason(visitReasonId)',
			'visit_reason.namevisitreason(visitReasonName)'
		], [
			'ORDER' => ['visit_reason.namevisitreason' => 'ASC']
		]));
	}

	private function loadDoctors(){
		$db_doctors = App::getDB()->select('system_user', [
    		'[><]role_user' => ['iduser' => 'iduser'],
   			'[><]role' => ['role_user.idrole' => 'idrole']
		], [
    		'system_user.iduser(id)',
    		'system_user.nameuser(name)',
    		'system_user.surname',
		], [
    		'role.namerole' => 'doctor',
			'GROUP' => 'system_user.iduser',
			'ORDER' => ['system_user.surname' => 'ASC', 'system_user.nameuser' => 'ASC'],
		]);
		foreach($db_doctors as $doctor){
			$this->doctors[$doctor['id']] = new Doctor($doctor);
		}
		
	}

	private function validate(): bool{
		return !App::getMessages()->isError();
	}

	private function process(){ //zwraca true jeśli przetwarzanie się powiodło

		$startDateTime = \DateTime::createFromFormat('d/m/Y H:i', $this->appointment->date . ' ' . $this->appointment->startTime);
		$endDateTime = \DateTime::createFromFormat('d/m/Y H:i', $this->appointment->date . ' ' . $this->appointment->endTime);

		if($startDateTime < new \DateTime('now')){
			Utils::addErrorMessage('Data i godzina wizyty musi być w przyszłości.');
		}elseif($startDateTime >= $endDateTime){
			Utils::addErrorMessage('Godzina zakończenia wizyty musi być późniejsza niż godzina rozpoczęcia wizyty.');
		}else{
			$diff = $startDateTime->diff($endDateTime);
			if(($diff->h * 60 + $diff->i)< 5){
				Utils::addErrorMessage('Wizyta musi trwać co najmniej 5 minut.');
			}elseif(($diff->h * 60 + $diff->i) > 240){
				Utils::addErrorMessage('Wizyta nie może trwać dłużej niż 4 godzin.');
			}
		}

		if(!App::getMessages()->isError()){
			if($this->appointmentId)
			{
				App::getDB()->update('appointment', [
					'startdatetime' => Utils::DB_DateTimeToString($startDateTime),
					'enddatetime' => Utils::DB_DateTimeToString($endDateTime),
					'iddoctor' => $this->appointment->doctorId,
					'idoffice' => $this->appointment->officeId,
					'isavailable' => true
				], [
					'idappointment' => $this->appointmentId
				]);
			}else{
				App::getDB()->insert('appointment', [
					'startdatetime' => Utils::DB_DateTimeToString($startDateTime),
					'enddatetime' => Utils::DB_DateTimeToString($endDateTime),
					'iddoctor' => $this->appointment->doctorId,
					'idoffice' => $this->appointment->officeId,
					'isavailable' => true
				]);
			}
			Utils::addInfoMessage('Pomyślnie zapisano wizytę.');
		}

	}
	#region Obsługa akcji

	public function action_showNewAppointmentForm(){
		$this->loadDoctors();
		$this->loadOffices();
		$this->generateView();
	}

	public function action_editAppointment(){
		$this->getParams();
		$this->loadAppointment();
		$this->loadDoctors();
		$this->loadOffices();
		$this->generateView();
	}

	public function action_saveAppointment(){
		$this->getParams();
		if($this->validate()){
			$this->process();
		}	
		$this->loadDoctors();
		$this->loadOffices();
		$this->generateView();
	}

	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('appointment', $this->appointment);
		App::getSmarty()->assign('appointmentId', $this->appointmentId);
		App::getSmarty()->assign('doctors', $this->doctors);
		App::getSmarty()->assign('offices', $this->offices);
		App::getSmarty()->assign('page_title','Edycja wizyty');
        App::getSmarty()->assign('page_description','Edytuj wizytę w systemie rezerwacji kliniki');
        App::getSmarty()->assign('page_header','Wizyta');
		App::getSmarty()->display('EditAppointmentView.tpl');	
	}
}