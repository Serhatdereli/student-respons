<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/start.php';

// $email = 'serhat@student-response.club';
// $password = 'serhatsux1234';

// try
// {
// 	User::register($email, $password);
// }
// catch (Exception $ex) {}

// $try_pass = 'serhatsux1234';

// if (User::login($email, $try_pass))
// {
// 	echo 'LOGGEDIN!';
// }
// else
// {
// 	echo 'FAILED TO LOGIN';
// }

$user = User::getByEmail('serhat@student-response.club');

// date("Y-m-d H:i:s")
$expires_at = '2017-03-13 23:00:00';
$description = 'This is a test session description';

// StudentResponseSession::createNew($user, $expires_at, $description);

exit;