<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/start.php';

if ($_POST)
{
	$session_id = Request::getPostVariable('session-id');
	// 1. Check if there is a session ID is_null()
	// 2. Check if session ID exists
	// 3. Check if session is not expired StudentResponseSession::isValidSessionID($session_id) [step 2 and 3]
	// 4. Everything OK
	$feedback_message = Request::getPostVariable('feedback-message');
	// 1. Check if there is a feedback message is_null()
	// 2. Check if within limits (0 - 200)
	// 3. Everything OK

	// === SUBMIT THE RESPONSE
	// 1. StudentResponseResponse::submitNew($session_id, $feedback_message)
	// 2. Done - Send to confirmation page
}

Request::setSessionVariable('feedback_error_message', 'THIS IS A SERIOUS ERROR');
Request::redirect('/feedback/' . $session_id);