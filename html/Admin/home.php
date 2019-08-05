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


			<span class="btnSideBarOpen" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Administrative Panel</span>

			
			
  	<div class="search-container">
    	<form action="/query_page.php">
      		<input type="text" placeholder="Query" name="search">
      		<button type="submit">Submit</button>
    	</form>
  	</div>
</div>
	
	



<div class="container"> 

	<h1 class="pageheading">WELCOME TO THE ADMINISTRATIVE PANEL</h1>

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
<p>Please use the side menu to jump to other management pages</p>


<div class="main-section">

<?php
    $result = mysqli_query($db, "SELECT id FROM users");
    $num_rows = mysqli_num_rows($result);
?>

    <div class="dashbord">
      <div class="icon-section">
        <br>
        <img height="50" width="50" src="staticimages/icousers.png">
        <br>
        <small>Total Users</small>
        <p><?php echo $num_rows ?></p>
      </div>
      <div class="detail-section">
        <p>This is the total amount of registered users and administrators</p>
      </div>
    </div>

<?php
    $resultprod = mysqli_query($db, "SELECT productid FROM tblproducts");
    $num_rows1 = mysqli_num_rows($resultprod);
?>

    <div class="dashbord">
      <div class="icon-section">
        <br>
        <img height="50" width="50" src="staticimages/icousers.png">
        <br>
        <small>Total Products</small>
        <p><?php echo $num_rows1 ?></p>
      </div>
      <div class="detail-section">
        <p>This is the total amount of products listed on the website</p>
      </div>
    </div>

<?php
    $resultorder = mysqli_query($db, "SELECT orderid FROM tblorders");
    $num_rows2 = mysqli_num_rows($resultorder);
?>

    <div class="dashbord">
      <div class="icon-section">
        <br>
        <img height="50" width="50" src="staticimages/icousers.png">
        <br>
        <small>Total Orders</small>
        <p><?php echo $num_rows2 ?></p>
      </div>
      <div class="detail-section">
        <p>This is the total amount of orders which have been processed</p>
      </div>
    </div>

<?php
    $resultlog = mysqli_query($db, "SELECT userloginlogid FROM tbluserloginlog");
    $num_rows3 = mysqli_num_rows($resultlog);
?>

    <div class="dashbord">
      <div class="icon-section">
        <br>
        <img height="50" width="50" src="staticimages/icousers.png">
        <br>
        <small>Total Logins</small>
        <p><?php echo $num_rows3 ?></p>
      </div>
      <div class="detail-section">
        <p>This is the total amount of logins on this website from users</p>
      </div>
    </div>

    <div class="dashbord">
      <div class="icon-section">
        <br>
        <img height="50" width="50" src="staticimages/icousers.png">
        <br>
        <small>Total Revenue</small>
        <p id="value"></p>
      </div>
      <div class="detail-section">
        <p>This is the total amount of revenue generated through the websites orders, excluding expenses</p>
      </div>
    </div>

    <?php
    $resultbasket = mysqli_query($db, "SELECT tempbasketid FROM tbltempbasket");
    $num_rows4 = mysqli_num_rows($resultbasket);
?>

    <div class="dashbord">
      <div class="icon-section">
        <br>
        <img height="50" width="50" src="staticimages/icousers.png">
        <br>
        <small>Total Items in Users Baskets</small>
        <p><?php echo $num_rows4 ?></p>
      </div>
      <div class="detail-section">
        <p>This is the total amount of items in users baskets, which may potentially be purchased</p>
      </div>
    </div>
</div>




<table id="d74m6" style='display:none'>
      <tr>
      <th>Order ID</th>
      <th>Product</th>
      <th>Price</th>

    </tr>
    <?php
    $id = $_SESSION['varname'];
    $query = "SELECT a.orderID, a.ID, a.useracclogid, a.ccid, a.productid, a.ordertime, d.productID, d.productName, d.productPrice, d.productDescription, d.productCategory, d.prodImage FROM tblorders a, tblproducts d WHERE a.productid = d.productid";
    $result = mysqli_query($db, $query);
    $num_rows = mysqli_num_rows($result);
      if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["orderID"]. "</td><td>" . $row["productName"]. "</td><td>". $row["productPrice"]. "</td></tr>";
      }
      echo "</table>";
    } 
    ?>

<section>
</section>
</div>

</body>

<script>
            
            var table = document.getElementById("d74m6"), sumVal = 0;
            
            for(var i = 1; i < table.rows.length; i++)
            {
                sumVal = sumVal + parseFloat(table.rows[i].cells[2].innerHTML);
            }
            
            document.getElementById("value").innerHTML = "Total = £" + sumVal;
            console.log(sumVal);
            
</script>

</html>