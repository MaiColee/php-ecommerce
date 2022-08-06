<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(-1);
?>
<?php
include ('connection.php');
@$db = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
$code = mysqli_connect_errno();

if($code){
    echo "Connection Failed: " . $code;
    exit();
 }
 ?>

 <!DOCTYPE html>
 <html>
 <head>
   <title>Order Confirmed!</title>
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
 
<?php
$i = 0;
$user_id = $_SESSION['user']['UserID'];
echo "<table id='basket' class='table table-striped'>";
foreach ($_SESSION["basket_array"] as $each_item) { 
        $i++;
		$item_id = $each_item['item_id'];
    $sql = 'SELECT * FROM products WHERE ProductID =' . $item_id;
$result = mysqli_query($db, $sql);
if($result){
        if(mysqli_num_rows($result) == 0){
            echo "No records found!";
        }
}
$row = mysqli_fetch_assoc($result);
$total = $row['ProductPrice'];
$sql="INSERT INTO orders (UserID,ProductID,Total) VALUES ('$user_id','$item_id','$total')"; 
$result = mysqli_query($db, $sql);  
}
if($result){
            echo "<h3> Order completed! Check the void for your confirmation! </h3>";
            unset($_SESSION["basket_array"]);
        }
        else{       
       echo "<h3> Order failed, please try again. No funds have been taken. </h3>";
        }


?>
       
            

       
       
     </body>
</html>