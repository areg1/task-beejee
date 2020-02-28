<?php

include ROOT . '/application/models/task.php';

class Controller_Main extends Controller
{

	public $task;
	
	function __construct() 
	{
		parent::__construct();
		$this->task = new Model_Task();
	}

	function action_index()
	{	
		$data = $this->task->get_data();
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}

}