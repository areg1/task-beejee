<?php

include ROOT . '/application/models/task.php';

class Controller_Home extends Controller
{	
	function __construct() 
	{
		parent::__construct();
		new Model_Task();
	}

	function action_index()
	{	
		if (!isset($_SESSION['sort_by'])) {
			$_SESSION['sort_by'] = 'created_at:desc';
		}
		if (!isset($_SESSION['status'])) {
			$_SESSION['status'] = 'all';
		}
		$segments = explode(':', $_SESSION['sort_by']);
		$sortBy = [
			'name' => $segments[0],
			'type' => $segments[1],
		];
		$data['active_page'] = $_GET['page'] ?? 1;
		$count = 3;
		$start = ($data['active_page'] - 1) * 3;
		$data['tasks'] = Model_Task::get_data($count, $start, $sortBy, $_SESSION['status']);
		$data['pages_count'] = ceil(Model_Task::get_count($_SESSION['status']) / $count);
		$data['sort_by_filter'] = $this->getSortByFilterData();
		$data['sort_by_selected'] = $_SESSION['sort_by'];		
		$data['status_filter'] = $this->getStatusFilterData();
		$data['status_selected'] = $_SESSION['status'];

		$this->view->generate('home_view.php', 'template_view.php', $data);
	}

	function action_filter()
	{
		if(isset($_POST['sort_by_filter'])) {
			$_SESSION['sort_by'] = $_POST['sort_by_filter'];
		}
		if(isset($_POST['status_filter'])) {
			$_SESSION['status'] = $_POST['status_filter'];
		}
		$link = getSiteLink();
		header("Location: $link");
	}

	private function getSortByFilterData()
	{
		return [
			['value' => 'created_at:desc', 'text' => 'Date added: New - Old'],
			['value' => 'created_at:asc', 'text' => 'Date added: Old - New'],
			['value' => 'name:asc', 'text' => 'Name: A - Z'],
			['value' => 'name:desc', 'text' => 'Name: Z - A'],
			['value' => 'email:asc', 'text' => 'Email: A - Z'],
			['value' => 'email:desc', 'text' => 'Email: Z - A'],
		];
	}

	private function getStatusFilterData()
	{
		return [
			['value' => 'all', 'text' => 'All'],
			['value' => '0', 'text' => 'Not performed'],
			['value' => '1', 'text' => 'Performed'],
		];
	}
}