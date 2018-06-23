<?php
	class Database{
		private $servername = "localhost";
		private $username = "root";
		private $password = "";
		private $dbname = "mydb";
		private $conn;

		// Create connection
		function getConnection(){
			$this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
			// Check connection
			if (!$this->conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}
			return $this->conn; 
		}
	}
?>