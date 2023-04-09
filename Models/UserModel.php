<?php 

    require_once("Model.php");

    class UserModel extends Model
    {
        function loginAccount($email)
        {
            $sql = "SELECT * FROM users WHERE email=:email";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            return ["row-count"=>$stmt->rowCount(), "user"=>$stmt->fetch()]; //return array
        }

        function registerAccount($name,$email,$password)
        {
            $sql = "INSERT INTO users (name,email,password) VALUES (:name,:email,:password)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":email", $email, PDO::PARAM_STR);
            $stmt->bindValue(":password", $password, PDO::PARAM_STR);
            return $stmt->execute(); //return bool
        }
    }
?>