<?php 
    class Model {

        private $driver = "mysql";
        private $host = "localhost";
        private $dbname = "mvc_inventory";
        private $port = 3306;
        private $charset = "utf8mb4";
        private $username = "root";
        private $password = "";
        private $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];

        protected function connect()
        {
            $dns = "$this->driver:host=$this->host;dbname=$this->dbname;port=$this->port;charset=$this->charset";

            try {
                return new PDO($dns, $this->username, $this->password, $this->options);
            } catch (PDOException $e)
            {
                echo "Error: ". $e->getMessage();
                exit();
            }
        }
    }
?>