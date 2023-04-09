<?php 

    class UserView
    {
        function renderLoginForm($errors=array())
        {
            $email_err = $errors["email"] ?? "";
            $password_err = $errors["password"] ?? "";
            $old_email = $_POST["email"] ?? "";
            $old_password = $_POST["password"] ?? "";

            $html = "";
            $html .= "<form method='POST'>";
            $html .= "<h1>Login</h1>";
            $html .= "<div>";
            $html .= "<input type='email' id='email' name='email' value='$old_email' placeholder='Type your email'/>";
            $html .= "<span class='error'>$email_err</span>";
            $html .= "</div>";
            $html .= "<div>";
            $html .= "<input type='password' id='password' name='password' value='$old_password' placeholder='Type your password'/>";
            $html .= "<span class='error'>$password_err</span>";
            $html .= "</div>";
            $html .= "<div>";
            $html .= "<button type='submit'>Login</button>";
            $html .= "<button type='reset'>Reset</button>";
            $html .= "</div>";
            $html .= "</form>";
            $html .= "<span>Not a member? <a href='register.php'>Create account.</a></span>";
            echo $html;
        }

        function renderRegistrationForm($errors=array())
        {
            $name_err = $errors["name"] ?? "";
            $email_err = $errors["email"] ?? "";
            $password_err = $errors["password"] ?? "";
            $old_name = $_POST["name"] ?? "";
            $old_email = $_POST["email"] ?? "";
            $old_password = $_POST["password"] ?? "";

            $html = "";
            $html .= "<form method='POST'>";
            $html .= "<h1>Register</h1>";
            $html .= "<div>";
            $html .= "<input type='text' id='name' name='name' value='$old_name' placeholder='Type your name'/>";
            $html .= "<span class='error'>$name_err</span>";
            $html .= "</div>";
            $html .= "<div>";
            $html .= "<input type='email' id='email' name='email' value='$old_email' placeholder='Type your email'/>";
            $html .= "<span class='error'>$email_err</span>";
            $html .= "</div>";
            $html .= "<div>";
            $html .= "<input type='password' id='password' name='password' value='$old_password' placeholder='Type your password'/>";
            $html .= "<span class='error'>$password_err</span>";
            $html .= "</div>";
            $html .= "<div>";
            $html .= "<input type='password' id='cpassword' name='cpassword' value='$old_password' placeholder='Confirm your password'/>";
            $html .= "</div>";
            $html .= "<div>";
            $html .= "<button type='submit'>Register</button>";
            $html .= "<button type='reset'>Reset</button>";
            $html .= "</div>";
            $html .= "</form>";
            $html .= "<span>Already have an account? <a href='index.php'>Login.</a></span>";
            echo $html;
        }
    }
?>