<?php
namespace app\controllers;
use PDOException;
class CalcTableCtrl{
    private $records;

    public function __construct(){
    }

    public function action_showCalcTable(){
        $this->getDBData();
        $this->generateView();
    }
    public function getDBData(){
        try{
            $this->records = getDB()->select('calculation', [
                'loan',
                'years',
                'procent',
                'result',
                'date'
            ]);
            if(count($this->records) === 0){
                getMessages()->addInfo('Brak rekordów do wyświetlenia');
            }
        } catch (PDOException $e){
            $this->records = null;
            getMessages()->addError('Wystąpił nieoczekiwany błąd podczas pobierania rekordów z bazy danych'. $e->getMessage());
        }
    }
    public function generateView(){
        getNavConfig()->set('Kalkulator','calcShow');
        getSmarty()->assign('page_title','Historia obliczeń');
        getSmarty()->assign('page_description','Tabela przedstawiająca historię obliczeń kredytowych');
        getSmarty()->assign('page_header','Historia obliczeń kredytowych');
        if(isset($this->records)){
            getSmarty()->assign('form',$this->records);
        }

        //Wywołanie widoku z przekazaniem zmiennych
        getSmarty()->display('CalcTableView.tpl');
    }
}