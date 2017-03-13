<?php

class StudentResponseSession
{
	private $id;
	private $created_at;
	private $expires_at;
	private $description;
	private $responses = array();

	public static function getByID($session_id)
	{
		$db = Database::get();
		$sql = "SELECT * FROM sr_session WHERE session_id=?";
		$st = $db->prepare($sql);
		$st->execute(array($session_id));
		$res = $st->fetch(PDO::FETCH_ASSOC);
		// Build the object
		// Return the object
	}

	public static function createNew(User $user, $expires_at, $description)
	{
		$db = Database::get();
		$sql = "INSERT INTO sr_session (user_id, created_at, expires_at, description) VALUES (NOW(), ?, ?)";
		$st = $db->prepare($sql);
		$st->execute(array($user->getID(), $expires_at, $description));
	}

	public static function isValidSessionID($session_id)
	{
		// check if exists
		// check if not expired
		// returns true or false
		return false;
	}

	public function getResponses()
	{
		return StudentResponseResponse::getAllBySession($this);
	}
}