<?php

function displayFeedbackError($error_message, $session_id = null)
{
	// 1. Set message error session variable
	Request::setSessionVariable('feedback_error_message', $error_message);
	// 2. Decide where to take the user base on session ID
	$redirect_uri = '/feedback';
	if (!is_null($session_id))
	{
		$redirect_uri .= '/' . $session_id;
	}
	Request::redirect($redirect_uri);
}

function cleanVariable($variable)
{
	$variable = trim($variable);
	$variable = strip_tags($variable);
	return $variable;
}

function formatDate($date_str, $format)
{
	$timestamp = strtotime($date_str);
	return gmdate($format, $timestamp);
}