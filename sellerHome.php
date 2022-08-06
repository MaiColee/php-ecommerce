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
        <title>Weiland Seller Home</title>
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
    <h1>Seller Weiland Home</h1>
<?php

@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);

$code = mysqli_connect_errno();


 if($code){
    echo "An error occurred!";
    exit();
 }
 
?>

<?php
echo "<div class='padding'>";
$sql = 'SELECT * FROM products';
    $result = mysqli_query($db, $sql);

    if($result){

        if(mysqli_num_rows($result) == 0){
            echo "<h3>No records found!</h3>";
        }

        else{
            echo "<h2>Products</h2><br>";
            echo "<table class='table table-striped' border='1'>";
            echo "<tr><th>Product ID</th><th>Product Name</th><th>Product Price</th><th>Source Image</th><th>Product Description</th></tr>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";

                foreach($row as $value)
                {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    else {
        echo "<h3>Query failed, please check that syntax is correct!</h3>";
    }
echo "</div>";

echo "<div class='padding'>";
$sql = 'SELECT * FROM orders';
    $result = mysqli_query($db, $sql);

    if($result){

        if(mysqli_num_rows($result) == 0){
            echo "<h3>No records found!</h3>";
        }

        else{
            echo "<h2>Orders</h2><br>";
            echo "<table class='table table-striped' border='1'>";
            echo "<tr><th>OrderID</th><th>UserID</th><th>ProductID</th><th>Total</th></tr>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";

                foreach($row as $value)
                {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    else {
        echo "<h3>Query failed, please check that syntax is correct!</h3>";
    }
echo "</div>";        
        
echo "<div class='padding'>";
$sql = 'SELECT UserID, Username FROM user WHERE UserType = "customer";';
    $result = mysqli_query($db, $sql);

    if($result){

        if(mysqli_num_rows($result) == 0){
            echo "<h3>No records found!</h3>";
        }

        else{
            echo "<h2>Customers (To match with Orders)</h2><br>";
            echo "<table class='table table-striped' border='1'>";
            echo "<tr><th>User ID</th><th>Username</th></tr>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";

                foreach($row as $value)
                {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    else {
        echo "<h3>Query failed, please check that syntax is correct!</h3>";
    }
echo "</div>";       
?>
<a class='btn btn-primary' href="create.php">Add a Product</a>
<a class='btn btn-danger' href="delete.php">Delete a Product</a>
<a class="btn btn-outline-secondary" href="logout.php">Log out</a>
</body>
</html>
