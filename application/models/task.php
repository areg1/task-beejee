<?php

class Model_Task extends Model 
{
    protected $table = 'tasks';

    public function get_data($count, $start) 
    {
        $query = "SELECT * FROM `$this->table` Orders LIMIT $count OFFSET $start";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);;
    }

    public function get_count() 
    {
        $query = "SELECT `id` FROM `$this->table`";
        $result = $this->conn->query($query);
        return  $result->num_rows;
    }
}