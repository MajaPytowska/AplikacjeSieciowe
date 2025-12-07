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
		$smarty = new Smarty();	//stworzenie obiektu

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

require_once 'core/Router.class.php'; //załaduj i stwórz router
$router = new core\Router();
function &getRouter(): core\Router {
    global $router; return $router;
}

$db = null; //przygotuj Medoo, twórz tylko raz - wtedy kiedy potrzeba
function &getDB() {
    global $conf, $db;
    if (!isset($db)) {
        require_once 'lib/Medoo/Medoo.class.php';
        $db = new \Medoo\Medoo([
            'database_type' => &$conf->db_type,
            'server' => &$conf->db_server,
            'database_name' => &$conf->db_name,
            'username' => &$conf->db_user,
            'password' => &$conf->db_pass,
            'charset' => &$conf->db_charset,
            'port' => &$conf->db_port,
            'prefix' => &$conf->db_prefix,
            'option' => &$conf->db_option
        ]);
    }
    return $db;
}

require_once 'core/NavConfig.class.php'; //załaduj i stwórz NavConfig
$navConfig = $navConfig = new core\NavConfig();
function &getNavConfig(){
	global $navConfig; return $navConfig;
}

require_once 'core/utils.php'; //załadowanie funkcji pomocniczych

session_start(); //inicjalizacja sesji
$conf->roles = getFromSession('_roles') !== null ? unserialize(getFromSession('_roles')) : array(); //wczytanie ról z sesji

$router->setAction( getFromRequest('action') );