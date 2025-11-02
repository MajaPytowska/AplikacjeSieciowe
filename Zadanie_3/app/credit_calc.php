<?php
require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/lib/smarty/libs/Smarty.class.php';

//Funkcja pobierająca parametry formularza
function getParams(&$form){
	$form['credit'] = getValueByKey($_REQUEST, 'credit');
	$form['proc'] = getValueByKey($_REQUEST, 'proc');	
	$form['years'] = getValueByKey($_REQUEST, 'years');
}

//Funkcja walidująca parametry formularza. True -> gdy brak błędów, false -> wystąpiły błędy.
function validate(&$form,&$messages, &$hide_header){
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($form['credit']) && isset($form['proc']) && isset($form['years']))) {
		// brak parametrów -> pierwsze wejście formularza lub niepoprawne wywołanie kontrolera - nie reagujemy błędem ponieważ pojawiał by się zawsze po logowaniu
		return false;
	}

	$hide_header = true; //ukryj nagłówek strony gdy wartości zostały przesłane

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
function calculate(&$form,&$messages,&$result, &$infos){

	//konwersja parametrów na int
	$form['credit'] = intval($form['credit']);
	$form['years'] = floatval($form['years']);
	$form['proc'] = intval($form['proc']); 
	
	//dodatkowa walidacja danych pod kątem logicznym i zabezpieczeń
	if($form['credit'] <= 0){
		$form['credit'] = ''; //usuwamy niepoprawną wartosć alby nie wyświetlała się w formularzu
		$messages [] = 'Kwota kredytu musi być większa od 0.';
		return;
	}else if ($form['credit'] > 1000000000000){
		$infos [] = 'Podana kwota kredytu jest bardzo wysoka.';
	}else if($form['credit'] <= 1000){
		$infos [] = 'Podana kwota kredytu jest bardzo niska.';
	}

	if($form['years']< 0.5 || $form['years'] > 82){ // zakładamy że trzeba mieć min. 18 aby wziąć kredyt, a maksymalny wiek to 100 lat --> 100 - 18 = 82
		$messages [] = 'Okres kredytowania musi wynosić conajmniej pół roku i być możliwy do zrealizowania w zakresie twojego życia.';
		return;
	}else if(fmod($form['years'],1) > 0.00001 && fmod($form['years'],1)-0.5 > 0.00001){ // sprawdzamy czy lata są w formacie całkowitym lub pół roku z uzględnieniem błędu precyzji zmiennych zmiennoprzecinkowych
		$messages [] = 'Kredyt można wziąć z dokładnością do pół roku.';
		return;
	}

	if($form['proc'] < 5){
		$infos[] = 'Wybrane przez ciebie oprocentowanie jest bardzo niskie.';
	}
	
	//uproszczone oliczenie raty -> (kwota kredytu + oprocentowanie * kwota kredytu * ilość lat)/ilość miesięcy
	//wynik zaokrąglony do dwuch miejsc po przecinku w górę
	$result = ceil(100*$form['credit']*(1/$form['years'] + $form['proc']/100)/12)/100;

	if($result > 20000){
		$infos[] = 'Twoja miesięczna rata jest bardzo wysoka.';
	}

	if(!empty($infos)){
		$infos[] = 'Bank może nie chcieć udzielić ci kredytu na takich warunkach.';
	}
}


//inicjacja zmiennych
$form = array();	
$messages = array();
$infos = array();
$result = null;
$hide_header = false;

// kontroler
getParams($form);
if ( validate($form,$messages, $hide_header) ) { // gdy brak błędów można obliczać
	calculate($form,$messages,$result, $infos);
}

$smarty = new Smarty\Smarty();
$smarty->assign('hide_header',$hide_header);
$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Kalkulator kredytowy');
$smarty->assign('page_description','Oblicz miesięczną ratę swojego kredytu');
$smarty->assign('page_header','Kalkulator kredytowy');
$smarty->assign('form',$form);
$smarty->assign('result',$result);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);

//Wywołanie widoku z przekazaniem zmiennych
$smarty->display(_ROOT_PATH.'/app/credit_calc_view.html');