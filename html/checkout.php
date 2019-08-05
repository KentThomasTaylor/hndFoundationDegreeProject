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
  <h1 class="pageheading">Checkout and Purchase the <?php echo $num_rows ?> Items in your Basket Below</h1>
<?php endif ?>
</div>


 

<div class="admininfo">


<br>
<h1>Review your Order</h1>
<h2>Check that you have selected all the items you would like to purchase. If you need to remove an item, go to your basket and do so. If you need to select another item, return to the home page and add the item to your basket.</h2>

	
	
	<?php

		$id = $_SESSION['varname'];
         
	  ?>
<form method="post" action="functions.php">
		<table>
			<tr>
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
				echo "<tr><td>" . $row["productname"]. "</td><td>" . "£" . $row["productprice"]. "</td><td>" . '<img width="197" height="250" src="admin/prodimages/' . $row['prodimage'].'"/>' . "</td></tr>";
			}
			
			echo "</table>";
		} 

		?>
		</table>



<br>
<hr>
<h3>Select your address. Is the delivery address you want not listed? Go to 'My Account' and add the address.</h3>



<table>
 <tr>
  <th></th> 
  <th>Address Log ID</th> 
  <th>Your User ID</th> 
  <th>First Name</th> 
  <th>Last Name</th>
  <th>Address Line 1</th>
  <th>Address Line 2</th>
  <th>Town</th>
  <th>City</th>
  <th>Post Code</th>
  <th>Mobile</th>
  <th>DoB</th>
 </tr>
 <?php
  $query = "SELECT useracclogid, id, userfname, userlname, useraddline1, useraddline2, usertown, usercity, userpcode, usermobile, userdob FROM tbluser WHERE id='$id'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='useracclogidcheckbox[]' value='".$row['useracclogid']."'></td><td>" . $row["useracclogid"]. "</td><td>" . $row["id"]. "</td><td>" . $row["userfname"] . "</td><td>" . $row["userlname"]. "</td><td>" . $row["useraddline1"] . "</td><td>" . $row["useraddline2"]. "</td><td>" . $row["usertown"]. "</td><td>" . $row["usercity"]. "</td><td>" . $row["userpcode"]. "</td><td>" . $row["usermobile"]. "</td><td>" . $row["userdob"]. "</td></tr>";
}
echo "</table>";
} else { echo "<h1>WARNING: YOU HAVE NO ADDRESS ON RECORD. PLEASE ADD AN ADDRESS IMMEDIATELY IN 'MY ACCOUNT'!!!</h1>"; }
?>
</table>



<br>
<hr>
<h3>Select your payment card on record. No payment card on record? Go to 'My Account'</h3>



<table>
 <tr>
  <th></th> 
  <th>Credit Card ID</th> 
  <th>Your User ID</th> 
  <th>Credit Card Number</th> 
  <th>Expiration Date</th>
  <th>CVV/CVV2 Security Code</th>
 </tr>
 <?php
  $query = "SELECT ccid, id, ccnumber, ccexdate, cccvv FROM tblusercc WHERE id='$id'";
  $result = mysqli_query($db, $query);
  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='ccidcheckbox[]' value='".$row['ccid']."'></td><td>" . $row["ccid"]. "</td><td>" . $row["id"]. "</td><td>" . $row["ccnumber"]. "</td><td>" . $row["ccexdate"] . "</td><td>" . $row["cccvv"] . "</td></tr>";
}
echo "</table>";
} else { echo "<h1>WARNING: YOU HAVE NO CREDIT/DEBIT CARD ON RECORD. PLEASE ADD CREDIT/DEBIT CARD IMMEDIATELY!!!</h1>"; }
?>
</table>



<br>
<hr>
<h2>The following item(s) will be invoiced to your account</h2>
<h3>Please review the total cost and double check you have selected the correct items, delivery address, and payment card. If you are ready to purchase, click the order button below.</h3>



		<table id="table">
			<tr>
			<th></th>
			<th>Product</th>
			<th>Price (GBP)</th>
			</tr>
		<?php

		$query = "SELECT a.tempbasketid, a.productid, a.id, b.productname, b.productprice FROM tbltempbasket a, tblproducts b WHERE a.productid = b.productid AND a.id = '$id'";
		$result = mysqli_query($db, $query);
		$num_rows = mysqli_num_rows($result);


			if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr><td><input type='checkbox' checked='checked' style='display:none' name='productid[]' value='".$row["productid"]."'</td><td>" . $row["productname"]. "</td><td>". $row["productprice"]. "</td></tr>";
			}
			
			echo "</table>";
		} 

		?>
		</table>



<h1><span id="val"></span></h1>

<p id="errMessage"></p>
		<input class="btnsubmit" type="submit" name="confirmcheckout" value="Purchase Items">
		<hr>
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
                sumVal = sumVal + parseFloat(table.rows[i].cells[2].innerHTML);
            }
            
            document.getElementById("val").innerHTML = "Total = £" + sumVal;
            console.log(sumVal);
            
        </script>


</body>
</html>