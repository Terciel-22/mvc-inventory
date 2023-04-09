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
    <?php 
        session_start();
        if(!isset($_SESSION["name"]))
        {
            header("Location: index.php");
        }

        echo "Welcome, ".$_SESSION["name"];
        
        if(isset($_POST["logout"]))
        {
            require_once("Controllers/UserController.php");
            $controller = new UserController();
            $controller->logout();
        }
    ?>
    <form method="POST">
        <input type="submit" value="Logout" name="logout">
    </form>

    <script src="assets/js/script.js"></script>
</body>
</html>