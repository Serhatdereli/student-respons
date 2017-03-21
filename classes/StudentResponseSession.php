<?php

class StudentResponseSession
{
	private $id;
	private $user_id;
	private $created_at;
	private $expires_at;
	private $description;
	private $responses = array();

	public function getID()
	{
		return $this->id;
	}

	public function getCreatedAt()
	{
		return $this->created_at;
	}

	public function getExpiresAt()
	{
		return $this->expires_at;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function isExpired()
	{
		$now = time();
		$expires_ts = strtotime($this->expires_at);
		return ($now > $expires_ts);
	}

	public function getFeedbackLink()
	{
		return '/feedback/' . base64_encode($this->getID() . '__' . $this->getCreatedAt());
	}

	public static function getAllByUser(User $user)
	{
		$db = Database::get();
		$sql = "SELECT * FROM sr_session WHERE user_id=? ORDER BY created_at DESC";
		$st = $db->prepare($sql);
		$sessions = array();
		if ($st->execute(array($user->getID())))
		{
			if ($st->rowCount() > 0)
			{
				while ($row = $st->fetch(PDO::FETCH_ASSOC))
				{
					$session = self::buildByRow($row);
					$sessions[] = $session;
				}
			}
		}
		return $sessions;
	}

	public static function buildByRow($row)
	{
		$session = new self();
		$session->id = $row['session_id'];
		$session->user_id = $row['user_id'];
		$session->created_at = $row['created_at'];
		$session->expires_at = $row['expires_at'];
		$session->description = $row['description'];
		return $session;
	}

	public static function getByID($session_id)
	{
		$db = Database::get();
		$sql = "SELECT * FROM sr_session WHERE session_id=?";
		$st = $db->prepare($sql);
		if ($st->execute(array($session_id)))
		{
			if ($st->rowCount() > 0)
			{
				$row = $st->fetch(PDO::FETCH_ASSOC);
				$session = self::buildByRow($row);
				return $session;
			}
		}
		return null;
	}

	public static function createNew(User $user, $expires_at, $description)
	{
		$db = Database::get();
		$sql = "INSERT INTO sr_session (user_id, created_at, expires_at, description) VALUES (?, NOW(), ?, ?)";
		$st = $db->prepare($sql);
		return $st->execute(array($user->getID(), $expires_at, $description));
	}

	public static function isValidSessionID($session_id)
	{
		$session = self::getByID($session_id);
		if (is_null($session))
		{
			return false;
		}
		return !$session->isExpired();
	}

	public function getResponses()
	{
		return StudentResponseResponse::getAllBySession($this);
	}
}