<?php

namespace app\forms;

class AppointmentFilterForm {
	public $dateTimeFrom;
	public $dateTimeTo;
	public $doctorId;
	public $appointmentStatus;

	public function __construct() {
		$this->dateTimeFrom = null;
		$this->dateTimeTo = null;
		$this->doctorId = null;
		$this->appointmentStatus = null;
	}
}
