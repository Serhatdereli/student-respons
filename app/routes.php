<?php

// Routing is done using AltoRouter
// See more: http://altorouter.com/usage/mapping-routes.html
$router = new AltoRouter();

// map($method, $route, $target, $name = null)

$router->map('GET', '/', 'handleIndexPage');

$router->map('GET', '/login', 'handleLoginPage');
$router->map('GET', '/logout', 'handleLogout');

// Feedback pages
$router->map('GET', '/feedback', 'handleFeedbackPage');
$router->map('GET', '/feedback/[:session_id]', 'handleFeedbackSessionPage');
$router->map('GET', '/confirmation', 'handleFeedbackConfirmationPage');

handleRouting($router);