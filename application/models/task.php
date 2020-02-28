<?php

class Model_Task extends Model 
{
    static public function get_data($count, $start, $sortBy, $status) 
    {
        $name = $sortBy['name'];
        $type = $sortBy['type'];
        if ($status!=='all') {
            $query = "SELECT * FROM `tasks` WHERE `status`='$status' ORDER BY `$name` $type LIMIT $count OFFSET $start";
        } else {
            $query = "SELECT * FROM `tasks` ORDER BY `$name` $type LIMIT $count OFFSET $start";
        }
        
        $result = self::$conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function get_count($status) 
    {
        if ($status !== 'all') {
            $query = "SELECT `id` FROM `tasks` WHERE `status`='$status'";
        } else {
            $query = "SELECT `id` FROM `tasks`";
        }
        $result = self::$conn->query($query);
        return  $result->num_rows;
    }

    static public function create($name, $email, $text)
    {
        $query = "INSERT INTO `tasks` (`name`, `email`, `text`) VALUES('$name', '$email', '$text')";
        return self::$conn->query($query);
    }
}

