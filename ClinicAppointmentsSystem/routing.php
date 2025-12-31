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
Utils::addRoute('deleteAppointment','ScheduleCtrl', ['receptionist']);
Utils::addRoute('bookAppointment','ScheduleCtrl', ['receptionist', 'patient']);
Utils::addRoute('cancelAppointment','ScheduleCtrl', ['receptionist', 'patient']);

Utils::addRoute('showNewAppointmentForm', 'EditAppointmentCtrl', ['receptionist']);
Utils::addRoute('saveAppointment', 'EditAppointmentCtrl', ['receptionist']);
Utils::addRoute('editAppointment', 'EditAppointmentCtrl', ['receptionist']);

Utils::addRoute('showPredefinedVisitReasonsMan','PredefinedVisitReasonMan', ['receptionist']);
Utils::addRoute('deleteVisitReason','PredefinedVisitReasonMan', ['receptionist']);

Utils::addRoute('showVisitReasonForm','EditVisitReasonCtrl', ['receptionist']);
Utils::addRoute('saveVisitReason','EditVisitReasonCtrl', ['receptionist']);

Utils::addRoute('saveReservation','ReservationCtrl', ['receptionist', 'patient']);
Utils::addRoute('showReservationForm','ReservationCtrl', ['receptionist', 'patient']);

Utils::addRoute('showSelectAppointment','SelectAppointmentCtrl', ['receptionist', 'patient']);
Utils::addRoute('selectAppointment','SelectAppointmentCtrl', ['receptionist', 'patient']);