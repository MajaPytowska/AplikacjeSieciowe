<?php

namespace app\controllers;

use core\App;
use core\SessionUtils;
use core\RoleUtils;
use app\transfer\Doctor;
use app\transfer\Appointment;
use app\forms\ReservationForm;
use app\forms\AppointmentFilterForm;
use app\services\DatabaseUtils;
use app\transfer\Pagination;
use core\Validator;
use core\Utils;
use core\ParamUtils;
use DateTime;
use Smarty\Data;

class ScheduleCtrl{
	private $appointments;
	private $selectedAppointment;
	private $doctors;
	private $isPatient;
	private $form;
	private $viewLimit = 2;
	private $pagination;

	public function __construct(){	
		$this->appointments = [];
		$this->doctors = [];
		$this->isPatient = false;
		$this->form = new AppointmentFilterForm();
		$this->pagination = new Pagination();
	}

	private function getURLParams(){
		$v = new Validator();
		$this->selectedAppointment = Utils::idValidateFromCleanURL($v, 1, true);
	}

	private function getFormParams(){
		$v = new Validator();

		$dateTimeFrom = $v->validateFromRequest('dateTimeFrom', [
			'date_format' => 'd/m/Y H:i',
			'validator_message' => 'Podaj poprawną datę i godzinę początkową - dd/mm/yyyy HH:MM.',
			'default' => null
		]);
		if($dateTimeFrom && $v->isLastOK())
			$this->form->dateTimeFrom = $dateTimeFrom->format('d/m/Y H:i');

		$dateTimeTo = $v->validateFromRequest('dateTimeTo', [
			'date_format' => 'd/m/Y H:i',
			'validator_message' => 'Podaj poprawną datę i godzinę końcową - dd/mm/yyyy HH:MM.',
			'default' => null
		]);
		if($dateTimeTo && $v->isLastOK())
			$this->form->dateTimeTo = $dateTimeTo->format('d/m/Y H:i');

		$doctorId = ParamUtils::getFromRequest('doctorId');
		$this->form->doctorId = $doctorId ? intval($doctorId) : null;

		$status = ParamUtils::getFromRequest('appointmentStatus');
		$this->form->appointmentStatus = $status !== null ? intval($status) : null;
	}

	private function validate(): bool {
		if(App::getMessages()->isError())
			return false;

		if($this->form->dateTimeFrom && $this->form->dateTimeTo) {
			$dateTimeFrom = DateTime::createFromFormat('d/m/Y H:i', $this->form->dateTimeFrom);
			$dateTimeTo = DateTime::createFromFormat('d/m/Y H:i', $this->form->dateTimeTo);

			if($dateTimeFrom >= $dateTimeTo) {
				Utils::addErrorMessage('Data i godzina początkowa musi być wcześniejsza niż data i godzina końcowa.');
				return false;
			}
		}

		return !App::getMessages()->isError();
	}
	
	private function loadAppointments($page = 1){
		$this->isPatient = RoleUtils::inRole('patient');
		$userId = null;
		if($this->isPatient){
			$user = SessionUtils::loadObject('user', true);
			$userId = $user ? $user->id : null;
		}

		$dateTimeFrom = null;
		$dateTimeTo = null;

		if($this->form->dateTimeFrom) {
			$dateTimeFrom = DateTime::createFromFormat('d/m/Y H:i', $this->form->dateTimeFrom);
			$dateTimeFrom = DatabaseUtils::DB_DateTimeToString($dateTimeFrom);
		}

		if($this->form->dateTimeTo) {
			$dateTimeTo = DateTime::createFromFormat('d/m/Y H:i', $this->form->dateTimeTo);
			$dateTimeTo = DatabaseUtils::DB_DateTimeToString($dateTimeTo);
		}
		$hasNextPage = false;
		$this->appointments = DatabaseUtils::getAppointments(
			$this->isPatient ? $userId : null,
			$this->form->doctorId,
			$this->form->appointmentStatus,
			$dateTimeFrom,
			$dateTimeTo,
			$this->viewLimit,
			($page - 1) * $this->viewLimit,
			$hasNextPage
		);
		$this->pagination->currentPage = $page;
		$this->pagination->isPreviousPage = $page > 1;
		$this->pagination->isNextPage = $hasNextPage;
		$this->exstractDoctors();
	}

	private function exstractDoctors(){
		$list = [];
		foreach($this->appointments as $appointment){
			if(isset($list[$appointment->doctor->id])) continue;
			$list[$appointment->doctor->id] = $appointment->doctor;
		}
		$this->doctors = $list;
	}

	#region Obsługa akcji

	public function action_showSchedule(){
		$this->loadAppointments();
		$this->generateView();
	}

	public function action_showSchedulePart(){
		$page = intval(ParamUtils::getFromRequest('page') ?? '1');
		$this->loadAppointments($page);
		$this->generatePartialView();
	}

	public function action_filterAppointments(){
		$this->getFormParams();
		if($this->validate()) {
			$this->loadAppointments();
		}
		$this->generateView();
	}

	public function action_deleteAppointment(){
		$this->getURLParams();
		if($this->selectedAppointment){
			try{
				App::getDB()->delete('appointment',['idappointment'=>$this->selectedAppointment]);
			} catch (\PDOException $e){
				Utils::addErrorMessage("Wystąpił błąd podczas usuwania wizyty.");
			}
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
		App::getSmarty()->assign('form', $this->form);
		App::getSmarty()->assign('pagination', $this->pagination);
		App::getSmarty()->assign('page_title','Wizyty');
		App::getSmarty()->assign('page_description','Zarządzanie wizytami');
        App::getSmarty()->assign('page_description','Zarządzanie wizytami');
        App::getSmarty()->assign('page_header','Wizyty');
		App::getSmarty()->display('ScheduleView.tpl');	
	}
	private function generatePartialView(){
		App::getSmarty()->assign('appointments', $this->appointments);
		App::getSmarty()->assign('pagination', $this->pagination);
		App::getSmarty()->display('ScheduleTable.tpl');	
	}
}