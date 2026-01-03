<?php

namespace app\controllers;

use core\App;
use app\transfer\Doctor;
use core\Utils;
use core\Validator;
use app\services\DatabaseUtils;

class DoctorsManCtrl{
    private $selectedDoctor;
    private $doctors;

    public function __construct(){
        $this->doctors = [];
    }

    private function getURLParams(){
        $v = new Validator();

        $this->selectedDoctor = $v->validateFromCleanURL(1,[
            'int'=>true,
            'is_numeric' => true,
            'default' => null
        ]);
    }

    private function loadDoctors(){
        $this->doctors = DatabaseUtils::getDoctors();
    }
    
    #region Obsługa akcji

    public function action_showDoctorsMan(){
        $this->loadDoctors();
        $this->generateView();
    }

    public function action_deleteDoctor(){
        $this->getURLParams();
        if($this->selectedDoctor){
            // Sprawdź czy ma umówione (zarezerwowane) wizyty
            $reserved = App::getDB()->count('appointment', [
                'iddoctor' => $this->selectedDoctor,
                'isavailable' => 0
            ]);
            if($reserved > 0){
                Utils::addErrorMessage("Lekarz ma umówione wizyty - najpierw musisz anulować te wizyty");
                $this->action_showDoctorsMan();
                return;
            }

            // Usuń zaplanowane, ale dostępne wizyty tego lekarza
            App::getDB()->delete('appointment', [
                'iddoctor' => $this->selectedDoctor,
                'isavailable' => 1
            ]);

            App::getDB()->delete('doctorinfo',['iduser'=>$this->selectedDoctor]);
            App::getDB()->delete('doctor_specialization',['iddoctor'=>$this->selectedDoctor]);
            App::getDB()->delete('role_user',['iduser'=>$this->selectedDoctor]);
            App::getDB()->delete('system_user',['iduser'=>$this->selectedDoctor]);
        }
        App::getRouter()->redirectTo("showDoctorsMan");
    }

    #endregion

    //Funkcja generująca widok
    private function generateView(){
        App::getSmarty()->assign('doctors', $this->doctors);
        App::getSmarty()->assign('page_title','Zarządzanie lekarzami');
        App::getSmarty()->assign('page_description','Lista lekarzy');
        App::getSmarty()->assign('page_header','Lekarze');
        App::getSmarty()->display('DoctorsManView.tpl');    
    }
}
