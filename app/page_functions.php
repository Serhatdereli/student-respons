<?php

function handleIndexPage()
{
	$user = Request::getUser();
	if (!is_a($user, 'User'))
	{
		Request::redirect('/login');
		exit;
	}

	$user_sessions = $user->getSessions();

	$sessions_array = array();
	foreach ($user_sessions as $session)
	{
		$cur_session = array();
		$cur_session['id'] = $session->getID();
		$cur_session['created_at'] = formatDate($session->getCreatedAt(), 'd/m/Y - H:i');
		$cur_session['expires_at'] = formatDate($session->getExpiresAt(), 'd/m/Y - H:i');
		$cur_session['description'] = $session->getDescription();
		$cur_session['tr_css_classs'] = ($session->isExpired()) ? 'expired-session' : 'active-session';
		$cur_session['feedback_link'] = $session->getFeedbackLink();
		$cur_session['happy_pc'] = number_format($session->getHappinessPercentage(), 2);
		$cur_session['responses'] = array();
		foreach ($session->getResponses() as $response)
		{
			$cur_response = array();
			$cur_response['id'] = $response->getID();
			$cur_response['session_id'] = $response->getSessionID();
			$cur_response['created_at'] = $response->getCreatedAt();
			$cur_response['feedback'] = $response->getFeedback();
			$cur_response['sentiment'] = $response->getSentiment();
			$cur_session['responses'][] = $cur_response;
		}
		$sessions_array[] = $cur_session;
	}

	$tpl = Template::create('pages/index.tpl');
	$tpl->assign('sessions', $sessions_array);
	$tpl->display();
}

function handleLoginPage()
{
	if (User::isLoggedIn())
	{
		Request::redirect('/');
		exit;
	}
	$tpl = Template::create('pages/login.tpl');
	$tpl->display();
}

function handleLogout()
{
	Request::redirect('/api/auth.php?logout=1');
	exit;
}

// Stats pages
function handleStatsPage($session_id)
{
	// Does the user own the session id
	// if so display
	// if not redirect back to homepage
	$session = StudentResponseSession::getByID($session_id);
	$responses = $session->getResponses();
	$positive_num = $negative_num = $neutral_num = 0;
	$responses_array = array();
	foreach ($responses as $response)
	{
		$cur_response = array();
		$cur_response['created_at'] = formatDate($response->getCreatedAt(), 'd/m/Y - H:i');
		$cur_response['feedback'] = $response->getFeedback();
		switch ($response->getSentiment())
		{
			case SentimentAnalysis::SENTIMENT_POSITIVE:
				$cur_response['sentiment'] = 'Positive';
				$positive_num++;
				break;
			case SentimentAnalysis::SENTIMENT_NEGATIVE;
				$cur_response['sentiment'] = 'Negative';
				$negative_num++;
				break;
			case SentimentAnalysis::SENTIMENT_NEUTRAL;
				$cur_response['sentiment'] = 'Neutral';
				$neutral_num++;
				break;
		}
		$responses_array[] = $cur_response;
	}
	$tpl = Template::create('pages/stats.tpl');
	$tpl->assign('session_desc', $session->getDescription());
	$tpl->assign('positive_num', $positive_num);
	$tpl->assign('negative_num', $negative_num);
	$tpl->assign('neutral_num', $neutral_num);
	$tpl->assign('responses', $responses_array);
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
	// Decode session ID
	$session_id = base64_decode($session_id);
	$session_id = explode('__', $session_id)[0];

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
function handleFeedbackConfirmationPage()
{
	$tpl = Template::create('pages/feedback-confirmation.tpl');
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