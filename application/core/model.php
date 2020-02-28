<?php

class Model
{
	public static $conn;

	function __construct() 
	{
		$db = require_once('application/config/database.php');
		self::$conn = new mysqli($db['host'], $db['user'], $db['password'], $db['dbname']);
		if(self::$conn->connect_error) {
			die('Data Base connect problem');
		} else {
			mysqli_set_charset(self::$conn,'utf8');
		}			
	}

}