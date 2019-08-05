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
      
	  
	  
    <div class="search-container">
      <form action="/query_page.php">
          <input type="text" placeholder="Query" name="search">
          <button type="submit">Submit</button>
      </form>
	  

    </div>
	
      	  	

	  
</div>
  
  



<div class="container"> 
<?php  if (isset($_SESSION['user'])) : ?>
  <h1 class="pageheading">Welcome to Local Shopper, <?php echo $_SESSION['user']['username']; ?></h1>
<?php endif ?>
</div>


 

<div class="productscontainer">

<?php
$query = "SELECT productID, productName, productPrice, productDescription, productCategory, prodImage FROM tblproducts ORDER BY productID ASC ";
$result = mysqli_query($db,$query);
if(mysqli_num_rows($result) > 0) {
while ($row = mysqli_fetch_array($result)) {
?>


<div class="card">

 <form method="post" action="functions.php">


		<img class="prodimage" width="199" height="300" src="admin/prodimages/<?php echo $row["prodImage"]; ?>" alt="Product Name" style="width:100%;">
		<h1 class="prodname"><?php echo $row["productName"]; ?></h1>
		<p class="price">£<?php echo $row["productPrice"]; ?></p>


		<input type="hidden" name="hidden_name" value="<?php echo $row["productName"]; ?>">
		<input type="hidden" name="hidden_price" value="<?php echo $row["productPrice"]; ?>">
		<input type="hidden" name="hidden_productid" value="<?php echo $row["productID"]; ?>">

		<p class="proddesc"><?php echo $row["productDescription"]; ?></p>


		<p><button type="submit" class="myBtn1" name="myBtn1">Add to Cart</button></p>

</form>

	</div>
	
	
	





<?php
                }
            }
        ?>



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
			}
						else { echo "<h2>There are no itemes in your basket!</h2>"; }


			echo "</table>";
echo"<br>";

?>
</table>
<input class="btnsubmit" type="submit" name="removebasketitem" value="Remove Selected Product(s) From Basket">
<br>
</form>
	  
	  
	  
	  
	  
<br>


<form action="checkout.php">
	  <button id="myBtn" type="submit" class="checkoutBtn" name="checkoutBtn">Go to Checkout</button>
</form>




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




</body>
</html>