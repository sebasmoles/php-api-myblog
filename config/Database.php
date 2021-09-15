<?php
    class Database {
        // DB Params
        private $host = 'localhost';
        private $db_name = 'myblog';
        private $username = 'admin';
        private $password = 'password';
        private $conn;
        
        // DB connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, 
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $err) {
                 echo 'Connection error: ' . $err->getMessage();
            }

            return $this->conn;
         }
    }