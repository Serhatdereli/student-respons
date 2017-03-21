<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/start.php';

function showResponse($response)
{
	header('Content-type: application/json');
	echo json_encode($response);
	exit;
}

$response = array();
$response['success'] = false;

if ($_GET)
{
	$method = Request::getGetVariable('method');

	switch ($method)
	{
		case 'create':
			// /api/session.php?method=create&expires=1490140473&desc=This%20is%20the%20description%20I%20want.
			// Is User logged in
			$user = Request::getUser();
			if (is_null($user))
			{
				$response['error_code'] = 502;
				$response['message'] = 'You must be logged in to create a session.';
				showResponse($response);
			}
			// Expiry time
			$expiry = Request::getGetVariable('expires');
			if (!is_numeric($expiry))
			{
				$response['error_code'] = 503;
				$response['message'] = 'Invalid expiry time: ' . $expiry;
				showResponse($response);
			}
			if ($expiry < time())
			{
				$response['error_code'] = 504;
				$response['message'] = 'You can not create new sessions expiring in the past: ' . $expiry;
				showResponse($response);
			}
			$expiry = gmdate('Y-m-d H:i:s');
			// Description
			$description = Request::getGetVariable('desc');
			// TODO: Validate description
			if (StudentResponseSession::createNew($user, $expiry, $description))
			{
				$response['success'] = true;
				$response['message'] = 'Created new session for user: ' . $user->getEmail();
			}
			else
			{
				$response['error_code'] = 505;
				$response['message'] = 'Failed to create a new session...';
				showResponse($response);
			}
			break;
		default:
			$response['error_code'] = 501;
			$response['message'] = 'Invalid method provided';
			break;
	}
}

showResponse($response);