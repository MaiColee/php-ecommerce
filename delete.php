<?php
include ('connection.php');
if(isset($_SESSION['user']))
{
    if($_SESSION['user']['UserType'] == 'customer')
    {

        header('location: customerHome.php');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Delete a Product</title>
        <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h3>Delete a Product</h3>
<?php


@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);

$code = mysqli_connect_errno();


 if($code){
    echo "An error occurred!";
    exit();
 }
 
?>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<div class="form-floating mb-3">
<input required type="text" name="id" placeholder="Username" class="form-control">
<label for="floatingInput">Product ID</label>
</div>
<input type="submit" onclick="return confirm('Are you sure you want to delete? ALL DATA WILL BE LOST')" name="deleteBtn" class="btn btn-danger btn-lg" value="DELETE"><br>
        </form>
<?php
      
if (isset($_POST['deleteBtn'])){


    $id = addslashes($_POST["id"]);

    $sql= "SELECT * FROM products WHERE ProductID = " . $_POST["id"];
    $result=mysqli_query($db, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            $sql= "DELETE FROM products WHERE ProductID = " . $id;
            $result=mysqli_query($db, $sql);
            echo "<h3>Product deleted!</h3>";
        }

        else{
            echo "<h3>No record was found matching this ID</h3>";
        }
    }

    mysqli_close($db);

}

?>

</body>
</html>