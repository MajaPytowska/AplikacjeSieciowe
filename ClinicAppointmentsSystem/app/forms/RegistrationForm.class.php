<?php
namespace app\forms;
use app\transfer\User;

class RegistrationForm {
	public $user_data; //type User
	public $isTemporaryUser;
	public $password;

	public function __construct() {
		$this->user_data = new User(null);
		$this->isTemporaryUser = false;
	}
} 