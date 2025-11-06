<?php
require_once $conf->root_path.'/lib/smarty/libs/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';

class CalcCtrl {
    private $form;
    private $result;
    private $messages;
    private $hide_header;

    
    public function __construct(){
        $this->form = new CalcForm();
        $this->result = new CalcResult();
        $this->messages = new Messages();
    }

    //Funkcja pobierająca parametry formularza
    private function getParams(){
        $this->form->credit = $this->getValueByKey($_REQUEST, 'credit');
        $this->form->procent = $this->getValueByKey($_REQUEST, 'proc');	
        $this->form->years = $this->getValueByKey($_REQUEST, 'years');
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
        if ( $this->isEmptyString($this->form->credit)) {
            $this->messages->addError('Nie podano kwoty kredytu.');
        }
        if ( $this->isEmptyString($this->form->years)) {
            $this->messages->addError('Nie podano ilości lat.');
        }

        if( $this->isEmptyString($this->form->procent)){
            $this->messages->addError('Nie podano oprocentowania rocznego.');
        }

        if ($this->messages->isEmpty()) { //sprawdzenie czy są parametry
            
            //sprawdzenie, czy kwota kredytu i ilosc lat są liczbami
            if (!is_numeric($this->form->credit)) {
                $this->messages->addError('Kwota kredytu nie jest liczbą.');
            }

            if(!is_numeric($this->form->years)){
                $this->messages->addError('Liczba lat nie jest liczbą.');
            }
            //proc nie trzeba sprawdzać ponieważ jest to wartość wybierana z predefiniowanej listy
        }
        return $this->messages->isEmpty(); //jeśli brak błędów to zwraca true
    }

    //Funkcja obliczająca ratę kredytu - wynik zapisuje w zmiennej result
    private function calculate(){

        //konwersja parametrów na int
        $this->form->credit = intval($this->form->credit);
        $this->form->years = floatval($this->form->years);
        $this->form->procent = intval($this->form->procent); 
        
        //dodatkowa walidacja danych pod kątem logicznym i zabezpieczeń
        if($this->form->credit <= 0){
            $this->messages->addError('Kwota kredytu musi być większa od 0.');
            return;
        }else if ($this->form->credit > 1000000000000){
            $this->messages->addInfo('Podana kwota kredytu jest bardzo wysoka.');
        }else if($this->form->credit <= 1000){
            $this->messages->addInfo('Podana kwota kredytu jest bardzo niska.');
        }

        if($this->form->years < 0.5 || $this->form->years > 82){ // zakładamy że trzeba mieć min. 18 aby wziąć kredyt, a maksymalny wiek to 100 lat --> 100 - 18 = 82
            $this->messages->addError('Okres kredytowania musi wynosić conajmniej pół roku i być możliwy do zrealizowania w zakresie twojego życia.');
            return;
        }else if(fmod($this->form->years,1) > 0.00001 && fmod($this->form->years,1)-0.5 > 0.00001){ // sprawdzamy czy lata są w formacie całkowitym lub pół roku z uzględnieniem błędu precyzji zmiennych zmiennoprzecinkowych
            $this->messages->addError('Kredyt można wziąć z dokładnością do pół roku.');
            return;
        }

        if($this->form->procent < 5){
           $this->messages->addInfo('Wybrane przez ciebie oprocentowanie jest bardzo niskie.');
        }
        
        //uproszczone oliczenie raty -> (kwota kredytu + oprocentowanie * kwota kredytu * ilość lat)/ilość miesięcy
        //wynik zaokrąglony do dwuch miejsc po przecinku w górę
        $this->result->result_value = ceil(100*$this->form->credit*(1/$this->form->years + $this->form->procent/100)/12)/100;

        if($this->result->result_value > 20000){
            $this->messages->addInfo('Twoja miesięczna rata jest bardzo wysoka.');
        }

        if($this->messages->isInfo()){
            $this->messages->addInfo('Bank może nie chcieć udzielić ci kredytu na takich warunkach.');
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
        global $conf;
        $smarty = new Smarty\Smarty();
        $smarty->assign('hide_header',$this->hide_header);
        $smarty->assign('conf',$conf);
        $smarty->assign('page_title','Kalkulator kredytowy');
        $smarty->assign('page_description','Oblicz miesięczną ratę swojego kredytu');
        $smarty->assign('page_header','Kalkulator kredytowy');
        $smarty->assign('form',$this->form);
        $smarty->assign('result',$this->result);
        $smarty->assign('messages',$this->messages);

        //Wywołanie widoku z przekazaniem zmiennych
        $smarty->display($conf->root_path.'/app/CalcView.tpl');
    }
    #region Helpers
    // Funkcja zwracająca wartość odpowiadającą wskazanemu kluczowi (lub null jeśli brak) we wskazanej tablicy
    private function getValueByKey($table, $name){
        return isset($table[$name]) ? $table[$name] : null;
    }

    // Funkcja sprawdzająca czy podana wartość jest pustym ciągiem znaków
    private function isEmptyString($x){
        return $x == "";
    }
    #endregion


}


?>