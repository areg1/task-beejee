<?php

class Model_User extends Model
{   
    protected $table = 'users';
        
    public function get_data($name = '')
	{
        $query = "SELECT * FROM `$this->table` WHERE `name`='$name'";
        $result = $this->conn->query($query);
        $result = mysqli_fetch_assoc($result);

        return $result;
	}
}