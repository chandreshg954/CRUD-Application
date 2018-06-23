<?php
		include('index.php');
		include('dbconfig.php');
		$db = new Database();
		$conns = $db->getConnection();
		
		class delete{
			private $id;
			private $query_delete;
			private $conn;

			function __construct($i,$c){
				$this->id = $i;
				$this->conn = $c;
			}

			function delete_record(){
				$this->query_delete = "DELETE FROM candidate WHERE `ID` = $this->id";
				mysqli_query($this->conn , $this->query_delete);
				header("Location: user.php");
			}
		}
		if (isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$del = new delete($_GET["id"] , $conns);
			$del->delete_record();
		}
		else
		{
			header("Location: user.php");
		}
?>