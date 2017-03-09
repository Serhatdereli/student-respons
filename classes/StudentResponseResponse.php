<?php

class StudentResponseResponse
{
	private $id;
	private $session_id;
	private $created_at;
	private $feedback;
	private $sentiment;

	public static function getAllBySession(StudentResponseSession $session)
	{
		$db = Database::get();
		$sql = "SELECT * FROM sr_response WHERE session_id=?";
		$st = $db->prepare($sql);
		$st->execute($session->getID());
		$responses = array();
		while ($res = $st->fetch())
		{
			// Build object from row
			// Add to responses array
		}
		return $responses;
	}
}