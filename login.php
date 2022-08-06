<?php
include ('connection.php');
@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
$code = mysqli_connect_errno();

if($code){
    echo "Connection Failed: " . $code;
    exit();
 }
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
        <title>Weiland Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h3>Log in</h3>

        <?php
    @$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);


$code = mysqli_connect_errno();

if ($code)
{
    echo "An error has occured!";
    exit();
}

?>


        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="form-floating mb-3">
            <input required type="text" name="username" placeholder="Username" class="form-control">
            <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
            <input required type="password" name="password" placeholder="Password" class="form-control">
              <label for="floatingPassword">Password</label>
            <input type="submit" class="btn btn-outline-secondary" name="loginBtn" value="Log In">
                </div>

        </form>

       <?php

        if(isset($_POST['loginBtn']))
        {
           $username = mysqli_real_escape_string($db, $_POST['username']); 
           $password = mysqli_real_escape_string($db, $_POST['password']);
            $sql = "SELECT * FROM user WHERE Username = '$username' AND Password='$password'";

            $result = mysqli_query($db, $sql);

            if($result)
            {
                if(mysqli_num_rows($result) === 1)
                {

                    $logged_in_user_row = mysqli_fetch_assoc($result);

                    $_SESSION['user'] = $logged_in_user_row;

                    if($_SESSION['user']['UserType'] == 'customer')
                    {
                        header('location: customerHome.php');
                    }

                    elseif($_SESSION['user']['UserType'] == 'seller')
                    {
                        header('location: sellerHome.php');
                    }
                }
            }

            echo "<h3>Log in failed, please try again.</h3>";
        }

        ?>
    </body>
</html>
