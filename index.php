<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terciel Inventory System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <?php 
                session_start();
                if(isset($_SESSION["name"]))
                {
                    header("Location: home.php");
                }

                require_once("Controllers/UserController.php");
                $controller = new UserController();

                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $controller->login();
                    exit();
                }
                $controller->loginForm();
            ?>
        </div>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>