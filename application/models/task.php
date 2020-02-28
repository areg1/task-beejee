<?php

class Model_Task extends Model 
{
    protected $table = 'tasks';

    public function get_data() 
    {
        $query = "SELECT * FROM `$this->table`";

        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);;
    }
}