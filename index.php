<?php
include ('connection.php');
@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
$code = mysqli_connect_errno();

if($code){
    echo "Connection Failed: " . $code;
    exit();
 }
?>

<?php

session_start();

if(isset($_SESSION['user']))
{
    if($_SESSION['user']['UserType'] == 'customer')
    {

        header('location: customerHome.php');
    }

    elseif($_SESSION['user']['UserType'] == 'seller')
    {

        header('location: sellerHome.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Weiland Merch Home</title>
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scaleable=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
  <body>
<nav class="navbar navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="images/VicesLogo.png" alt="" width="90" height="45">
    </a>
  </div>
</nav>


<div id="indexmain">   
    <h3>Welcome to the home of Weiland Merch!</h3>
      <h4>Please Log In or Register!</h4>
     <a class='btn btn-outline-secondary' href="login.php">Log In</a>
      <a class='btn btn-outline-secondary' href="customerRegistration.php">Register</a>
</div> 
<footer class="text-center" id="footer">&copy; Copyright 2022 Weiland </footer>
  </body>
</html>
