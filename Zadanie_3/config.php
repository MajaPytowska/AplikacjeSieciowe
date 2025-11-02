<?php
define('_SERVER_NAME', 'localhost:80');
define('_SERVER_URL', 'http://'._SERVER_NAME);
define('_APP_ROOT', '/Zadanie_3');
define('_APP_URL', _SERVER_URL._APP_ROOT);
define("_ROOT_PATH", dirname(__FILE__));

#region Globalne funkcje pomocnicze
// Funkcja wypisująca wartość parametru jeśli istnieje
function out(&$param){
	if (isset($param)){
		echo $param;
	}
}

// Funkcja zwracająca wartość odpowiadającą wskazanemu kluczowi (lub null jeśli brak) we wskazanej tablicy
function getValueByKey($table, $name){
	return isset($table[$name]) ? $table[$name] : null;
}

// Funkcja sprawdzająca czy podana wartość jest pustym ciągiem znaków
function isEmptyString($x){
	return $x == "";
}
#endregion
?>