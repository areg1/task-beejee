<?php
include ROOT . '/application/models/user.php';

class Controller_Auth extends Controller 
{
    function __construct() 
	{
		parent::__construct();
		new Model_User();
	}

    public function action_index()
    {
        if (isset($_SESSION['login'])) {
            $link = getSiteLink();
            header("Location: $link");
        }

        $this->view->generate('login_view.php', 'template_view.php');
        $this->resetSessions();
    }

    public function action_logout()
    {
        if(isset($_SESSION['login'])) {
            unset($_SESSION['login']);
        }

        $link = getSiteLink();
        header("Location: $link");
    }

    public function action_login()
    {
        $this->resetSessions();
        $errors = $this->validate();

        $link = getSiteLink();
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            header("Location: {$link}/auth");
        } else {
            $errors = $this->authValidate();
            if (count($errors) > 0) {
                $_SESSION['errors'] = $errors;
                header("Location: {$link}/auth");
            } else {
                $this->resetSessions();
                $_SESSION['login'] = true;
                header("Location: $link");
            }
        }
    }

    private function authValidate()
    {
        $message = 'Invalid credentials';
        $user = Model_User::getByName($_POST['name']);
        if ($user !== null) {
            if ($user['password'] === $_POST['password']) {
                return [];
            }
        }
        return [$message];
    }


    private function resetSessions()
    {
        if( isset($_SESSION['errors']) ) {
            unset($_SESSION['errors']);
        }
        if( isset($_SESSION['name']) ) {
            unset($_SESSION['name']);
        }
        if( isset($_SESSION['password']) ) {
            unset($_SESSION['password']);
        }
    }

    private function validate()
    {
        $errors = [];       
        if (!empty($_POST['name'])) {
            $_SESSION['name'] = trim(htmlspecialchars($_POST['name']));
        } else {
            $errors[] = 'Name field is required';
        }

        if (!empty($_POST['password'])) {
            $_SESSION['password'] = trim(htmlspecialchars($_POST['password']));
        } else {
            $errors[] = 'Password field is required';
        }

        return $errors;
    }


}