<!DOCTYPE html>
<html>
<head>
	<title> Administrator Menu</title>
	<style>
		table {
			width : 80%;
		}
		th,td{
			text-align: center
		}
		tr:nth-child(even) {background-color: pink;}
	</style>
</head>
<body>

	<?php
		//connecting database
		include('index.php');
		include('dbconfig.php');
		$db = new Database();
		$conns = $db->getConnection();
	?>
	<h2 align = "center"> User Listing </h2>
	<?php
		//admin  class
		class admin{
			private $query_all;
			private $result;
			private $dir;
			private $add;
			private $connection;

			function __construct($c){
				$this->connection = $c;
			}
			function display(){
				$this->query_all = "SELECT * FROM `candidate`";
				$this->result = mysqli_query($this->connection , $this->query_all);
				echo '<table align ="center">
					<tr>
						<td> <strong>Id</strong></td>
						<td> <strong>First Name</strong> </td>
						<td> <strong>Last Name</strong> </td>
						<td> <strong>Email Id</strong> </td>
						<td> <strong>Mobile No.</strong> </td>
					</tr>';

					while($this->row = mysqli_fetch_array($this->result)){
						/*$this->dir = "uploads/";
						$this->add = $this->row['profile-picture'];*/
						echo "<tr>";
							echo "<td>".$this->row['ID']."</td>";
							//echo "<td><img src='$this->dir$this->add'/></td>";
							echo "<td>".$this->row['First_Name']."</td>";
							echo "<td>".$this->row['Last_Name']."</td>";
							echo "<td>".$this->row['EMAIL_ID']."</td>";
							echo "<td>".$this->row['MOBILE_NO']."</td>";
							echo '<td> <a href = "delete.php?id='.$this->row['ID'].'">Delete</a></td>';
							echo '<td> <a href = "edit.php?id='.$this->row['ID'].'">Edit</a></td>';
						echo "</tr>";
					}
				echo "</table>";
			}
		}

		//call function of admin class
		$ad = new admin($conns);
		$ad->display();	
	?>
</body>
</html>