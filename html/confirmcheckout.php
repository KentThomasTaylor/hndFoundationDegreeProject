<?php 
	include('functions.php');
	
	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

//...
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>

<!-- this links this webpage to the cascading style sheet -->








<link rel="stylesheet" type="text/css" href="../css/css.css">
<link rel="stylesheet" type="text/css" href="../css/admin.css">

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
    <a href="index.php" >Home</a>
    <a href="userArea.php">My&#160;Account</a>
  
</div>
  
  
  
<div class="topnav">


        <span class="btnSideBarOpen" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Home</span>
		
		<?php
		
		$id = $_SESSION['varname'];

		$result = mysqli_query($db, "SELECT id FROM tbltempbasket WHERE id=$id");
		$num_rows = mysqli_num_rows($result);
		?>
		
		<input class="btncart" type="submit" name="btncart" value="Cart (<?php echo $num_rows ?> Items)" />
      
	  
	  
    
	
      	  	

	  
</div>
  
  



<div class="container"> 
<?php  if (isset($_SESSION['user'])) : ?>
  <h1 class="pageheading">Order Confirmation</h1>
<?php endif ?>
</div>


 

<div class="admininfo">


<br>
<h1>Your order has been placed! The following items will be delivered to the specified address in the next few working days.</h1>

<form method="post" action="functions.php">

<?php
		$id = $_SESSION['varname'];
		$date = $_SESSION['date'];
?>
<table>
			<tr>
			<th>Order ID</th>
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
		$id = $_SESSION['varname'];
		$query = "SELECT a.orderID, a.ID, a.useracclogid, a.ccid, a.productid, a.ordertime, b.useracclogid, b.id, b.userFname, b.userLname, b.userAddLine1, b.userAddLine2, b.userTown, b.userCity, b.userPcode, b.userMobile, c.ccid, c.id, c.ccnumber, c.ccexdate, c.cccvv, d.productID, d.productName, d.productPrice, d.productDescription, d.productCategory, d.prodImage FROM tblorders a, tbluser b, tblusercc c, tblproducts d WHERE a.productid = d.productid AND a.id = '$id' AND b.id ='$id' AND c.id ='$id' AND a.ordertime = '$date' AND a.ccid = c.ccid AND a.useracclogid = b.useracclogid";
		$result = mysqli_query($db, $query);
		$num_rows = mysqli_num_rows($result);


			if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["orderID"]. "</td><td>" . $row["productName"]. "</td><td>" . "£" . $row["productPrice"]. "</td><td>" . '<img width="197" height="250" src="admin/prodimages/' . $row['prodImage'].'"/>' . "</td><td>" . $row["userAddLine1"]. "</td><td>" . $row["userPcode"]. "</td><td>" . $row["ccnumber"]. "</td><td>" . $row["ccexdate"]. "</td><td>" . $row["ordertime"]. "</td></tr>";
			}
			
			echo "</table>";
		} 

		?>
		</table>

</form>



</div>



<!-- Overlay Modal -->
<div id="myModal" class="modal">

  <!-- content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Cart</h2>
  </div>
	
  <div class="modal-body">
	  <form method="post" action="functions.php">
	  <?php
		$id = $_SESSION['varname'];
	  ?>

		<table>
			<tr>
			<th>Select</th> 
			<th>Product</th>
			<th>Price</th>
			<th>Preview</th>
		</tr>
		<?php
		$query = "SELECT a.tempbasketid, a.productid, a.id, b.productname, b.productprice, b.prodimage FROM tbltempbasket a, tblproducts b WHERE a.productid = b.productid AND a.id = '$id'";
		$result = mysqli_query($db, $query);
		$num_rows = mysqli_num_rows($result);
			if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['tempbasketid']."'></td><td>" . $row["productname"]. "</td><td>" . "£" . $row["productprice"]. "</td><td>" . '<img width="197" height="250" src="admin/prodimages/' . $row['prodimage'].'"/>' . "</td></tr>";
			}	
			echo "</table>";    
		} 
		?>

		</table>

		<input class="btnsubmit" type="submit" name="removebasketitem" value="Remove Selected Product(s) From Basket">
		<br>
		</form>  
		<br>
		<button id="myBtn" type="submit" class="checkoutBtn" name="checkoutBtn">Go to Checkout</button>

	  </form>

    </div>
	<br>
	<div class="modal-footer">
		<h3><br /></h3>
    </div>
  </div>
</div>
</body>



<script>
// modal
var modal = document.getElementById('myModal');

// locate btn to open modal
var buttons = document.getElementsByClassName('btncart');

for (var i=0; i < buttons.length; i++) {
  buttons[i].addEventListener('click', function() {modal.style.display = "block";});
}

// close model event
var span = document.getElementsByClassName("close")[0];

// open modal
buttons.onclick = function() {
    modal.style.display = "block";
}

// btn to close modal
span.onclick = function() {
    modal.style.display = "none";
}

// close modal click outside
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}




</script>
<script>
            
            var table = document.getElementById("table"), sumVal = 0;
            
            for(var i = 1; i < table.rows.length; i++)
            {
                sumVal = sumVal + parseFloat(table.rows[i].cells[1].innerHTML);
            }
            
            document.getElementById("val").innerHTML = "Total = £" + sumVal;
            console.log(sumVal);
            
        </script>



</body>
</html>