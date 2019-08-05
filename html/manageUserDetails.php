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


      <span class="btnSideBarOpen" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Manage Details</span>

      
      
    <div class="search-container">
      <form action="/query_page.php">
          <input type="text" placeholder="Query" name="search">
          <button type="submit">Submit</button>
      </form>
    </div>
</div>
  
  



<div class="container"> 

  <h1 class="pageheading">Manage Account Details</h1>

</div>


 

<div class="admincard">
  <img src="../images/avatar.jpg" alt="avi" style="width:100%">
  <div class="admincontainer">
    <?php  if (isset($_SESSION['user'])) : ?>

    <h4><b>Name: <?php echo $_SESSION['user']['username']; ?></b></h4>
    <p>User Level: <?php echo ucfirst($_SESSION['user']['user_type']); ?></p>
    <?php endif ?>
  </div>
</div> 

<div class="admininfo">
<p>Hello, <?php echo $_SESSION['user']['username']; ?></p>
<p>Manage your delivery addresses or payment cards below. You may either add an address or payment card by clicking the 'Edit User Details' button below, or delete an address/card by ticking the address/card in the table and clicking the 'Delete Address' button</p>


    <?php echo display_error(); ?>

<?php

$id = $_SESSION['varname'];
         
?>
<form method="post" action="functions.php">
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
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['useracclogid']."'></td><td>" . $row["useracclogid"]. "</td><td>" . $row["id"]. "</td><td>" . $row["userfname"] . "</td><td>" . $row["userlname"]. "</td><td>" . $row["useraddline1"] . "</td><td>" . $row["useraddline2"]. "</td><td>" . $row["usertown"]. "</td><td>" . $row["usercity"]. "</td><td>" . $row["userpcode"]. "</td><td>" . $row["usermobile"]. "</td><td>" . $row["userdob"]. "</td></tr>";
}
echo "</table>";
} else { echo "<h1>WARNING: YOU HAVE NO ADDRESS ON RECORD. PLEASE ADD AN ADDRESS IMMEDIATELY!!!</h1>"; }
?>
</table>
<input type="submit" name="delete" id="delete" value="Delete Address" class="btnsubmit">
<hr>
</form>



<?php

$id = $_SESSION['varname'];
         
?>
<form method="post" action="functions.php">
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
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['ccid']."'></td><td>" . $row["ccid"]. "</td><td>" . $row["id"]. "</td><td>" . $row["ccnumber"]. "</td><td>" . $row["ccexdate"] . "</td><td>" . $row["cccvv"] . "</td></tr>";
}
echo "</table>";
} else { echo "<h1>WARNING: YOU HAVE NO CREDIT/DEBIT CARD ON RECORD. PLEASE ADD CREDIT/DEBIT CARD IMMEDIATELY!!!</h1>"; }
$db->close();
?>
</table>
<input type="submit" name="deletecc" id="deletecc" value="Delete Payment Card" class="btnsubmit">
</form>
<br>
  


<div class="buttonsadmincontainer">
<hr>
<div class="btn-group">
  <button class="myBtn button">Edit User Details</button>
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
      <h2>Change Password, Add Address or Payment Card</h2>
    </div>
  
    <div class="modal-body">

      <form class="formcontainer" method="post" action="manageUserDetails.php">
    <?php echo display_error(); ?>
    <h1 class="formcontainerheading">Change Password</h1>
    <div class="input-group">
      <input type="password" name="oldpassword" placeholder="Old Password" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="password" name="newpassword" placeholder="New Password" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="password" name="confirmnewpassword" placeholder="Confirm New Password" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <button type="submit" class="btn formcontainerbutton" name="changepassword_btn">Change Password</button>
    </div>
  </form>

<hr>

    <form class="formcontainer" method="post" action="manageUserDetails.php">
    <?php echo display_error(); ?>
    <h1 class="formcontainerheading">Add an Address</h1>
    <div class="input-group">
      <input type="text" name="firstname" placeholder="First Name" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="lastname" placeholder="Last Name" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="addline1" placeholder="Address Line 1" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="addline2" placeholder="Address Line 2" class="formcontainerinput">
    </div>
    <div class="input-group">
      <input type="text" name="town" placeholder="Town" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="city" placeholder="City" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="pcode" placeholder="Postalcode" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="mobile" placeholder="Mobile Number" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="dob" placeholder="Date of Birth" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <button type="submit" class="btn formcontainerbutton" name="addaddress_btn">Add Address</button>
    </div>
  </form>

<hr>

  <form class="formcontainer" method="post" action="manageUserDetails.php">
    <?php echo display_error(); ?>
    <h1 class="formcontainerheading">Add a credit/debit card</h1>
    <div class="input-group">
      <input type="text" name="ccnum" placeholder="Credit Card Number" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="ccexdate" placeholder="Expiration Date" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="cccvv" placeholder="CVV/CVV2" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <button type="submit" class="btn formcontainerbutton" name="addcc_btn">Add Address</button>
    </div>
  </form>
    
    
  
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





</script>








</html>