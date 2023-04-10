<?php 

    require_once("Models/UserModel.php");
    require_once("Views/UserView.php");

    class UserController
    {
        private $model,$view;
        const MIN_CHARS = 8;

        function __construct()
        {
            $this->model = new UserModel();
            $this->view = new UserView();
        }

        function loginForm()
        {
            $this->view->renderLoginForm();
        }

        function login()
        {
            $errors = array();
            $email = $password = "";

            if(empty($_POST['email']))
            {
                $errors["email"] = "Email is required!";
            }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $errors["email"] = "Email is invalid!";
            }else if(!$this->isExistEmail($_POST['email']))
            {
                $errors["email"] = "Email does not exist!";
            }else 
            {
                $email = $this->sanitizeInput($_POST['email']);
            }

            if(empty($_POST['password']))
            {
                $errors["password"] = "Password is required!";
            }else 
            {
                $password = $this->sanitizeInput($_POST['password']);
            }

            if(count($errors) > 0)
            {
                $this->view->renderLoginForm($errors);
            } else 
            {
                $result = $this->model->getAccount($email);
                if($result["row-count"] == 1)
                {
                    if(password_verify($password,$result["user"]["password"]))
                    {
                        $_SESSION["name"] = $result["user"]["name"];
                        header("Location: home.php");
                    }else 
                    {
                        $errors["password"] = "Incorrect password"; 
                        $this->view->renderLoginForm($errors);
                    }
                }
            }
        }

        function registrationForm()
        {
            $this->view->renderRegistrationForm();
        }

        function register()
        {
            $errors = array();
            $name = $email = $password = "";

            if(empty($_POST['name']))
            {
                $errors["name"] = "Name is required!";
            }else if(!preg_match ("/^([a-zA-Z' ]+)$/",$_POST['name']))
            {
                $errors["name"] = "Name is invalid!";
            }else 
            {
                $name = $this->sanitizeInput($_POST['name']);
            }

            if(empty($_POST['email']))
            {
                $errors["email"] = "Email is required!";
            }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $errors["email"] = "Email is invalid!";
            }else 
            {
                $email = $this->sanitizeInput($_POST['email']);
            }

            if(empty($_POST['password']))
            {
                $errors["password"] = "Password is required!";
            }else if(strlen($_POST['password']) < self::MIN_CHARS)
            {
                $errors["password"] = "Password should be atleast 8 charactes!";
            }else if($_POST['password'] != $_POST['cpassword'])
            {
                $errors["password"] = "Confirm password doesn't match!";
            }else 
            {
                $password = $this->sanitizeInput($_POST['password']);
                $password = password_hash($password, PASSWORD_BCRYPT);
            }

            if(count($errors) > 0)
            {
                $this->view->renderRegistrationForm($errors);
            } else 
            {
                $this->model->registerAccount($name,$email,$password);
                header("Location: index.php");
            }
        }

        function logout()
        {
            session_destroy();
            header("Location: index.php");
        }

        private function sanitizeInput($input)
        {
            $input = trim($input);
            $input = stripcslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        private function isExistEmail($email)
        {
            $result = $this->model->getAccount($email);
            if($result["row-count"] >= 1)
            {
               return true;
               exit();
            }
            return false;
        }
    }
?>