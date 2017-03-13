<?php

function handleIndexPage()
{
	$tpl = Template::create('pages/index.tpl');
	$tpl->display();
}

function handleLoginPage()
{
	$tpl = Template::create('pages/login.tpl');
	$tpl->display();
}

// Feedback pages
function handleFeedbackPage()
{
	echo 'Please enter a valid session ID.';
	exit;
}
function handleFeedbackSessionPage($session_id)
{
	$error_message = Request::getSessionVariable('feedback_error_message');
	Request::deleteSessionVariable('feedback_error_message');

	$feedback_temp_message = Request::getSessionVariable('feedback_temp_message');
	Request::deleteSessionVariable('feedback_temp_message');

	$tpl = Template::create('pages/feedback.tpl');
	$tpl->assign('session_id', $session_id);
	$tpl->assign('error_message', $error_message);
	$tpl->assign('feedback_temp_message', $feedback_temp_message);
	$tpl->display();
}


/** 404 Page **/
function handle404Page()
{
	header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
	$tpl = Template::create('404.tpl');
	$tpl->display();
}

/** Handle Routing **/
function handleRouting(AltoRouter $router)
{	
	$match = $router->match();
	if ($match && is_callable($match['target']))
	{
		call_user_func_array($match['target'], $match['params']);
	}
	else
	{
		handle404Page();
	}
}