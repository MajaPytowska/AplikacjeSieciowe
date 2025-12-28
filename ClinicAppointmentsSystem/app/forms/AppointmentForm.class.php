<?php
namespace app\forms;
use app\transfer\User;

class AddAppointmentForm {
	public $patientId;
	public $doctorId;
	public $reservationDatetime;
	public $date;
	public $startTime;
	public $endTime;
	public $officeId;
	public $visitReasonId;
	public $customVisitReason;
	 
	public function __construct() {
	}

	public function preload($appointment_tb) {
		if(!$appointment_tb) return;
		$this->patientId = $appointment_tb['patientId'];
		$this->doctorId = $appointment_tb['doctorId'];
		$this->reservationDatetime = $appointment_tb['reservationDatetime'];
		$this->date = $appointment_tb['date'];
		$this->startTime = $appointment_tb['startTime'];
		$this->endTime = $appointment_tb['endTime'];
		$this->officeId = $appointment_tb['officeId'];
		$this->visitReasonId = $appointment_tb['visitReasonId'];
		$this->customVisitReason = $appointment_tb['customVisitReason'];
	}
} 