<?php
include ROOT . '/application/models/task.php';

class Controller_Task extends Controller 
{
    public $task;
    
    function __construct()
    {
        parent::__construct();
		$this->task = new Model_Task();
    }

    public function action_create()
    {
		$this->view->generate('task_view.php', 'template_view.php');
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