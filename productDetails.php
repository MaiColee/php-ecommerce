<DOCTYPE html>
  <html lang="en">
  <head>
    <title>Weiland Product Details</title>
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
      <a class="navbar-brand" href="basket.php">
      <img src="images/basket.png" alt="" width="30" height="30">
    </a>
  </div>
      </nav>

<br>
<?php
include ('connection.php');
@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
$code = mysqli_connect_errno();

if($code){
    echo "Connection Failed: " . $code;
    exit();
 }

$sql = 'SELECT * FROM products WHERE ProductID =' . $_GET['id'];
$result = mysqli_query($db, $sql);
if($result){
        if(mysqli_num_rows($result) == 0){
            echo "No records found!";
        }
        else{
          while($row = mysqli_fetch_assoc($result)){

echo "<h3>" . $row['ProductName'] . "</h3>";
echo "<img id='detailpic' src=" . $row['ProductImage'] . ">";   
echo "<h3> Price: €" . $row['ProductPrice'] . "</h3>";
echo "<p id='desc2'> Description: " . $row['ProductDesc'] . "</p>";
echo "<form method='post' action='basket.php' ?>";
echo "<input type='hidden' id='pid' name='pid' value='" . $row['ProductID'] . "'  />";
echo "<input type='submit' name='add_to_basket' class='btn btn-danger' value='Add to basket' />";
echo "<br>";
echo "</form>";   

}
}
}
 ?>
<footer class="text-center" id="footer">&copy; Copyright 2022 Weiland </footer>
<a id="logout" class="btn btn-outline-secondary" href="logout.php">Log out</a>
</body>
</html>
