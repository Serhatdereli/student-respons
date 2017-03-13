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

	public static function submitNew($session_id, $feedback_message) 
	{
		$session = StudentResponseSession::getByID($session_id);
		if (is_null($session))
		{
			throw new Exception('SESSION_NO_EXISTS');
		}
		$sentiment = SentimentAnalysis::analyseText($feedback_message);
		$db = Database::get();
		$sql = "INSERT INTO sr_response (created_at, feedback, sentiment, session_id) VALUES (NOW(),?,?,?)";
		$st = $db->prepare($sql);
		return $st->execute(array($feedback_message, $sentiment, $session_id));
	}
}