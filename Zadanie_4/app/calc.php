<?php
require_once dirname(__FILE__).'/../config.php';

//załadowanie kontrolera
require_once $conf->root_path.'/app/CalcCtrl.class.php';

//stworzenie obiektu i użycie
$ctrl = new CalcCtrl();
$ctrl->process();


