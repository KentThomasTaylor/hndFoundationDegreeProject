<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>





<!doctype html>
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>

<!-- this links this webpage to the cascading style sheet -->
<link rel="stylesheet" type="text/css" href="../../css/css.css">
<link rel="stylesheet" type="text/css" href="../../css/admin.css">
<script src="script.js"></script> 
</head>


<body>



<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
	
	
	
<div id="mySidenav" class="sidenav">

  <a href="javascript:void(0)" class="closebtn" onclick="closeNav();invisibleText()">&times;</a>
  
	  <a href="#placeholder"></a>
    <a href="#placeholder"></a>
    <a href="#placeholder"></a>
    <a href="home.php">Home</a>
    <a href="productmanagement.php">Product&#160;Management</a>
    <a href="usermanagement.php">User&#160;Management</a>
    <a href="ordermanagement.php">Order&#160;Management</a>
    <a href="logs.php">Logs</a>
	
</div>
	
	
	
<div class="topnav">


			<span class="btnSideBarOpen" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Order Management</span>

			
			
  	<div class="search-container">
    	<form action="/query_page.php">
      		<input type="text" placeholder="Query" name="search">
      		<button type="submit">Submit</button>
    	</form>
  	</div>
</div>
	
	



<div class="container"> 

	<h1 class="pageheading">WELCOME TO THE ORDER MANAGEMENT SYSTEM</h1>

</div>


 <div class="admincard">
  <img src="../../images/avatar.jpg" alt="avi" style="width:100%">
  <div class="admincontainer">
    <?php  if (isset($_SESSION['user'])) : ?>

    <h4><b>Name: <?php echo $_SESSION['user']['username']; ?></b></h4>
    <p>User Level: <?php echo ucfirst($_SESSION['user']['user_type']); ?></p>
    <a href="home.php?logout='1'" style="color: red;" class="button">logout</a>
    <?php endif ?>



  </div>

</div> 


<div class="admininfo">
<p>Hello, <?php echo $_SESSION['user']['username']; ?></p>
<p>Please manage orders from users below. This page can be used for processing deliveries, or processing order cancellations if the item is yet to be sent</p>



<div class="multiformcontainer">



<?php echo display_error(); ?>
<div class="search-container multiformblock formcontainer">
<h1 class="formcontainerheading">Search for an Order by Order ID</h1>
<form method="post" action="">
          <input type="text" placeholder="Order ID" name="orderidqry" class="formcontainerinput" required>
          <input type="submit" name="orderidquery" id="orderidquery" class="formcontainerbutton" value="Perform Query">
</form>
</div>

<div class="search-container multiformblock formcontainer">
<h1 class="formcontainerheading">Search for Orders By User ID</h1>
<form method="post" action="">
          <input type="text" placeholder="User ID" name="useridqry" class="formcontainerinput" required>
          <input type="submit" name="useridquery" id="useridquery" class="formcontainerbutton" value="Perform Query">
</form>
</div>

<div class="search-container multiformblock formcontainer">
<h1 class="formcontainerheading">Search for Orders By Product ID</h1>
<form method="post" action="">
          <input type="text" placeholder="Product ID" name="prodidqry" class="formcontainerinput" required>
          <input type="submit" name="prodidquery" id="prodidquery" class="formcontainerbutton" value="Perform Query">
</form>
</div>




</div>





<form method="post" action="../functions.php">

<table>
 <tr>
      <th></th>
      <th>Order ID</th>
      <th>Product ID</th>
      <th>User ID</th>
      <th>Product</th>
      <th>Price</th>
      <th>Preview</th>
      <th>Delivery Address Line 1</th>
      <th>Delivery Postcode</th>
      <th>Payment Card Number</th>
      <th>Payment Exp Date</th>
      <th>Order Time</th>
 </tr>
 <?php


 if (isset($_POST['orderidquery'])) {


  $orderidquery = $_POST["orderidqry"];
 


  $query = "SELECT a.orderID, a.ID, a.useracclogid, a.ccid, a.productid, a.ordertime, b.useracclogid, b.id, b.userFname, b.userLname, b.userAddLine1, b.userAddLine2, b.userTown, b.userCity, b.userPcode, b.userMobile, c.ccid, c.id, c.ccnumber, c.ccexdate, c.cccvv, d.productID, d.productName, d.productPrice, d.productDescription, d.productCategory, d.prodImage FROM tblorders a, tbluser b, tblusercc c, tblproducts d WHERE a.productid = d.productid AND a.id = b.id AND b.id = c.id AND c.id = a.id AND a.ccid = c.ccid AND a.useracclogid = b.useracclogid AND a.orderID = '$orderidquery'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['orderID']."'></td><td>" . $row["orderID"]. "</td><td>" . $row["productID"]. "</td><td>" . $row["id"]. "</td><td>" . $row["productName"]. "</td><td>" . "£" . $row["productPrice"]. "</td><td>" . '<img width="197" height="250" src="prodimages/' . $row['prodImage'].'"/>' . "</td><td>" . $row["userAddLine1"]. "</td><td>" . $row["userPcode"]. "</td><td>" . $row["ccnumber"]. "</td><td>" . $row["ccexdate"]. "</td><td>" . $row["ordertime"]. "</td></tr>";
}
}

echo "</table>";
}




if (isset($_POST['useridquery'])) {



  $useridquery = $_POST["useridqry"];
 


  $query = "SELECT a.orderID, a.ID, a.useracclogid, a.ccid, a.productid, a.ordertime, b.useracclogid, b.id, b.userFname, b.userLname, b.userAddLine1, b.userAddLine2, b.userTown, b.userCity, b.userPcode, b.userMobile, c.ccid, c.id, c.ccnumber, c.ccexdate, c.cccvv, d.productID, d.productName, d.productPrice, d.productDescription, d.productCategory, d.prodImage FROM tblorders a, tbluser b, tblusercc c, tblproducts d WHERE a.productid = d.productid AND a.id = '$useridquery' AND b.id = '$useridquery' AND c.id = '$useridquery' AND a.ccid = c.ccid AND a.useracclogid = b.useracclogid";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['orderID']."'></td><td>" . $row["orderID"]. "</td><td>" . $row["productID"]. "</td><td>" . $row["id"]. "</td><td>" . $row["productName"]. "</td><td>" . "£" . $row["productPrice"]. "</td><td>" . '<img width="197" height="250" src="prodimages/' . $row['prodImage'].'"/>' . "</td><td>" . $row["userAddLine1"]. "</td><td>" . $row["userPcode"]. "</td><td>" . $row["ccnumber"]. "</td><td>" . $row["ccexdate"]. "</td><td>" . $row["ordertime"]. "</td></tr>";
}
}

echo "</table>";
}


if (isset($_POST['prodidquery'])) {

$prodidquery = $_POST["prodidqry"];
 


  $query = "SELECT a.orderID, a.ID, a.useracclogid, a.ccid, a.productid, a.ordertime, b.useracclogid, b.id, b.userFname, b.userLname, b.userAddLine1, b.userAddLine2, b.userTown, b.userCity, b.userPcode, b.userMobile, c.ccid, c.id, c.ccnumber, c.ccexdate, c.cccvv, d.productID, d.productName, d.productPrice, d.productDescription, d.productCategory, d.prodImage FROM tblorders a, tbluser b, tblusercc c, tblproducts d WHERE a.productid = d.productid AND a.id = b.id AND b.id = c.id AND c.id = a.id AND a.ccid = c.ccid AND a.useracclogid = b.useracclogid AND a.productid = '$prodidquery'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['orderID']."'></td><td>" . $row["orderID"]. "</td><td>" . $row["productID"]. "</td><td>" . $row["id"]. "</td><td>" . $row["productName"]. "</td><td>" . "£" . $row["productPrice"]. "</td><td>" . '<img width="197" height="250" src="prodimages/' . $row['prodImage'].'"/>' . "</td><td>" . $row["userAddLine1"]. "</td><td>" . $row["userPcode"]. "</td><td>" . $row["ccnumber"]. "</td><td>" . $row["ccexdate"]. "</td><td>" . $row["ordertime"]. "</td></tr>";
}
}

echo "</table>";
}



?>
</table>
<br>
<input type="submit" name="cancelorder" id="cancelorder" value="Cancel Order" class="btnsubmit">
</form>






<section>
</section>
</div>

</body>
<script>
  Array.prototype.forEach.call(document.body.querySelectorAll("*[data-mask]"), applyDataMask);

function applyDataMask(field) {
    var mask = field.dataset.mask.split('');
    
    // For now, this just strips everything that's not a number
    function stripMask(maskedData) {
        function isDigit(char) {
            return /\d/.test(char);
        }
        return maskedData.split('').filter(isDigit);
    }
    
    // Replace `_` characters with characters from `data`
    function applyMask(data) {
        return mask.map(function(char) {
            if (char != '_') return char;
            if (data.length == 0) return char;
            return data.shift();
        }).join('')
    }
    
    function reapplyMask(data) {
        return applyMask(stripMask(data));
    }
    
    function changed() {   
        var oldStart = field.selectionStart;
        var oldEnd = field.selectionEnd;
        
        field.value = reapplyMask(field.value);
        
        field.selectionStart = oldStart;
        field.selectionEnd = oldEnd;
    }
    
    field.addEventListener('click', changed)
    field.addEventListener('keyup', changed)
}
</script>


</html>