<?php
require_once dirname(__FILE__).'/../../config.php';

//Funkcja pobierająca parametry logowania
function getLoginParams(&$form){
	$form['login'] = getValueByKey($_REQUEST,'login');
	$form['pass'] = getValueByKey($_REQUEST,'pass');
} 

//Funkcja walidująca dane logowania. True jeśli poprawne, false w przeciwnym wypadku.
function validateLogin(&$form,&$messages){
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($form['login']) && isset($form['pass']))) {
		return false;
	}

	// sprawdzenie, czy wymagane wartości zostały przekazane
	if ( isEmptyString($form['login'])) {
		$messages [] = 'Nie podano loginu';
	}
	if ( isEmptyString($form['pass'])) {
		$messages [] = 'Nie podano hasła';
	}

	//nie ma sensu walidować dalej, gdy brak parametrów
	if (count ( $messages ) > 0) return false;

	// sprawdzenie, poprawności danych logowania
	if ($form['login'] == "admin" && $form['pass'] == "admin") {
		session_start();
		$_SESSION['role'] = 'admin';
		return true;
	}
	if ($form['login'] == "user" && $form['pass'] == "user") {
		session_start();
		$_SESSION['role'] = 'user';
		return true;
	}
	
	$messages [] = 'Niepoprawny login lub hasło';
	return false; 
}

//inicjacja potrzebnych zmiennych
$form = array();
$messages = array();

//pobranie parametrów
getLoginParams($form);

if (!validateLogin($form,$messages)) {
	//w przypadku błędu logowania wyświetl formularz z wiadomościami
	include _ROOT_PATH.'/app/security/login_view.php';
} else { 
	// po poprawnym zalogowaniu przekieruj na stronę główną
	header("Location: "._APP_URL);
}