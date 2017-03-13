<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/start.php';

$session_OK = $feedback_OK = false;

if ($_POST)
{
	$session_id = Request::getPostVariable('session-id');
	// 1. Check if there is a session ID
	if (is_null($session_id))
	{
		displayFeedbackError('');
	}
	// 2. Check if session is valid
	if (!StudentResponseSession::isValidSessionID($session_id))
	{
		displayFeedbackError('The provided session ID is no longer valid.', $session_id);
	}
	$session_OK = true;

	$feedback_message = Request::getPostVariable('feedback-message');
	// 1. Check if there is a feedback message
	$feedback_message = cleanVariable($feedback_message);
	Request::setSessionVariable('feedback_temp_message', $feedback_message);
	if (empty($feedback_message))
	{
		displayFeedbackError('Please enter a feedback message.', $session_id);
	}
	// 2. Check if within limits (0 - 200)
	$feedback_len = strlen($feedback_message);
	if ($feedback_len < 10 || $feedback_len > 200)
	{
		displayFeedbackError('Your feedback message must be within 10 to 200 characters.', $session_id);
	}
	$feedback_OK = true;
}

if ($session_OK && $feedback_OK)
{
	echo 'OK TO SUBMIT'; exit;
	// === SUBMIT THE RESPONSE
	// 1. StudentResponseResponse::submitNew($session_id, $feedback_message)
	// 2. Done - Send to confirmation page
}

displayFeedbackError('An unknown error occured, please contact the web admin.', $session_id);