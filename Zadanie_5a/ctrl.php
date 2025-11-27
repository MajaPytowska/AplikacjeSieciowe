<?php
require_once 'init.php';

//Przełącznik
switch ($action) {
	default : // bez parametrowe wywołanie 
	    //załadowanie kontrolera
		include_once 'app/controllers/CalcCtrl.class.php';

		//stworzenie obiektu i użycie
        $ctrl = new CalcCtrl();
        $ctrl->process();
	break;
	case 'CalcCalculate' :
		//załadowanie kontrolera
		include_once 'app/controllers/CalcCtrl.class.php';

		//stworzenie obiektu i użycie
        $ctrl = new CalcCtrl();
        $ctrl->process();
	break;
}
