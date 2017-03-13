<?php

// Routing is done using AltoRouter
// See more: http://altorouter.com/usage/mapping-routes.html
$router = new AltoRouter();

// map($method, $route, $target, $name = null)

$router->map('GET', '/', 'handleIndexPage');

$router->map('GET', '/login', 'handleLoginPage');

// Feedback pages
$router->map('GET', '/feedback', 'handleFeedbackPage');
$router->map('GET', '/feedback/[:session_id]', 'handleFeedbackSessionPage');

handleRouting($router);