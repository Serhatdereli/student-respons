<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/start.php';

if ($_POST)
{
	// Log in
	if (isset($_POST['login-btn']))
	{
		// Validate inputs
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Validate email
		// Validate password

		if (User::login($email, $password))
		{
			Request::redirect('/');
			exit;
		}
	}
}

if ($_GET)
{
	// Log out
	if (isset($_GET['logout']) && $_GET['logout'] == 1)
	{
		session_destroy();
		Request::redirect('/');
		exit;
	}
}

Request::redirect('/');
exit;