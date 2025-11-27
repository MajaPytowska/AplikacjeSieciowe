<?php

use Smarty\Smarty;

require_once dirname(__FILE__).'/core/Config.class.php';//załadowanie klasy
$conf = new Config();//stworzenie obiektu
include dirname(__FILE__).'/config.php'; //przypisanie wartości do właściwości obiektu konfiguracji

//funkcja zwracająca referencję do globalnego obiektu konfiguracji
function &getConf(){ global $conf; return $conf; }

require_once getConf()->root_path.'/core/Messages.class.php';//załadowanie klasy
$messages = new Messages();//stworzenie obiektu

//funkcja zwracająca referencję do globalnego obiektu Messages
function &getMessages(){ global $messages; return $messages; }

//rezerwacja zmiennej dla obiektu Smarty
$smarty = null;	

//funkcja zwracająca referencję do globalnego obiektu Smarty (jeśli nie istnieje to go tworzy)
function &getSmarty(){
	global $smarty;
	if (!isset($smarty)){
		
		include_once getConf()->root_path.'/lib/smarty/libs/Smarty.class.php'; // załaduj klasę Smarty
		$smarty = new Smarty();	;//stworzenie obiektu

		//przypisanie konfiguracji i messages
		$smarty->assign('conf',getConf());
		$smarty->assign('messages',getMessages());

		//definiuj lokalizację widoków
		$smarty->setTemplateDir(array(
			'one' => getConf()->root_path.'/app/views',
			'two' => getConf()->root_path.'/app/views/templates'
		));
	}
	return $smarty;
}

require_once getConf()->root_path.'/core/utils.php'; //załadowanie funkcji pomocniczych

$action = getFromRequest('action'); //odczytanie akcji z requestu
