<?php

namespace core;

// Klasa zarządzająca konfiguracją nawigacji
class NavConfig{
	public $title;
	public $action;
	public $showLogOut;
	
	public function __construct(){	}	

	// Sprawdza czy konfiguracja dodatkowego menu nawigacyjnego jest ustawiona
	public function isNavSet(){
		return isset($this->title) || isset($this->action);
	} 

	// Sprawdza czy obiekt jest pusty
	public function isEmpty(){
		return !isset($this->title) && !isset($this->action) && (!isset($this->showLogOut) || $this->showLogOut === false); 
	}

	// Ustawia konfigurację nawigacji
	public function set($title,$action, $showLogOut = null){
		$this->title = $title;
		$this->action = $action;
		$this->showLogOut = $showLogOut ?? getFromSession('user') !== null;
		getSmarty()->assign('navConfig',$this);
	}

}