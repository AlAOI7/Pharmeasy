<?php
    class db{
        // Properties
        private $dbhost = 'localhost';
        private $dbuser = 'software_niha';
        private $dbpass = 'v9WvuUuwFN56';
        private $dbname = 'software_niha';
		
        // Connect
        public function connect(){
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);            
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
		
		// Connect
        public function connect_to_db(){
            $con = mysqli_connect("localhost","software_niha","v9WvuUuwFN56","software_niha");
            return $con;
        }
    }