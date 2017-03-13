<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/start.php';

$email = 'serhat@student-response.club';
$password = 'serhatsux1234';

try
{
	User::register($email, $password);
}
catch (Exception $ex) {}

$try_pass = 'serhatsux1234';

if (User::login($email, $try_pass))
{
	echo 'LOGGEDIN!';
}
else
{
	echo 'FAILED TO LOGIN';
}

exit;