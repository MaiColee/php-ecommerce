<?php
include ('connection.php');

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
<html>
<head>
    <title>Weiland Registration</title>
        <meta charset="UTF-8">
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
    <h3>Customer Registration</h3>

    <?php
@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);

$code = mysqli_connect_errno();

if ($code)
{
    echo "An error occurred!";
    exit();
}

?>


<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="form-floating mb-3">
            <input required type="text" name="username" placeholder="Username" class="form-control">
            <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
            <input required type="password" name="password1" placeholder="Password" class="form-control">
            <label for="floatingPassword">Password</label>
            </div>
             <br>
             <div class="form-floating">
            <input required type="password" name="password2" placeholder="Password2" class="form-control">
            <label for="floatingPassword">Confirm Password</label>
            </div>
            <br>
            <input type="submit" class="btn btn-outline-secondary" name="customerRegBtn" id="regbtn" value="Register">
</form>
               

<?php

if (isset($_POST['customerRegBtn'])){
if ($_POST["password1"] != $_POST["password2"])
{
    echo "<h3>Passwords do not match, try again.</h3>";
}
    $username = addslashes($_POST["username"]);
    $password = addslashes($_POST["password1"]);
    $cleanusername = mysqli_real_escape_string($db, $username); 
    $cleanpassword = mysqli_real_escape_string($db, $password);
    
    
    $sql= "SELECT * FROM customer WHERE Username = " . $cleanusername;
    $result=mysqli_query($db, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0)
        {
            echo "<h3>A customer with this username already exists!</h3>";
            exit();
        }
    }
    else{


    $sql="INSERT INTO user (Username, Password, UserType) VALUES ('$cleanusername','$cleanpassword','customer')";


    $result=mysqli_query($db, $sql);

    if ($result){
        echo "<h3>Customer registered successfully!</h3>";
    }
    else {
        echo "<h3>An error occured, customer was not registered!</h3>";
    }

    mysqli_close($db);

}
}
?>

    </body>
</html>
