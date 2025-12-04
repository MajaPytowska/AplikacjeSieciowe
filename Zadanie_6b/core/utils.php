<?php   

#region Funkcje pobierające wartości z tablic

// uniwersalna funkcja pobierająca wartość z podanego źródła tablicowego
function getFrom(&$source_tab,&$key,&$required,&$required_message){
	if (isset($source_tab[$key])){
		return $source_tab[$key];
	} else {
		if ($required) getMessages()->addError($required_message);
		return null;
	}
}

// funkcja pobierająca wartość z tablicy REQUEST
function getFromRequest($param_name,$required=false,$required_message=null){
	return getFrom($_REQUEST,$param_name,$required,$required_message);
}

// funkcja pobierająca wartość z tablicy GET
function getFromGet($param_name,$required=false,$required_message=null){
	return getFrom($_GET,$param_name,$required,$required_message);
}

// funkcja pobierająca wartość z tablicy POST
function getFromPost($param_name,$required=false,$required_message=null){
	return getFrom($_POST,$param_name,$required,$required_message);
}

// funkcja pobierająca wartość z tablicy COOKIES
function getFromCookies($param_name,$required=false,$required_message=null){
	return getFrom($_COOKIES,$param_name,$required,$required_message);
}

// funkcja pobierająca wartość z tablicy SESSION
function getFromSession($param_name,$required=false,$required_message=null){
	return getFrom($_SESSION,$param_name,$required,$required_message);
}
#endregion

#region Funkcje zarządzające nawigacją
// Funkcja przekierowująca do innej akcji kontrolera (wewnętrznie)
function forwardTo($action_name){
	getRouter()->setAction($action_name);
	include getConf()->root_path."/ctrl.php";
	exit;
}

// Funkcja przekierowująca do innej akcji kontrolera (zewnętrznie)
function redirectTo($action_name){
	header("Location: ".getConf()->action_url.$action_name);
	exit;
}
#endregion

#region Funkcje zarządzające rolami użytkowników

// Dodaje rolę do aktualnej sesji użytkownika
function addRole($role){
	getConf()->roles [$role] = true;
	$_SESSION['_roles'] = serialize(getConf()->roles);
}

//Sprawdza czy aktualny użytkownik ma daną rolę
function inRole($role){
	return isset(getConf()->roles[$role]);
}
#endregion

// Funkcja ustawia zmienną loginView w Smarty w zależności od stanu zalogowania użytkownika
function set_loginViewParam($forced_value = null){
    if($forced_value !== null){
        getSmarty()->assign('loginView', $forced_value);
        return;
    }
    getSmarty()->assign('loginView', !(getFromSession('user') !== null));
}

// Funkcja sprawdzająca czy podana wartość jest pustym ciągiem znaków
function isEmptyString($x){
    return $x == "";
}