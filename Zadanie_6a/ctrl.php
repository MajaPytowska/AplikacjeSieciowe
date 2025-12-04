<?php
require_once 'init.php';

getConf()->login_action = 'login';

//Przełącznik
switch ($action) {
	default :
		control('CalcCtrl',	'generateView', ['user','admin']); // skozystanie z domyślnej przestrzeniu nazw 
	case 'login': 
		control('LoginCtrl', 'doLogin');
	case 'calcCalculate' : 
		control('CalcCtrl',	'process',['user','admin']);
	case 'logout' : 
		control('LoginCtrl','doLogout',['user','admin']);
}