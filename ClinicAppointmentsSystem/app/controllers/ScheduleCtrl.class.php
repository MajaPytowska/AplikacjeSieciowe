<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use app\transfer\Doctor;
use app\transfer\Appointment;
use core\ParamUtils;
use app\forms\LoginForm;
use app\transfer\User;
use core\RoleUtils;

class ScheduleCtrl{
	private $appointments;
	private $doctors;
	public function __construct(){	
		$this->appointments = [];
		$this->doctors = [];
	}

	private function getParams(){
	}
	
	private function loadAppointments(){
		$appointments = App::getDB()->select('appointment', [
			'[>]system_user' => ['patientiduser' => 'iduser'],
			'[>]office' => ['appointment.idoffice' => 'idoffice']
		], [
			'appointment.idappointment(id)',
			'system_user.login',
			'system_user.nameuser(name)',
			'system_user.surname',
			'system_user.pesel',
			'appointment.apreservationdatetime(reservationDatetime)',
			'selfReserved' => App::getDB()->raw('CASE WHEN appointment.reservedbyiduser = appointment.patientiduser THEN 1 ELSE 0 END'),
			'appointment.startdatetime(startDatetime)',
			'appointment.enddatetime(endDatetime)', 
			'appointment.isavailable',
			'appointment.iddoctor(doctorId)',
			'office.nameoffice(officeName)'

		], [
			'ORDER' => ['appointment.startdatetime' => 'ASC', 'office.nameoffice' => 'ASC']
		]);
		foreach($appointments as &$appointment){
			$this->appointments[] = new Appointment($appointment, $this->doctors[$appointment['doctorId']]);
		}
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

	public function action_showSchedule(){
		$this->getParams();
		$this->loadDoctors();
		$this->loadAppointments();
		$this->generateView();
	}
	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('appointments', $this->appointments);
		App::getSmarty()->assign('doctors', $this->doctors);
		App::getSmarty()->assign('page_title','Wizyty');
        App::getSmarty()->assign('page_description','Zarządzanie wizytami');
        App::getSmarty()->assign('page_header','Wizyty');
		App::getSmarty()->display('ScheduleView.tpl');	
	}
}