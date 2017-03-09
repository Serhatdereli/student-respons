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