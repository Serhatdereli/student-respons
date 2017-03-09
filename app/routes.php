<?php

// Routing is done using AltoRouter
// See more: http://altorouter.com/usage/mapping-routes.html
$router = new AltoRouter();

// map($method, $route, $target, $name = null)

$router->map('GET', '/', 'handleIndexPage', 'index');

$router->map('GET', '/login', 'handleLoginPage', 'login');

$router->map('GET', '/feedback/[:session_id]', 'handleFeedbackPage', 'feedback');

handleRouting($router);