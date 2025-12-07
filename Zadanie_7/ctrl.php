<?php
require_once 'init.php';

getRouter()->setDefaultRoute('calcShow'); // akcja/ścieżka domyślna
getRouter()->setLoginRoute('login'); // akcja/ścieżka na potrzeby logowania (przekierowanie, gdy nie ma dostępu)

// podpięcie akcji do kontrolerów
getRouter()->addRouteExplicit('calcShow','CalcCtrl','generateView',  ['user','admin']);
getRouter()->addRouteExplicit('calcCalculate','CalcCtrl','process',  ['user','admin']);
getRouter()->addRoute('login','LoginCtrl');
getRouter()->addRoute('logout','LoginCtrl', ['user','admin']);
getRouter()->addRoute('showCalcTable', 'CalcTableCtrl', ['admin']);

// uruchomienie routingu (kontrolera)
getRouter()->go();