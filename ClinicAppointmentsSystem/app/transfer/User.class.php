<?php

namespace app\transfer;

class User{
	public $login;
	public $name;
	public $surname;
	public $pesel;
	
	public function __construct($user_tb){
		if(!$user_tb) return;
		$this->login = $user_tb['login'];
		$this->name = $user_tb['name'];
		$this->surname = $user_tb['surname'];
		$this->pesel = $user_tb['pesel'];	
	}	
}