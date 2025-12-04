<?php

use Smarty\Smarty;

require_once 'core/Config.class.php';//załadowanie klasy
$conf = new core\Config();//stworzenie obiektu
include 'config.php'; //przypisanie wartości do właściwości obiektu konfiguracji

//funkcja zwracająca referencję do globalnego obiektu konfiguracji
function &getConf(){ global $conf; return $conf; }

require_once 'core/Messages.class.php';//załadowanie klasy
$messages = new core\Messages();//stworzenie obiektu

//funkcja zwracająca referencję do globalnego obiektu Messages
function &getMessages(){ global $messages; return $messages; }

//rezerwacja zmiennej dla obiektu Smarty
$smarty = null;	

//funkcja zwracająca referencję do globalnego obiektu Smarty (jeśli nie istnieje to go tworzy)
function &getSmarty(){
	global $smarty;
	if (!isset($smarty)){
		
		include_once 'lib/smarty/libs/Smarty.class.php'; // załaduj klasę Smarty
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

require_once 'core/ClassLoader.class.php'; // załadowanie klasy ClassLoader
$classLoader = new core\ClassLoader(); // stworzenie obiektu ClassLoader

//funkcja zwracająca referencję do globalnego obiektu ClassLoader
function &getClassLoader() {
    global $classLoader;
    return $classLoader;
}

require_once 'core/utils.php'; //załadowanie funkcji pomocniczych

session_start(); //inicjalizacja sesji
$conf->roles = getFromSession('_roles') !== null ? unserialize(getFromSession('_roles')) : array(); //wczytanie ról z sesji

$action = getFromRequest('action'); //odczytanie akcji z requestu
