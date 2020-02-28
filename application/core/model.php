<?php

class Model
{
	public $conn;

	function __construct() 
	{
		$db = require_once('application/config/database.php');
		$this->conn = new mysqli($db['host'], $db['user'], $db['password'], $db['dbname']);
		if($this->conn->connect_error) {
			die('Data Base connect problem');
		} else {
			mysqli_set_charset($this->conn,'utf8');
		}
			
	}
	
	public function get_data()
	{
	}
}