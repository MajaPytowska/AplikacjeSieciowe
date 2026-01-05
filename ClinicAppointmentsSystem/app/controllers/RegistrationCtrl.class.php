<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use app\forms\RegistrationForm;
use core\Validator;
use app\services\DatabaseUtils;
use core\RoleUtils;
use Smarty\Data;

class RegistrationCtrl{
	private $form;
	
	public function __construct(){
		//stworzenie potrzebnego obiektu
		$this->form = new RegistrationForm();
	}
	
	 //Funkcja pobierająca parametry formularza
	public function getParams(){
		$v = new Validator();

		$this->form->isTemporaryUser = ParamUtils::getFromRequest('isTemporaryUser') ? true : false;

		// Hasło: min 8 znaków, co najmniej 1 wielka litera i 1 cyfra
		$this->form->password = Utils::stringValidateFromRequest(
			$v,
			'password',
			!$this->form->isTemporaryUser,
			'Hasło wymagane.',
			'Hasło musi mieć min. 8 znaków oraz zawierać co najmniej jedną wielką literę i jedną cyfrę.',
			'/^(?=.*[A-Z])(?=.*\d).{8,}$/'
		);

		// Potwierdzenie hasła
		$this->form->password_confirm = ParamUtils::getFromRequest('confirm_password');
		if (!$this->form->isTemporaryUser && $this->form->password !== $this->form->password_confirm) {
			Utils::addErrorMessage('Hasła się nie zgadzają.');
		}

		// Imię i nazwisko: tylko litery, pierwsza wielka litera
		$this->form->user_data->name = Utils::nameValidateFromRequest($v, 'name', true);
		$this->form->user_data->surname = Utils::surnameValidateFromRequest($v, 'surname', true);

		// PESEL: 11 cyfr
		$this->form->user_data->pesel = Utils::stringValidateFromRequest(
			$v,
			'pesel',
			true,
			'PESEL wymagany.',
			'PESEL musi składać się z 11 cyfr.',
			'/^\d{11}$/'
		);

	}
	
	//Funkcja walidująca parametry formularza. True -> gdy brak błędów, false -> wystąpiły błędy.
	public function validate() {
	    if (App::getMessages()->isError())
            return false;

        // Unikalność PESEL tylko gdy brak wcześniejszych błędów walidacji
        $existing_user = App::getDB()->has('system_user', [
            'pesel' => $this->form->user_data->pesel
        ]);
        if($existing_user){
            Utils::addErrorMessage('Użytkownik z podanym PESEL już istnieje.', 'pesel');
        }

        return ! App::getMessages()->isError();
	}
	
	#region Obsługa akcji

	public function action_register(){

		$this->getParams();
		
		if ($this->validate()){
			$password_hash = $this->form->password ? password_hash($this->form->password, PASSWORD_DEFAULT) : " ";
			$role_id = DatabaseUtils::getRoleIdByName('patient');

			$statuses = array_column(App::getDB()->select('useraccountstatus', '*'), 'idstatus', 'namestatus');
			App::getDB()->insert('system_user',[
				'nameuser' => $this->form->user_data->name,
				'surname' => $this->form->user_data->surname,
				'pesel' => $this->form->user_data->pesel,
				'login' => $this->form->user_data->pesel,
				'password' => $password_hash,
				'idstatus' => RoleUtils::inRole('patient') ?  $statuses['unverified'] : $statuses['active'] 
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