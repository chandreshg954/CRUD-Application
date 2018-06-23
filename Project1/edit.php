<?php
function renderForm($id, $firstname, $lastname, $emailid, $mob, $imag, $error)
{

?>
<!DOCTYPE HTML >

<html>

<head>

<title>Edit Record</title>
	<style>
		input[type=text]{
	    width: 50%;
	    padding: 12px 20px;
	    margin: 8px 0;
	    border: 5px solid #ccc;
	    border-radius: 4px;
	    box-sizing: border-box;
	}

	input[type=submit] {
	    width: 50%;
	    background-color: #4CAF50;
	    color: white;
	    padding: 14px 20px;
	    margin: 5px 0;
	    border: none;
	    border-radius: 4px;
	    cursor: pointer;
	}
	</style>

</head>

<body align = "center">

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>
<h2> Edit Form </h2>
<form action="" method="post">

<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div>
<p><label>ID is :</label> <?php echo $id; ?></p>

<label>First Name: *</label> <input type="text" name="firstname" value="<?php echo $firstname; ?>"/><br/>

<label>Last Name: *</label> <input type="text" name="lastname" value="<?php echo $lastname; ?>"/><br/>
<label>Email ID *</label> <input type="text" name="email" value="<?php echo $emailid; ?>"/><br/>
<label>Mobile No.: *</label> <input type="text" name="mobile" value="<?php echo $mob; ?>"/><br/>
<?php 
	echo "<img src='uploads/$imag'/>";
?>
<label>Change Profile Picture: *</label><input type="file" name="f" id="f"/><br>
<p>* Required</p>

<input type="submit" name="submit" value="Submit">

</div>

</form>

</body>

</html>

<?php

}

// connect to the database

	include('index.php');
	include('dbconfig.php');
	$db = new Database();
	$conn = $db->getConnection();
// check if the form has ben submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$img = $_POST['f'];
// check that firstname/lastname fields are both filled in

if ($firstname == '' || $lastname == '' || $email == '' || $mobile == '' || $img == '')
{
// generate error message
$error = 'ERROR: Please fill in all required fields!';
//error, display form

renderForm($id, $firstname, $lastname, $email , $mobile ,$img ,$error);

}

else

{

// save the data to the database
	$query_edit = "UPDATE `candidate` SET `First_Name`='$firstname',`Last_Name`='$lastname',`EMAIL_ID`='$email',`MOBILE_NO`='$mobile' , 'profile-picture' = '$img' WHERE `ID` = $id";
	mysqli_query($conn , $query_edit);
// once saved, redirect back to the view page

header("Location: user.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else
// if the form hasn't been submitted, get the data from the db and display the form
{
// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$id = $_GET['id'];
$sql = "SELECT * FROM candidate WHERE `ID` = $id";
$result = mysqli_query($conn , $sql);
$row = mysqli_fetch_array($result);
// check that the 'id' matches up with a row in the databse
if($row)
{
// get data from db

$firstname = $row['First_Name'];
$lastname = $row['Last_Name'];
$email = $row['EMAIL_ID'];
$mobile = $row['MOBILE_NO'];
$img = $row['profile-picture'];
// show form
renderForm($id, $firstname, $lastname, $email ,$mobile ,$img,'');
}

else

// if no match, display result
{
echo "No results!";
}
}
else
// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
{
echo 'Error!';
}
}
?>