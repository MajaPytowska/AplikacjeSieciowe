<?php

namespace app\controllers;

use core\App;
use core\SessionUtils;
use core\RoleUtils;
use app\transfer\Doctor;
use app\transfer\Appointment;
use app\forms\ReservationForm;
use app\services\DatabaseUtils;
use core\Validator;

class ScheduleCtrl{
	private $appointments;
	private $selectedAppointment;
	private $doctors;
	private $isPatient;
	public function __construct(){	
		$this->appointments = [];
		$this->doctors = [];
		$this->isPatient = false;
	}

	private function getURLParams(){
		$v = new Validator();
		$this->selectedAppointment = $v->validateFromCleanURL(1,[
			'int'=>true,
			'is_numeric'=>true,
			'default'=>null
		]);
	}
	
	private function loadAppointments(){
		$this->isPatient = RoleUtils::inRole('patient');
		$userId = null;
		if($this->isPatient){
			$user = SessionUtils::loadObject('user', true);
			$userId = $user ? $user->id : null;
		}

		$where = [
			'ORDER' => ['appointment.startdatetime' => 'ASC', 'office.nameoffice' => 'ASC']
		];
		if($this->isPatient && $userId !== null){
			$where['appointment.patientiduser'] = $userId;
		}

		$appointments = App::getDB()->select('appointment', [
			'[>]system_user' => ['patientiduser' => 'iduser'],
			'[>]office' => ['appointment.idoffice' => 'idoffice'],
			'[>]visitreason' => ['idvisitreason'=>'idvisitreason']
		], [
			'appointment.idappointment(id)',
			'system_user.nameuser(name)',
			'system_user.surname',
			'system_user.pesel',
			'appointment.reservationdatetime(reservationDatetime)',
			'visitReason' => App::getDB()->raw('CASE WHEN appointment.idvisitreason IS NOT NULL THEN visitreason.namevisitreason ELSE appointment.customvisitreason END'),
			'selfReserved' => App::getDB()->raw('CASE WHEN appointment.reservedbyiduser = appointment.patientiduser THEN 1 ELSE 0 END'),
			'appointment.startdatetime(startDatetime)',
			'appointment.enddatetime(endDatetime)', 
			'appointment.isavailable',
			'appointment.iddoctor(doctorId)',
			'office.nameoffice(officeName)'

		], $where);
		foreach($appointments as &$appointment){
			$this->appointments[] = new Appointment($appointment, $this->doctors[$appointment['doctorId']]);
		}
	}
	private function loadDoctors(){ //przygotowanie pod filtrację
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

	#region Obsługa akcji

	public function action_showSchedule(){
		$this->loadDoctors();
		$this->loadAppointments();
		$this->generateView();
	}

	public function action_deleteAppointment(){
		$this->getURLParams();
		if($this->selectedAppointment){
			App::getDB()->delete('appointment',['idappointment'=>$this->selectedAppointment]);
		}
		App::getRouter()->redirectTo("showSchedule");//usunięcie artefaktów w url
	}

	public function action_bookAppointment(){
		$this->getURLParams();
		if($this->selectedAppointment){
			$reservation = new ReservationForm();
			$reservation->appointmentId = $this->selectedAppointment;
			SessionUtils::storeObject('reservation',$reservation);
		}
		App::getRouter()->redirectTo("showReservationForm"); 
	}

	public function action_cancelAppointment(){
		$this->getURLParams();
		if($this->selectedAppointment){
			DatabaseUtils::cancellAppointment($this->selectedAppointment);
		}
		App::getRouter()->redirectTo("showSchedule");  //usunięcie artefaktów w url
	}
	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('appointments', $this->appointments);
		App::getSmarty()->assign('doctors', $this->doctors);
		App::getSmarty()->assign('isPatient', $this->isPatient);
		App::getSmarty()->assign('page_title','Wizyty');
        App::getSmarty()->assign('page_description','Zarządzanie wizytami');
        App::getSmarty()->assign('page_header','Wizyty');
		App::getSmarty()->display('ScheduleView.tpl');	
	}
}