<?php

class Request
{
	// Get User from the request
	public static function getUser()
	{
		global $USER;
		if (is_a($USER, 'User'))
		{
			return $USER;
		}
		return null;
	}

	/* POST */
	public static function getPostVariable($key)
	{
		if (isset($_POST[$key]))
		{
			return $_POST[$key];
		}
		return null;
	}
	public static function setPostVariable($key, $value)
	{
		$_POST[$key] = $value;
	}

	/* SESSION */
	public static function getSessionVariable($key)
	{
		if (isset($_SESSION[$key]))
		{
			return $_SESSION[$key];
		}
		return null;
	}
	public static function setSessionVariable($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	public static function deleteSessionVariable($key)
	{
		unset($_SESSION[$key]);
	}

	/* UTILS */
	public static function redirect($location)
	{
		header('Location: ' . $location);
		exit;
	}
}