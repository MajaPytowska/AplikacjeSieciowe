<?php
require_once dirname(__FILE__).'/../../config.php';

session_start(); // rozpoczęcie sesji

$role = getValueByKey($_SESSION,'role') ?? ''; // odczytanie roli

//brak roli == użytkownik nie zalogowany --> strona logowania
if ( empty($role) ){
	include _ROOT_PATH.'/app/security/login.php';
	exit(); //zatrzymaj dalsze przetwarzanie skryptów
}
