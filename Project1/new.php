<?php
	include('index.php');
	function renderForm($first, $last, $emailid, $mob, $imag, $error)
	{
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>New Record</title>
	<style>
		input[type=text]{
	    width: 20%;
	    padding: 12px 20px;
	    margin: 5px 0;
	    border: 5px solid #ccc;
	    border-radius: 4px;
	    box-sizing: border-box;
	}

	input[type=submit] {
	    width: 15%;
	    background-color: #4CAF50;
	    color: white;
	    padding: 14px 20px;
	    margin: 8px 0;
	    border: none;
	    border-radius: 4px;
	    cursor: pointer;
	}
	</style>

	<script>
		function myFunction(){
			var input , txt;
			input = prompt("Enter Admin Code : ","code");
			if(input == null || input == "")
				location="index.php";
			else{
				if(input == "admin")
					location="user.php";
				else
					location="index.php";
			}
		}
	</script>
</head>
<body align="center">
<?php
	if ($error != '')	
	{

		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
	}
?>
<h2> Registration Form </h2>
<form action="" method="post" enctype="multipart/form-data">

	<label>First Name: *</label> 
	<input type="text" name="firstname" placeholder="Your First Name..." value="<?php echo $first ; ?>"/><br>

	<label>Last Name: *</label> <input type="text" name="lastname" placeholder="Your Last Name..." value="<?php echo $last ; ?>" /><br>

	<label>Email ID: *</label> <input type="text" name="email" placeholder = "Your Email ID..." value="<?php echo $emailid ; ?>" /><br>

	<label>Mobile No.: *</label> <input type="text" name="mobile" placeholder = "Your Mobile No..." value="<?php echo $mob ; ?>" /><br>

	<input type="submit" name="submit" value="Submit">

</form>

<input type="submit" name="admin" onclick="myFunction()" value="Click for admin page"/>
<p id="pop"></p>
</body>

</html>

<?php
}
	// connect to the database
	include('dbconfig.php');
	$db = new Database();
	$conns = $db->getConnection();

	class New_record{
		//private $target_dir = "uploads/";
		//private $img = basename($_FILES["f"]["name"]);
		//private $target_file = $this->target_dir.$this->img;
		//private $imageFileType = pathinfo($this->target_file,PATHINFO_EXTENSION);
		private $firstname;
		private $lastname;
		private $email;
		private $mobile;
		private $error;
		private $query , $connection;

		function __construct($c,$fn,$ln,$em,$m){
			$this->connection = $c;
			$this->firstname = $fn;
			$this->lastname = $ln;
			$this->email = $em;
			$this->mobile = $m;
		}
		function insert(){
			if ($this->firstname == '' || $this->lastname == '' || $this->email == '' || $this->mobile == '')
			{
				// generate error message
				$this->error = 'ERROR: Please fill in all required fields!';
				//if either field is blank, display the form again
				//renderForm($firstname, $lastname, $email , $mobile , $img , $error);
			}
			else {
			    /*if (move_uploaded_file($_FILES["f"]["tmp_name"], $this->target_file)) {*/
			        $this->query = "INSERT INTO `candidate` (`First_Name`,`Last_Name`,`EMAIL_ID`,`MOBILE_NO`/* , `profile-picture`*/) VALUES ('$this->firstname' , '$this->lastname' , '$this->email' , '$this->mobile')";
			        mysqli_query($this->connection , $this->query);
			        echo "Registered Successfully !!";
			     /*else {
			        echo "Sorry, there was an error uploading your file.";*/
			    }
		}
		/*function send_mail(){
			$str = "Name : ".$this->firstname." ".$this->lastname;
			$header = "From : chandreshg954@gmail.com";
			if(mail('$this->email' , 'Registration Details' , '$str' , '$header')){
				echo "<br>Mail Sent Successfully";
			}
		}*/
	}

	//setting directory for images
	/*$target_dir = "uploads/";
	$img = basename($_FILES["f"]["name"]);
	$target_file = $target_dir.$img;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);*/
	if (isset($_POST['submit']))
	{
			$n = new New_record($conns,$_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['mobile']);
			$n->insert();
			//$n->send_mail();
		/*}
		else{
			echo "<br> file name is empty<br>";
		}*/
	}
	else
	{
		renderForm('','','','','','');
	}
?>