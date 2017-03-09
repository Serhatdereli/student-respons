<?php

class Database extends PDO
{
	private static $instance = null;

	private $charset = 'utf8';

	public function __construct()
	{
		$this->hostname = 'localhost';
		$this->username = 'student_response';
		$this->database = 'student_response';
		$this->password = 'sr123456!';

		$connect_host = 'mysql:host=' . $this->hostname;
		$connect_host .= ';dbname=' . $this->database;
		$connect_host .= ';charset=' . $this->charset;

		parent::__construct($connect_host, $this->username, $this->password);

		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	//Get function created to create an instance of the database.
	public static function get()
	{
		if (empty(Database::$instance))
		{
			Database::$instance = new Database();
		}
		return Database::$instance;
	}
}