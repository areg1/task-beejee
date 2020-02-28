<?php

class Model_Task extends Model 
{
    public static function get_data($count, $start, $sortBy, $status) 
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

    public static function get_by_id($id)
    {
        $query = "SELECT * FROM `tasks` WHERE `id`='$id'";
        $result = self::$conn->query($query);
        $result = $result->fetch_assoc();
        return $result;
    }

    public static function update($id, $text, $status, $adminEdited)
    {
        $query = "UPDATE `tasks` SET `text`='$text', `status`='$status', `admin_edited`='$adminEdited' WHERE `id`='$id'";
        $result = self::$conn->query($query);
        return $result;
    }

    public static function get_count($status) 
    {
        if ($status !== 'all') {
            $query = "SELECT `id` FROM `tasks` WHERE `status`='$status'";
        } else {
            $query = "SELECT `id` FROM `tasks`";
        }
        $result = self::$conn->query($query);
        return  $result->num_rows;
    }

    public static function create($name, $email, $text)
    {
        $query = "INSERT INTO `tasks` (`name`, `email`, `text`) VALUES('$name', '$email', '$text')";
        return self::$conn->query($query);
    }
}

