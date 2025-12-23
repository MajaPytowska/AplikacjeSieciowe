<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use core\ParamUtils;
use app\forms\LoginForm;
use app\forms\RegistrationForm;
use app\transfer\User;
use core\RoleUtils;

class RegistrationCtrl{
	private $form;
	
	public function __construct(){
		//stworzenie potrzebnego obiektu
		$this->form = new RegistrationForm();
	}
	
	 //Funkcja pobierająca parametry formularza
	public function getParams(){
		$this->form->isTemporaryUser = ParamUtils::getFromRequest('isTemporaryUser') ?? false;
		$this->form->password = ParamUtils::getFromRequest('password' ,!$this->form->isTemporaryUser,'Hasło wymagane.','password');
		$this->form->user_data->name = ParamUtils::getFromRequest('name', true,'Imię wymagane.','name');
		$this->form->user_data->surname = ParamUtils::getFromRequest('surname', true,'Nazwisko wymagane.','surname');
		$this->form->user_data->pesel = ParamUtils::getFromRequest('pesel', true,'PESEL wymagany.','pesel');

	}
	
	//Funkcja walidująca parametry formularza. True -> gdy brak błędów, false -> wystąpiły błędy.
	public function validate() {
	if (App::getMessages()->isError())
			return false;
		if(!$this->form->isTemporaryUser){
			if ($this->form->password == "") {
				Utils::addErrorMessage('Nie podano hasła.', 'password');
			}
		}
			
		if ($this->form->user_data->name == "") {
			Utils::addErrorMessage('Nie podano imienia.', 'name');
		}
		if ($this->form->user_data->surname == "") {
			Utils::addErrorMessage('Nie podano nazwiska.', 'surname');
		}
		if ($this->form->user_data->pesel == "") {
			Utils::addErrorMessage('Nie podano PESEL.', 'pesel');
		}elseif(!preg_match('/^\d{11}$/', $this->form->user_data->pesel)){
			Utils::addErrorMessage('PESEL musi składać się z 11 cyfr.', 'pesel');
		}
		else{
			$existing_user = App::getDB()->has('system_user',[
				'pesel' => $this->form->user_data->pesel
			]);
			if($existing_user){
				Utils::addErrorMessage('Użytkownik z podanym PESEL już istnieje.', 'pesel');
			}
		}

		return ! App::getMessages()->isError();
	}
	
	#region Obsługa akcji

	//Logowanie użytkownika
	public function action_register(){

		$this->getParams();
		
		if ($this->validate()){
			$password_hash = $this->form->password ? password_hash($this->form->password, PASSWORD_DEFAULT) : " ";
			$role_id = App::getDB()->get('role', 'idrole', [
				'namerole' => $this->form->isTemporaryUser ? 'tmpPatient' : 'patient'
			]);
			$statuses = array_column(App::getDB()->select('useraccountstatus', '*'), 'idstatus', 'namestatus');
			App::getDB()->insert('system_user',[
				'nameuser' => $this->form->user_data->name,
				'surname' => $this->form->user_data->surname,
				'pesel' => $this->form->user_data->pesel,
				'login' => $this->form->user_data->pesel,
				'password' => $password_hash,
				'idstatus' => RoleUtils::inRole('receptionist') ? $statuses['active'] : $statuses['unverified']
			]);

			//przypisanie roli pacjenta
			App::getDB()->insert('role_user',[
				'iduser' => App::getDB()->id(),//ostatnio dodany użytkownik id
				'idrole' => $role_id //pacjent
			]);

			Utils::addInfoMessage('Rejestracja zakończona sukcesem. Możesz się teraz zalogować.');
		}
		$this->generateView();
		
	}
	
	//Wylogowanie użytkownika
	public function action_showRegistrationForm(){
		$this->generateView(); 
	}
	#endregion

	//Funkcja generująca widok
	public function generateView(){
		App::getSmarty()->assign('page_title','Rejestracja');
        App::getSmarty()->assign('page_description','Stwórz konto pacjenta');
        App::getSmarty()->assign('page_header','Zarejestruj się');
		App::getSmarty()->assign('form',$this->form);
		App::getSmarty()->display('RegistrationView.tpl');		
	}
}