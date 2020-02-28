<?php

class Model_User extends Model
{           
    static public function getByName($name = '')
	{
        $query = "SELECT * FROM `users` WHERE `name`='$name' LIMIT 1";
        $result = self::$conn->query($query);
        $result = mysqli_fetch_assoc($result);
        return $result;
	}
}