<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

//1. pobranie parametrów
$credit = $_REQUEST ['credit'];
$proc = $_REQUEST ['proc'];
$years = $_REQUEST ['years'];

//2. walidacja parametrów z przygotowaniem zmiennych dla widoku

//2.1 sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($credit) && isset($proc) && isset($years))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

//2.2 sprawdzenie, czy parametry wartości zostały przekazane
if ( $credit == "") {
	$messages [] = 'Nie podano kwoty kredytu.';
}
if ( $years == "") {
	$messages [] = 'Nie podano ilości lat.';
}

if( $proc == ""){
	$messages [] = 'Nie podano oprocentowania rocznego.';
}

if (empty( $messages )) { //sprawdzenie czy są parametry
	
	//2.3 sprawdzenie, czy kwota kredytu i ilosc lat są liczbami
	if (!is_numeric($credit)) {
		$messages [] = 'Kwota kredytu nie jest liczbą.';
	}

	if(!is_numeric($years)){
		$messages [] = 'Liczba lat nie jest liczbą.';
	}
	//proc nie trzeba sprawdzać ponieważ jest to wartość wybierana z predefiniowanej listy
}

// 3. obliczenia - wyliczenie miesięcznej raty
if (empty ( $messages )) { //jeśli parametry istnieją i są odpowiednimi liczbami
	
	//3.1 konwersja parametrów na int
	$credit = intval($credit); // zakładamy że bank nie dopuszcza brania kredytów z groszami, więc wartość którą wpisał użytkownik zostanie zaokrąglona jeśli nie była całkowita
	$years = floatval($years); // tak samo w przypadku ilości lat zakłądamy że nie jest zezwalane branie kredytu na ułamek roku
	$proc = intval($proc); // procent wiemy (z widoku) że jest liczbą całkowitą
	
	//dodatkowa walidacja danych pod kątem logicznym
	if($credit <= 0){
		unset($credit); //usuwamy niepoprawną wartosć
		$messages [] = 'Kwota kredytu musi być większa od 0.';
	}
	if($years < 0.5 || $years > 82){ // zakładamy że trzeba mieć min. 18 aby wziąć kredyt, a maksymalny wiek to 100 lat --> 100 - 18 = 82
		unset($years);
		$messages [] = 'Okres kredytowania musi wynosić conajmniej pół roku i być możliwy do zrealizowania w zakresie twojego życia.';
	}else if(fmod($years,1) > 0.00001 && fmod($years,1)-0.5 > 0.00001){ // sprawdzamy czy lata są w formacie całkowitym lub pół roku z uzględnieniem błędu precyzji zmiennych zmiennoprzecinkowych
		//unset($years);
		$messages [] = 'Kredyt można wziąć z dokładnością do pół roku.';
	}
	
	if(empty($messages)){//jeśli walidacja przeszła można przystąpić do obliczeń
		//3.2 uproszczone oliczenie raty -> (kwota kredytu + oprocentowanie * kwota kredytu * ilość lat)/ilość miesięcy
		//wynik zaokrąglony do dwuch miejsc po przecinku w górę
		$result = ceil(100*$credit*(1/$years + $proc/100)/12)/100;
	}

}

// 4. Wywołanie widoku z przekazaniem zmiennych

include 'credit_calc_view.php';
