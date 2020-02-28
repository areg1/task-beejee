<?php
include ROOT . '/application/models/task.php';

class Controller_Task extends Controller 
{
    
    function __construct() 
	{
		parent::__construct();
		new Model_Task();
	}

    public function action_create()
    {
        
        $this->view->generate('task_view.php', 'template_view.php');
        $this->resetSessions();
    }

    public function action_store()
    {
        $this->resetSessions();
        $errors = $this->validate();
        $link = getSiteLink();
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            header("Location: {$link}/task/create");
        } else {
            Model_Task::create($_SESSION['name'], $_SESSION['email'], $_SESSION['text']);
            $this->resetSessions();
            $this->resetFilters();
            $_SESSION['created_notification'] = true;

            header("Location: $link");
        }

    }

    public function action_edit()
    {
        $link = getSiteLink();
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($routes);
        $data['task'] = Model_Task::get_by_id($id);
        if ($data['task'] === null) {
            header("Location: {$link}/404");
        } else {
            $this->view->generate('edit-task_view.php', 'template_view.php', $data);
            $this->resetSessions();
        }
    }

    public function action_update()
    {
        $link = getSiteLink();
        if (isset($_SESSION['login'])) {
            $routes = explode('/', $_SERVER['REQUEST_URI']);
            $id = end($routes);
            if (empty($_POST['text'])) {
                $_SESSION['errors'] = ['Text field is required'];
                header("Location: {$link}/task/edit/{$id}");
            } else {
                $text = trim(htmlspecialchars($_POST['text']));
                $status =  $_POST['status'] ? 1 : 0;
                $task = Model_Task::get_by_id($id);
                $adminEdited = $task['text'] !== $text ? 1 : 0;
                Model_Task::update($id, $text, $status, $adminEdited);
                $this->resetSessions();
                header("Location: $link");
            }
        } else {
            $_SESSION['error_notification'] = true;
            header("Location: $link");
        }
    }

    private function resetSessions()
    {
        if( isset($_SESSION['errors']) ) {
            unset($_SESSION['errors']);
        }
        if( isset($_SESSION['email']) ) {
            unset($_SESSION['email']);
        }
        if( isset($_SESSION['name']) ) {
            unset($_SESSION['name']);
        }
        if( isset($_SESSION['text']) ) {
            unset($_SESSION['text']);
        }
    }

    private function resetFilters()
    {
        if( isset($_SESSION['sort_by']) ) {
            unset($_SESSION['sort_by']);
        }
        if( isset($_SESSION['status']) ) {
            unset($_SESSION['status']);
        }
    }

    private function validate()
    {
        $errors = [];
        if (!empty($_POST['email'])) {

            $email = trim(htmlspecialchars($_POST['email']));
            $_SESSION['email'] = $email;
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
            if ($email === false) {
                $errors[] = 'Enter valid email';
            }        
        } else {
            $errors[] = 'Email field is required';
        }

        if (!empty($_POST['name'])) {
            $_SESSION['name'] = trim(htmlspecialchars($_POST['name']));
        } else {
            $errors[] = 'Name field is required';
        }

        if (!empty($_POST['text'])) {
            $_SESSION['text'] = trim(htmlspecialchars($_POST['text']));
        } else {
            $errors[] = 'Text field is required';
        }

        return $errors;
    }

}