<?php    
    // Funkcja zwracająca wartość odpowiadającą wskazanemu kluczowi (lub null jeśli brak) we wskazanej tablicy
    function getValueByKey($table, $name){
        return isset($table[$name]) ? $table[$name] : null;
    }

    // Funkcja pobierająca wartość parametru z tablicy REQUEST
    function getFromRequest($param_name){
	    return isset($_REQUEST [$param_name]) ? $_REQUEST [$param_name] : null;
    }

    // Funkcja sprawdzająca czy podana wartość jest pustym ciągiem znaków
    function isEmptyString($x){
        return $x == "";
    }