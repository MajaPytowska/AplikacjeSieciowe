<?php

namespace app\controllers;

use app\transfer\User;
use app\forms\LoginForm;

class LoginCtrl{
	private $form;
	private $hide_header = false;
	
	public function __construct(){
		//stworzenie potrzebnego obiektu
		$this->form = new LoginForm();
	}
	
	 //Funkcja pobierająca parametry formularza
	public function getParams(){
		$this->form->login = getFromRequest('login');
		$this->form->password = getFromRequest('password');
	}
	
	//Funkcja walidująca parametry formularza. True -> gdy brak błędów, false -> wystąpiły błędy.
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
		if (! (isset ( $this->form->login ) && isset ( $this->form->password ))) {
			// brak parametrów -> pierwsze wejście formularza lub niepoprawne wywołanie kontrolera - nie reagujemy błędem
			return false;
		}
		$this->hide_header = true; //ukryj nagłówek strony gdy wartości zostały przesłane
		//sprawdzenie, czy parametry wartości zostały przekazane
		if ($this->form->login == "") {
			getMessages()->addError ( 'Nie podano loginu.' );
		}
		if ($this->form->password == "") {
			getMessages()->addError ( 'Nie podano hasła.' );
		}	

		if ( !getMessages()->isError() ) { //sprawdzenie czy są parametry
		
			// sprawdzenie, czy dane logowania poprawne
			if ($this->form->login == "admin" && $this->form->password == "admin") {

				// nie rozpoczynamy sesji, jest już rozpoczęta w init.php
				$user = new User($this->form->login, 'admin');
				// w sesji nie można przechowywać obiektów, więc serializujemy do stringa
				$_SESSION['user'] = serialize($user);
				// dodaj rolę użytkownikowi (jak wiemy, zapisane też w sesji)
				addRole($user->role);

			} else if ($this->form->login == "user" && $this->form->password == "user") {

				// nie rozpoczynamy sesji, jest już rozpoczęta w init.php
				$user = new User($this->form->login, 'user');
				// w sesji nie można przechowywać obiektów, więc serializujemy do stringa
				$_SESSION['user'] = serialize($user);
				// dodaj rolę użytkownikowi (jak wiemy, zapisane też w sesji)
				addRole($user->role);

			} else {
				getMessages()->addError('Niepoprawny login lub hasło.');
			}
		}
		
		return ! getMessages()->isError();
	}
	
	#region Obsługa akcji

	//Logowanie użytkownika
	public function action_login(){

		$this->getParams();
		
		if ($this->validate()){
			//zalogowany => przekieruj na stronę główną, gdzie uruchomiona zostanie domyślna akcja
			header("Location: ".getConf()->app_url."/");
		} else {
			//niezalogowany => wyświetl stronę logowania
			$this->generateView(); 
		}
		
	}
	
	//Wylogowanie użytkownika
	public function action_logout(){
		// zakończenie sesji rozpoczętej w init.php
		session_destroy();
		$this->generateView();		 
	}
	#endregion

	//Funkcja generująca widok
	public function generateView(){
		set_loginViewParam(true);
		getSmarty()->assign('page_title','Strona logowania');
        getSmarty()->assign('page_description','Wszystko o twojim kredycie w jednym miejscu');
        getSmarty()->assign('page_header','System kredytowy');
		getSmarty()->assign('hide_header',$this->hide_header);
		getSmarty()->assign('form',$this->form);
		getSmarty()->display('LoginView.tpl');		
	}
}