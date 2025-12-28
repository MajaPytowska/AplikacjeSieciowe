<?php

namespace app\controllers;

use app\forms\AddAppointmentForm;
use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use app\transfer\Doctor;
use app\transfer\Office;
use app\transfer\VisitReason;
use app\transfer\Appointment;
use core\ParamUtils;
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
		$this->appointment = new AddAppointmentForm();
	}
	private function getParams(){
		$appointmentId = ParamUtils::getFromCleanURL(1);
		if($appointmentId != null){
			$this->appointmentId = $appointmentId;

		}

		$this->appointment->patientId = ParamUtils::getFromRequest('patientId');
		$this->appointment->doctorId = ParamUtils::getFromRequest('doctorId');
		$this->appointment->date = ParamUtils::getFromRequest('date');
		$this->appointment->startTime = ParamUtils::getFromRequest('startTime');
		$this->appointment->endTime = ParamUtils::getFromRequest('endTime');
		$this->appointment->officeId = ParamUtils::getFromRequest('officeId');
		$this->appointment->visitReasonId = ParamUtils::getFromRequest('visitReasonId');
		$this->appointment->customVisitReason = ParamUtils::getFromRequest('customVisitReason');
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

	#region Obsługa akcji

	public function action_showEditAppointment(){
		$this->getParams();
		$this->loadDoctors();
		$this->loadOffices();
		$this->loadVisitReasons();
		$this->loadAppointment();
		$this->generateView();
	}

	public function action_updateAppointment(){
		$this->getParams();

	}

	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('appointment', $this->appointment);
		App::getSmarty()->assign('doctors', $this->doctors);
		App::getSmarty()->assign('offices', $this->offices);
		App::getSmarty()->assign('visitReasons', $this->visitReasons);
		App::getSmarty()->assign('page_title','Wizyty');
        App::getSmarty()->assign('page_description','Zarządzanie wizytami');
        App::getSmarty()->assign('page_header','Wizyty');
		App::getSmarty()->display('ScheduleView.tpl');	
	}
}