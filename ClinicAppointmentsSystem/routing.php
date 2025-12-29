<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('login'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('showUserDashboard', 'UserDashboardCtrl');
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl', ['patient', 'receptionist', 'admin']);

Utils::addRoute('showRegistrationForm', 'RegistrationCtrl');
Utils::addRoute('register', 'RegistrationCtrl');

Utils::addRoute('showDoctorsGrid', 'DoctorsGridCtrl');
Utils::addRoute('showDoctorDetails', 'DoctorDetailsCtrl');

Utils::addRoute('showSchedule', 'ScheduleCtrl', ['receptionist']);
Utils::addRoute('showNewAppointmentForm', 'EditAppointmentCtrl', ['receptionist']);
Utils::addRoute('saveAppointment', 'EditAppointmentCtrl', ['receptionist']);
