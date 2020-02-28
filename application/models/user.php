<?php

class Model_User extends Model
{           
    public static function getByName($name = '')
	{
        $query = "SELECT * FROM `users` WHERE `name`='$name' LIMIT 1";
        $result = self::$conn->query($query);
        $result = $result->fetch_assoc();
        return $result;
	}
}