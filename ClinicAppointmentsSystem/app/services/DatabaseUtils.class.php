<?php
namespace app\services;

use app\transfer\User;
use app\transfer\VisitReason;
use core\App;

class DatabaseUtils{
    public static function getVisitReasons(): array{
        return array_map(
		function($visitReason) { return new VisitReason($visitReason); },
		App::getDB()->select('visitreason', [
			'visitreason.idvisitreason(visitReasonId)',
			'visitreason.namevisitreason(visitReasonName)',
			'isenable(isEnable)'
		], [
			'ORDER' => ['visitreason.namevisitreason' => 'ASC']
		]));
    }
    public static function getActivePatients(){
        return array_map(
        function ($user) {return new User($user);},
        App::getDB()->select('system_user', [
            '[>]useraccountstatus(status)' => ['idstatus' => 'idstatus'],
            ], [
                'iduser(id)',
                'nameuser(name)',
                'surname',
                'pesel'
            ], [
                'namestatus' => 'active'
            ])
        );
    }

    public static function cancellAppointment($id){
        App::getDB()->update('appointment', [
			'patientiduser' => null,
			'idvisitreason' => null,
            'reservedbyiduser' => null,
			'customvisitreason' => null,
			'reservationdatetime' => null,
			'isavailable' => true
		], [
			'idappointment' => $id
		]);
    }
}
