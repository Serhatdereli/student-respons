<?php

class User
{

	private $id;
	private $email;
	private $registered_on;
	private $profile = null;

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

	public static function login($username, $password)
	{
		// TODO
	}

	public static function getByID($user_id)
	{
		$db = Database::get();
		$sql = "SELECT * FROM sr_user WHERE user_id=?";
		$st = $db->prepare($sql);
		$st->execute(array($user_id));
		$res = $st->fetch(PDO::FETCH_ASSOC);
		// bUILD object
	}

	public static function register($username, $email, $password)
	{
		$db = Database::get();
		$sql = "INSERT INTO sr_user (email, hash_pass) VALUES (?, ?)";
	}
}