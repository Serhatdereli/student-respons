<?php

class StudentResponseResponse
{
	private $id;
	private $session_id;
	private $created_at;
	private $feedback;
	private $sentiment;

	public function getID()
	{
		return $this->id;
	}

	public function getSessionID()
	{
		return $this->session_id;
	}

	public function getCreatedAt()
	{
		return $this->created_at;
	}

	public function getFeedback()
	{
		return $this->feedback;
	}

	public function getSentiment()
	{
		return $this->sentiment;
	}

	public static function getAllBySession(StudentResponseSession $session)
	{
		$db = Database::get();
		$sql = "SELECT * FROM sr_response WHERE session_id=?";
		$st = $db->prepare($sql);
		$responses = array();
		if ($st->execute(array($session->getID())))
		{
			if ($st->rowCount() > 0)
			{
				while ($row = $st->fetch(PDO::FETCH_ASSOC))
				{
					$response = self::buildByRow($row);
					$responses[] = $response;
				}
			}
		}
		return $responses;
	}

	public static function buildByRow($row)
	{
		$session = new self();
		$session->id = $row['response_id'];
		$session->session_id = $row['session_id'];
		$session->created_at = $row['created_at'];
		$session->feedback = $row['feedback'];
		$session->sentiment = $row['sentiment'];
		return $session;
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