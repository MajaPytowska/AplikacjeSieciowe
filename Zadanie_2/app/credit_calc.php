<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'/app/security/check.php'; // wywołanie bramkarza

//Funkcja pobierająca parametry formularza
function getParams(&$form){
	$form['credit'] = getValueByKey($_REQUEST, 'credit');
	$form['proc'] = getValueByKey($_REQUEST, 'proc');	
	$form['years'] = getValueByKey($_REQUEST, 'years');
}

//Funkcja walidująca parametry formularza. True -> gdy brak błędów, false -> wystąpiły błędy.
function validate(&$form,&$messages){
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($form['credit']) && isset($form['proc']) && isset($form['years']))) {
		// brak parametrów -> pierwsze wejście formularza lub niepoprawne wywołanie kontrolera - nie reagujemy błędem ponieważ pojawiał by się zawsze po logowaniu
		return false;
	}

	//sprawdzenie, czy parametry wartości zostały przekazane
	if ( isEmptyString($form['credit'])) {
		$messages [] = 'Nie podano kwoty kredytu.';
	}
	if ( isEmptyString($form['years'])) {
		$messages [] = 'Nie podano ilości lat.';
	}

	if( isEmptyString($form['proc'])){
		$messages [] = 'Nie podano oprocentowania rocznego.';
	}

	if (empty( $messages )) { //sprawdzenie czy są parametry
		
		//sprawdzenie, czy kwota kredytu i ilosc lat są liczbami
		if (!is_numeric($form['credit'])) {
			$messages [] = 'Kwota kredytu nie jest liczbą.';
		}

		if(!is_numeric($form['years'])){
			$messages [] = 'Liczba lat nie jest liczbą.';
		}
		//proc nie trzeba sprawdzać ponieważ jest to wartość wybierana z predefiniowanej listy
	}
	return (empty ( $messages )); //jeśli brak błędów to zwraca true
}

//Funkcja obliczająca ratę kredytu - wynik zapisuje w zmiennej result
function calculate(&$form,&$messages,&$result){
	global $role;

	//konwersja parametrów na int
	$form['credit'] = intval($form['credit']);
	$form['years'] = intval($form['years']);
	$form['proc'] = intval($form['proc']); 
	
	//dodatkowa walidacja danych pod kątem logicznym i zabezpieczeń
	if($form['credit'] <= 0){
		unset($form['credit']); //usuwamy niepoprawną wartosć alby nie wyświetlała się w formularzu
		$messages [] = 'Kwota kredytu musi być większa od 0.';
		return;
	}
	if($form['years'] <= 0){
		unset($form['years']); //usuwamy niepoprawną wartosć alby nie wyświetlała się w formularzu
		$messages [] = 'Ilosć lat musi być większa od 0.';
		return;
	}
	if($form['proc'] < 5 && $role != 'admin'){
		unset($form['proc']);
		$messages [] = 'Tylko administrator może wybrać oprocentowanie mniejsze niż 5%.';
		return;
	}
	
	//uproszczone oliczenie raty -> (kwota kredytu + oprocentowanie * kwota kredytu * ilość lat)/ilość miesięcy
	//wynik zaokrąglony do dwuch miejsc po przecinku w górę
	$result = ceil(100*$form['credit']*(1/$form['years'] + $form['proc']/100)/12)/100;
}


//inicjacja zmiennych
$form = array();	
$messages = array();
$result = null;

// kontroler
getParams($form);
if ( validate($form,$messages) ) { // gdy brak błędów można obliczać
	calculate($form,$messages,$result);
}

//Wywołanie widoku z przekazaniem zmiennych
include 'credit_calc_view.php';