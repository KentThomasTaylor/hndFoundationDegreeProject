<?php 
  include('functions.php');
  
  if (!isLoggedIn()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}

//...
?>

<!doctype html>
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


      <span class="btnSideBarOpen" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Order&#160;History</span>

      
      
    <div class="search-container">
      <form action="/query_page.php">
          <input type="text" placeholder="Query" name="search">
          <button type="submit">Submit</button>
      </form>
    </div>
</div>
  
  



<div class="container"> 

  <h1 class="pageheading">Order History</h1>

</div>


 

<div class="admincard">
  <img src="../images/avatar.jpg" alt="avi" style="width:100%">
  <div class="admincontainer">
    <?php  if (isset($_SESSION['user'])) : ?>

    <h4><b>Name: <?php echo $_SESSION['user']['username']; ?></b></h4>
    <p>User Level: <?php echo ucfirst($_SESSION['user']['user_type']); ?></p>
    <a href="index.php?logout='1'" style="color: red;" class="button">logout</a>
    <?php endif ?>



  </div>

</div> 

<div class="admininfo">
<p>Hello, <?php echo $_SESSION['user']['username']; ?></p>
<p>View your orders below. If you have any issues such as an item undelivered, or would like to request a cancellation, please contact us.</p>



<?php
    $id = $_SESSION['varname'];
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
    $query = "SELECT a.orderID, a.ID, a.useracclogid, a.ccid, a.productid, a.ordertime, b.useracclogid, b.id, b.userFname, b.userLname, b.userAddLine1, b.userAddLine2, b.userTown, b.userCity, b.userPcode, b.userMobile, c.ccid, c.id, c.ccnumber, c.ccexdate, c.cccvv, d.productID, d.productName, d.productPrice, d.productDescription, d.productCategory, d.prodImage FROM tblorders a, tbluser b, tblusercc c, tblproducts d WHERE a.productid = d.productid AND a.id = '$id' AND b.id ='$id' AND c.id ='$id' AND a.ccid = c.ccid AND a.useracclogid = b.useracclogid";
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

<hr>

<div class="btn-group">
  <button onclick="location.href='orderhistory.php'"" class="button">Orders</button>
  <button onclick="location.href='manageUserDetails.php'"" class="button">Manage&#160;Details</button>
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
    <p>The item you selected was added to the basket. <br> Either close this box and continue shopping, or go to checkout by clicking the button below.</p>
    <button id="myBtn">Go to Checkout</button></p>
    </div>
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
var buttons = document.getElementsByClassName('myBtn');

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



//add2cart
function addProduct() {
  //this is just a product placeholder
  var productAdded = $('<li class="product"><div class="product-image"><a href="#0"><img src="img/product-preview.png" alt="placeholder"></a></div><div class="product-details"><h3><a href="#0">Product Name</a></h3><span class="price">$25.99</span><div class="actions"><a href="#0" class="delete-item">Delete</a><div class="quantity"><label for="cd-product-'+ productId +'">Qty</label><span class="select"><select id="cd-product-'+ productId +'" name="quantity"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select></span></div></div></div></li>');
  cartList.prepend(productAdded);
}
</script>








</html>