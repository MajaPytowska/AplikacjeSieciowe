<?php
require_once 'init.php';

//Przełącznik
switch ($action) {
	default : // bez parametrowe wywołanie 
		//stworzenie obiektu i użycie
        $ctrl = new app\controllers\CalcCtrl(); // klasa CalcCtrl w przestrzeni nazw app\controllers
        $ctrl->process();
	break;
	case 'CalcCalculate' :
		//stworzenie obiektu i użycie
        $ctrl = new app\controllers\CalcCtrl();
        $ctrl->process();
	break;
}
