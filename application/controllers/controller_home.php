<?php

include ROOT . '/application/models/task.php';

class Controller_Home extends Controller
{

	public $task;
	
	function __construct() 
	{
		parent::__construct();
		$this->task = new Model_Task();
	}

	function action_index()
	{	
		$data['active_page'] = $_GET['page'] ?? 1;
		$count = 3;
		$start = ($data['active_page'] - 1) * 3;
		$data['tasks'] = $this->task->get_data($count, $start);
		$data['pages_count'] = ceil($this->task->get_count() / $count);

		$this->view->generate('main_view.php', 'template_view.php', $data);
	}

}