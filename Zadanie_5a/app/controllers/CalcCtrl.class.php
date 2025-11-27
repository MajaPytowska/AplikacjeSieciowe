<?php
require_once 'CalcForm.class.php';
require_once 'CalcResult.class.php';

class CalcCtrl {
    private $form;
    private $result;
    private $hide_header;

    
    public function __construct(){
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

    //Funkcja pobierająca parametry formularza
    private function getParams(){
        $this->form->credit = getFromRequest('credit');
        $this->form->procent = getFromRequest('proc');	
        $this->form->years = getFromRequest('years');
    }

    //Funkcja walidująca parametry formularza. True -> gdy brak błędów, false -> wystąpiły błędy.
    public function validate(){
        // sprawdzenie, czy parametry zostały przekazane
        if ( ! (isset($this->form->credit) && isset($this->form->procent) && isset($this->form->years))) {
            // brak parametrów -> pierwsze wejście formularza lub niepoprawne wywołanie kontrolera - nie reagujemy błędem ponieważ pojawiał by się zawsze po logowaniu
            return false;
        }

        $this->hide_header = true; //ukryj nagłówek strony gdy wartości zostały przesłane

        //sprawdzenie, czy parametry wartości zostały przekazane
        if (isEmptyString($this->form->credit)) {
            getMessages()->addError('Nie podano kwoty kredytu.');
        }
        if (isEmptyString($this->form->years)) {
            getMessages()->addError('Nie podano ilości lat.');
        }

        if(isEmptyString($this->form->procent)){
            getMessages()->addError('Nie podano oprocentowania rocznego.');
        }

        if (getMessages()->isEmpty()) { //sprawdzenie czy są parametry
            
            //sprawdzenie, czy kwota kredytu i ilosc lat są liczbami
            if (!is_numeric($this->form->credit)) {
                getMessages()->addError('Kwota kredytu nie jest liczbą.');
            }

            if(!is_numeric($this->form->years)){
                getMessages()->addError('Liczba lat nie jest liczbą.');
            }

            if(!is_numeric($this->form->procent)){
                getMessages()->addError('Oprocentowanie nie jest liczbą.');
            }
        }
        return getMessages()->isEmpty(); //jeśli brak błędów to zwraca true
    }

    //Funkcja obliczająca ratę kredytu - wynik zapisuje w zmiennej result
    private function calculate(){

        //konwersja parametrów na int
        $this->form->credit = intval($this->form->credit);
        $this->form->years = floatval($this->form->years);
        $this->form->procent = intval($this->form->procent); 
        
        //dodatkowa walidacja danych pod kątem logicznym i zabezpieczeń
        if($this->form->credit <= 0){
            getMessages()->addError('Kwota kredytu musi być większa od 0.');
            return;
        }else if ($this->form->credit > 1000000000000){
            getMessages()->addInfo('Podana kwota kredytu jest bardzo wysoka.');
        }else if($this->form->credit <= 1000){
            getMessages()->addInfo('Podana kwota kredytu jest bardzo niska.');
        }

        if($this->form->years < 0.5 || $this->form->years > 82){ // zakładamy że trzeba mieć min. 18 aby wziąć kredyt, a maksymalny wiek to 100 lat --> 100 - 18 = 82
            getMessages()->addError('Okres kredytowania musi wynosić conajmniej pół roku i być możliwy do zrealizowania w zakresie twojego życia.');
            return;
        }else if(fmod($this->form->years,1) > 0.00001 && fmod($this->form->years,1)-0.5 > 0.00001){ // sprawdzamy czy lata są w formacie całkowitym lub pół roku z uzględnieniem błędu precyzji zmiennych zmiennoprzecinkowych
            getMessages()->addError('Kredyt można wziąć z dokładnością do pół roku.');
            return;
        }

        if($this->form->procent < 5){
           getMessages()->addInfo('Wybrane przez ciebie oprocentowanie jest bardzo niskie.');
        }
        
        //uproszczone oliczenie raty -> (kwota kredytu + oprocentowanie * kwota kredytu * ilość lat)/ilość miesięcy
        //wynik zaokrąglony do dwuch miejsc po przecinku w górę
        $this->result->result_value = ceil(100*$this->form->credit*(1/$this->form->years + $this->form->procent/100)/12)/100;

        if($this->result->result_value > 20000){
            getMessages()->addInfo('Twoja miesięczna rata jest bardzo wysoka.');
        }

        if(getMessages()->isInfo()){
            getMessages()->addInfo('Bank może nie chcieć udzielić ci kredytu na takich warunkach.');
        }
    }

    public function process(){
        $this->getParams();

        if($this->validate()){ //gdy brak błędów można obliczać
            $this->calculate();
        }
        $this->generateView();
    }


    public function generateView(){
        getSmarty()->assign('hide_header',$this->hide_header);
        getSmarty()->assign('page_title','Kalkulator kredytowy');
        getSmarty()->assign('page_description','Oblicz miesięczną ratę swojego kredytu');
        getSmarty()->assign('page_header','Kalkulator kredytowy');
        getSmarty()->assign('form',$this->form);
        getSmarty()->assign('result',$this->result);

        //Wywołanie widoku z przekazaniem zmiennych
        getSmarty()->display('CalcView.tpl');
    }

}


?>