<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration Portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type = "text/css" href = "css/main.css">
  <link href="//fonts.googleapis.com/css?family=Nunito&subset=latin,latin-ext" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
  <style>
   ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
  </style>
</head>
<body>
<img src = "2.jpg" style="margin:0px auto;display:block" width = 40%/>
<nav>
    <div class="navigator" align="center">
      <ul>
        <?php echo '<li><a href="index.php">Home</a></li>'; ?>
        <?php echo '<li ><a href="#">About Us</a></li>'; ?>
        <?php echo '<li><a href="#">Contact Us</a></li>'; ?>
        <?php echo'<li><a href="#" onclick="myFunction()"><span class="glyphicon glyphicon-user"></span> Administrator</a></li>'; ?>
        <?php echo'<li><a href="new.php"><span class="glyphicon glyphicon-user"></span> Users</a></li>'; ?>
      </ul>
    </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Registration Portal</h1>
    <p>!! Do Register and Be a Authorize Person !!</p>
  </div>
</div>

</body>
</html>
