<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use app\transfer\Doctor;
use core\ParamUtils;
use app\forms\LoginForm;
use app\transfer\User;
use core\RoleUtils;

class DoctorsGridCtrl{
	private $doctors;
	
	public function __construct(){
		$this->doctors = [];
	}

	private function getDoctorsFromDB() {
		$db_doctors = App::getDB()->select('system_user', [
    		'[><]role_user' => ['iduser' => 'iduser'],
   			'[><]role' => ['role_user.idrole' => 'idrole'],
			'[>]doctor_specialization' => ['iduser' => 'iddoctor'],
			'[>]specialization'        => ['doctor_specialization.idspecialization' => 'idspecialization'],

		], [
    		'system_user.iduser(id)',
    		'system_user.nameuser(name)',
    		'system_user.surname',
    		'system_user.photourl',
			'specializations' => App::getDB()->raw('GROUP_CONCAT(DISTINCT specialization.namespecialization ORDER BY specialization.namespecialization SEPARATOR \',\')')
		], [
    		'role.namerole' => 'doctor',
			'GROUP' => 'system_user.iduser',
			'role_user.withdrawaldatetime' => null, // Tylko aktywni lekarze
			'ORDER' => ['system_user.surname' => 'ASC', 'system_user.nameuser' => 'ASC'],
		]);
		$this->doctors = array_map(function($doctor) { return new Doctor($doctor); }, $db_doctors);
	}
	

	#region Obsługa akcji

	public function action_showDoctorsGrid(){
		$this->getDoctorsFromDB();
		$this->generateView();
	}
	#endregion

	//Funkcja generująca widok
	private function generateView(){
		App::getSmarty()->assign('doctors', $this->doctors);
		App::getSmarty()->assign('page_title','Lekarze');
        App::getSmarty()->assign('page_description','Lista dostępnych lekarzy');
        App::getSmarty()->assign('page_header','Dostępni lekarze');
		App::getSmarty()->display('DoctorsGridView.tpl');	
	}
}