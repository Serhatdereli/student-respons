<?php

class User
{
	private $id;
	private $email;
	private $registered_on;
	private $profile = null;
	private $sessions = null;

	public function getID()
	{
		return $this->id;
	}

	public function getProfile()
	{
		if (is_null($this->profile))
		{
			$this->profile = UserProfile::getByUser($this);
		}
		return $this->profile;
	}

	public function getSessions()
	{
		if (is_null($this->sessions))
		{
			$this->sessions = StudentResponseSession::getAllByUser($this);
		}
		return $this->sessions;
	}

	public static function buildByRow($row)
	{
		$user = new self();
		$user->id = $row['user_id'];
		$user->email = $row['email'];
		$user->registered_on = strtotime($row['registered_on']);
		return $user;
	}

	const SESSION_VARIABLE = 'USER_LOGGEDIN';
	public static function login($email, $password)
	{
		if (!self::emailExists($email))
		{
			throw new Exception('USER_NO_EXISTS');
		}
		$db_hash = self::get_hash_for_email($email);
		if (self::verify_hash($password, $db_hash))
		{
			$USER = self::getByEmail($email);
			// Successful login
			Request::setSessionVariable(self::SESSION_VARIABLE, $USER->getID());
			return true;
		}
		return false;
	}

	public static function isLoggedIn()
	{
		return (Request::getSessionVariable(self::SESSION_VARIABLE) !== null);
	}

	private static function get_hash_for_email($email)
	{
		$db = Database::get();
		$sql = "SELECT hash_pass FROM sr_user WHERE email=?";
		$st = $db->prepare($sql);
		$st->execute(array($email));
		return $st->fetch()['hash_pass'];
	}

	public static function getByID($user_id)
	{
		$db = Database::get();
		$sql = "SELECT * FROM sr_user WHERE user_id=?";
		$st = $db->prepare($sql);
		if ($st->execute(array($user_id)))
		{
			if ($st->rowCount() > 0)
			{
				$row = $st->fetch(PDO::FETCH_ASSOC);
				$user = self::buildByRow($row);
				return $user;
			}
		}
		return null;
	}
	public static function getByEmail($email)
	{
		$db = Database::get();
		$sql = "SELECT * FROM sr_user WHERE email=? LIMIT 1";
		$st = $db->prepare($sql);
		if ($st->execute(array($email)))
		{
			if ($st->rowCount() > 0)
			{
				$row = $st->fetch(PDO::FETCH_ASSOC);
				$user = self::buildByRow($row);
				return $user;
			}
		}
		return null;
	}
	public static function emailExists($email)
	{
		return !is_null(self::getByEmail($email));
	}

	public static function register($email, $password)
	{
		if (self::emailExists($email))
		{
			throw new Exception('EMAIL_EXISTS');
		}
		$db = Database::get();
		$hash_pass = self::hash_password($password);
		$sql = "INSERT INTO sr_user (email, hash_pass) VALUES (?, ?)";
		$st = $db->prepare($sql);
		return $st->execute(array($email, $hash_pass));
	}

	private static function hash_password($password)
	{
		$options = [ 'cost' => 11 ];
		return password_hash($password, PASSWORD_DEFAULT, $options);
	}
	private static function verify_hash($password, $hash)
	{
		return password_verify($password, $hash);
	}
}