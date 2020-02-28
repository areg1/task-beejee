<?php

class Model_Task extends Model 
{
    protected $table = 'tasks';

    public function get_data($count, $start, $sortBy, $status) 
    {
        $name = $sortBy['name'];
        $type = $sortBy['type'];
        if ($status!=='all') {
            $query = "SELECT * FROM `$this->table` WHERE `status`='$status' ORDER BY `$name` $type LIMIT $count OFFSET $start";
        } else {
            $query = "SELECT * FROM `$this->table` ORDER BY `$name` $type LIMIT $count OFFSET $start";
        }
        
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_count($status) 
    {
        if ($status !== 'all') {
            $query = "SELECT `id` FROM `$this->table` WHERE `status`='$status'";
        } else {
            $query = "SELECT `id` FROM `$this->table`";
        }
        $result = $this->conn->query($query);
        return  $result->num_rows;
    }
}

