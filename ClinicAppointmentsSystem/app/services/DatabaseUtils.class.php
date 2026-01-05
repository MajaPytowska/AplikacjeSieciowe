<?php
namespace app\services;

use app\transfer\User;
use app\transfer\VisitReason;
use app\transfer\Doctor;
use core\App;
use DateTime;
use app\transfer\Appointment;

class DatabaseUtils{
	public static function DB_toDateTime($datetime_str) {
       $format = 'Y-m-d H:i:s';
       $dateTime = DateTime::createFromFormat($format, $datetime_str);
       return $dateTime;
    }

    public static function DB_DateTimeToString($datetime) {
       $format = 'Y-m-d H:i:s';
       return $datetime->format($format);
    }
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

	public static function getDoctors($includeDescription = false): array{
		$joins = [
			'[><]role_user' => ['iduser' => 'iduser'],
			'[><]role' => ['role_user.idrole' => 'idrole'],
			'[>]doctor_specialization' => ['iduser' => 'iddoctor'],
			'[>]specialization'        => ['doctor_specialization.idspecialization' => 'idspecialization']
		];
		
		$columns = [
			'system_user.iduser(id)',
			'system_user.nameuser(name)',
			'system_user.surname',
			'system_user.photourl(photourl)',
			'specializations' => App::getDB()->raw('GROUP_CONCAT(DISTINCT specialization.namespecialization ORDER BY specialization.namespecialization SEPARATOR \', \')')
		];
		
		if ($includeDescription) {
			$joins['[>]doctorinfo'] = ['iduser' => 'iduser'];
			$columns[] = 'doctorinfo.description';
		}
		
		return array_map(
			function($doctor) { return new Doctor($doctor); },
			App::getDB()->select('system_user', $joins, $columns, [
				'role.namerole' => 'doctor',
				'GROUP' => 'system_user.iduser',
				'role_user.withdrawaldatetime' => null,
				'ORDER' => ['system_user.surname' => 'ASC', 'system_user.nameuser' => 'ASC'],
			])
		);
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

    public static function getPatients(): array{
        return array_map(
            function($patient) { return new User($patient); },
            App::getDB()->select('system_user', [
                '[><]role_user' => ['iduser' => 'iduser'],
                '[><]role' => ['role_user.idrole' => 'idrole'],
                '[>]useraccountstatus(status)' => ['idstatus' => 'idstatus']
            ], [
                'system_user.iduser(id)',
                'system_user.nameuser(name)',
                'system_user.surname',
                'system_user.pesel',
                'status.namestatus(status)'
            ], [
                'role.namerole' => 'patient',
                'role_user.withdrawaldatetime' => null,
                'ORDER' => ['system_user.surname' => 'ASC', 'system_user.nameuser' => 'ASC']
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

    public static function getDoctorsAvailableAppointments($doctorId){
        return array_map(
			function ($appointment) { return new Appointment($appointment);},
			App::getDB()->select('appointment',
			[
				'idappointment(id)',
				'startdatetime(startDatetime)',
				'enddatetime(endDatetime)'
			], [
				'isavailable' => (int)true,
				'iddoctor' => $doctorId,
				'ORDER' => ['startdatetime' => 'ASC']
			]));
    }

	public static function getRoleIdByName($roleName){
		return App::getDB()->get('role', 'idrole', [
				'namerole' => $roleName
			]);
	}
}
