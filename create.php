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
        <title>PHP</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="style.css">
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
        <h3>Add a Product</h3>


<?php


@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
$code = mysqli_connect_errno();


 if($code){
    echo "An error occured!";
    exit();
 }
 
?>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
<div class="form-floating mb-3">
<input required type="text" name="name" class="form-control">
<label for="floatingInput">Product Name</label>
</div>
<div class="form-floating mb-3">
<input required type="text" name="price" class="form-control">
<label for="floatingInput">Product Price</label>
</div>
<div class="form-floating mb-3">
<input required type="text" name="image" class="form-control">
<label for="floatingInput">Product Image (Source Given to you by admin)</label>
</div>
<div class="form-floating mb-3">
<label for="floatingInput">Product Description</label>
<textarea class="form-control" id="description" name="description" rows="10" cols="50">
    </textarea>
</div>
<input type="submit" onclick="return confirm('Are you sure you want to add? MAKE SURE ALL FIELDS ARE CORRECT')" name="addBtn" class="btn btn-primary btn-lg" value="ADD"><br>
</form>

<?php
       
if (isset($_POST['addBtn'])){

    $name = addslashes($_POST["name"]);
    $price = addslashes($_POST["price"]);
    $image = addslashes($_POST["image"]);
    $description = addslashes($_POST["description"]);


    $sql="INSERT INTO products (ProductName,ProductPrice,ProductImage, ProductDesc) VALUES ('$name','$price','$image','$description')"; 

    $result=mysqli_query($db, $sql); 

    if ($result){
        echo "<h3>Product added successfully!</h3>";
    }
    else {
        echo "<h3>An error occured, product was not added!</h3>";
    }

    mysqli_close($db);

}

?>


</body>
</html>