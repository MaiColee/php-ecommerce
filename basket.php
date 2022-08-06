<?php
session_start();
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
   <title>Weiland Basket</title>
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
// If the request contains a GET command, delete the array      
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptybasket") {
    unset($_SESSION["basket_array"]);
}
// If the index sent from the delete button is correct, set a variable.
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
 	$key_to_remove = $_POST['index_to_remove'];
// If the array contains 1 or less elements, delete the array
	if (count($_SESSION["basket_array"]) <= 1) {
		unset($_SESSION["basket_array"]);
	} 
// Else, remove the element matching the key
    else {
		array_splice($_SESSION['basket_array'], $key_to_remove, 1);
		array_values($_SESSION["basket_array"]);
	}
}    
// If the id is accepted
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
	$wasFound = false;
	$i = 0;
    // If the array doesnt exist, start the array
	if (!isset($_SESSION["basket_array"]) || count($_SESSION["basket_array"]) < 1) { 
    $_SESSION["basket_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
        } 
    else {
        // if it exists, check for the items
		foreach ($_SESSION["basket_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {
					  $wasFound = true;
				  } 
		      } 
	       } 
        // If the element wasnt found, initialize it
		   if ($wasFound == false) {
			   array_push($_SESSION["basket_array"], array("item_id" => $pid, "quantity" => 1));
		   }
	}
	header("location: basket.php"); 
    exit();
}
// If the array doesnt exist, output to the user that it is empty
if (!isset($_SESSION["basket_array"]) || count($_SESSION["basket_array"]) < 1) {
    echo "<h2 align='center'>Your basket is empty</h2>";
}
else 
{ 
// If it is, display the cart in a table.
$total = 0;
$i = 0;
echo "<table id='basket' class='table table-striped'>";
foreach ($_SESSION["basket_array"] as $each_item) { 
        $i++;
		$item_id = $each_item['item_id'];
		$sql = 'SELECT * FROM products WHERE ProductID=' . $item_id;
		$result = mysqli_query($db, $sql);
if($result){
        if(mysqli_num_rows($result) == 0){
            echo "No items in the cart!";
        }
        else{
         $removevalue = $i - 1;
          while($row = mysqli_fetch_assoc($result)){
              echo "<tr>";
            echo "<td><img src='" . $row['ProductImage'] . "' height=50px></td>";
            echo "<td>" . $row['ProductName'] . "</td>";
            echo "<td>€" . $row['ProductPrice'] . "</td>";
            echo "<form action='basket.php' method='post'>";
            echo "<td> <input name='deleteBtn'" . $row['ProductID'] . "' type='submit' class='btn btn-outline-secondary' value='Remove'></td>";
            echo "<input name='index_to_remove' type='hidden' value='" . $removevalue . "'>";
            echo "</form>";
        echo "</tr>";
            $total = $total + $row['ProductPrice'];
		} 
}
}
}
echo "</table>";
echo "<h3>Total = €" . $total . "</h3>";
}
?>
<a id="checkoutbtn" class="btn btn-danger btn-lg" href="orderConfirm.php">Checkout!</a> 
<br>
<br>
<a class="btn btn-primary" href="basket.php?cmd=emptybasket">Empty Basket</a>
<a class="btn btn-outline-secondary" href="logout.php">Log out</a>
<footer class="text-center" id="footer">&copy; Copyright 2022 Weiland </footer>
   </body>
 </html>
