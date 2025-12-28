<?php

namespace app\transfer;
use core\Utils;

class Appointment{
	public $patientName;
	public $patientSurname;
	public $patientPesel;
	public $doctor;
	public $officeName;
	public $isAvailable;
	public $selfReserved;
	public $startDatetime;
	public $endDatetime;
	
	public function __construct($appointment_tb, $doctor=null){
		if(!$appointment_tb) return;
		$this->patientName = $appointment_tb['name'];
		$this->patientSurname = $appointment_tb['surname'];
		$this->patientPesel = $appointment_tb['pesel'];
		$this->doctor = $doctor;
		$this->officeName = $appointment_tb['officeName'];
		$this->isAvailable = $appointment_tb['isavailable'];
		$this->selfReserved = $appointment_tb['selfReserved'];
		$this->startDatetime = Utils::toDateTime($appointment_tb['startDatetime']);
		$this->endDatetime = Utils::toDateTime($appointment_tb['endDatetime']);
	}	
}