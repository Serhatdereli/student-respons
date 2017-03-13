<?php

// Enable (1) Disable (0) development mode
define('DEV_MODE', 1); 
if (DEV_MODE)
{
	ini_set('display_errors', DEV_MODE);
	ini_set('display_startup_errors', DEV_MODE);
	error_reporting(E_ALL);
}

// Start the session
session_start();

// Composer autoloader
require $_SERVER['DOCUMENT_ROOT'] . '../../vendor/autoload.php';

// Load custom classes
spl_autoload_register(function ($class_name)
{
	include $_SERVER['DOCUMENT_ROOT'] . '../../classes/' . $class_name . '.php';
});

// Load functions file
require $_SERVER['DOCUMENT_ROOT'] . '../../app/functions.php';