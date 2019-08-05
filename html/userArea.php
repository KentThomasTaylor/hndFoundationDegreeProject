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


      <span class="btnSideBarOpen" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; My Account</span>

      
      
    <div class="search-container">
      <form action="/query_page.php">
          <input type="text" placeholder="Query" name="search">
          <button type="submit">Submit</button>
      </form>
    </div>
</div>
  
  



<div class="container"> 

  <h1 class="pageheading">MY ACCOUNT</h1>

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
<p>Manage orders, and your personal details by jumping to the pages below</p>
<p>Monitor your previous sessions below. See suspicious activity? Reset your password immediately.</p>



<?php

$id = $_SESSION['varname'];
         
?>

<table>
 <tr>
  <th>IP Address</th> 
  <th>Date and Time of Login</th>
 </tr>
 <?php

  $query = "SELECT logip, time FROM tbluserloginlog WHERE id='$id'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "</td><td>" . $row["logip"] . "</td><td>" . $row["time"]. "</td></tr>";
}
echo "</table>";
} 

?>
</table>

<div class="buttonsadmincontainer">
<hr>
<div class="btn-group">
  <button onclick="location.href='orderhistory.php'"" class="button">Orders</button>
  <button onclick="location.href='manageUserDetails.php'"" class="button">Manage&#160;Details</button>





</div>
</div>







<section>

</section>





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