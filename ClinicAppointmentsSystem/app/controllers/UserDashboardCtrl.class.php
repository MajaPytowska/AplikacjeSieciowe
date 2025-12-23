<?php

namespace app\controllers;

use core\App;
use core\Message;
use core\Utils;

class UserDashboardCtrl {
    
    public function action_showUserDashboard(){
        App::getSmarty()->assign('page_title','User Dashboard');
        App::getSmarty()->display("main.tpl");
        
    }
    
}
