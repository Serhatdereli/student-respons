<?php

class UserProfile
{
	private $id;
	private $first_name;
	private $last_name;

	public static function getByUser(User $user)
	{
		$db = Database::get();
		$sql = "SELECT * FROM sr_profile WHERE user_id=?";
		$st = $db->prepare($sql);
		$st->execute(array($user->getID()));
		if ($st->rowCount() === 0)
		{
			if (self::createNewForUser($user))
			{
				return self::getByUser($user);
			}
		}
		// Profile? - return it
	}

	private static function createNewForUser(User $user, $first_name = '', $last_name = '')
	{
		$db = Database::get();
		$sql = "INSERT INTO sr_profile (user_id, first_name, last_name) VALUES (?, ?, ?)";
		$st = $db->prepare($sql);
		return $st->execute(array($user->getID(), $first_name, $last_name));
	}
}