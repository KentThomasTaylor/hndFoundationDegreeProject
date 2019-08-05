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


			<span class="btnSideBarOpen" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; User Management</span>

			
			
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
<p>Create a user account with any permission level through the form below.</p>


<div class="header">
  </div>
  
  <form method="post" action="usermanagement.php" class="formcontainer">


    <h1 class="formcontainerheading">Create a User</h1>
    <div class="input-group">
      <input type="text" name="username" class="formcontainerinput" placeholder="Username" value="<?php echo $username; ?>">
    </div>
    <div class="input-group">
      <input type="email" name="email" class="formcontainerinput" placeholder="Email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
      <select name="user_type" id="user_type" class="formcontainerinput">
        <option value="">Select User Type</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
    </div>
    <div class="input-group">
      <input type="password" name="password_1" class="formcontainerinput" placeholder="Password">
    </div>
    <div class="input-group">
      <input type="password" name="password_2" class="formcontainerinput" placeholder="Confirm Password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn formcontainerbutton" name="register_btn">Create Account</button>
    </div>
    <?php echo display_error(); ?>
  </form>


<?php

$id = $_SESSION['varname'];
         
?>
<hr>
<p>Run a query to filter accounts by specific ID, or by the account type 'user' or 'Admin'.</p>






<div class="multiformcontainer">
<form method="post" action="">
<div class="search-container multiformblock formcontainer">
<h1 class="formcontainerheading">Search for an Account by ID</h1>
          <input type="text" placeholder="Account ID" name="search" class="formcontainerinput">
          <input type="submit" name="accidquery" id="accidquery" class="formcontainerbutton" value="Search by Account ID">
</div>
<div class="search-container multiformblock formcontainer">
<h1 class="formcontainerheading">Search for an Account by Type</h1>
          <div class="input-group">
            <select name="acctype" id="user_type" class="formcontainerinput">
              <option value="">Select User Type</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
          <input type="submit" name="acctypequery" id="acctypequery" class="formcontainerbutton" value="Search by User Type">
</div>
<?php echo display_error(); ?>
</form>
</div>





<form method="post" action="../functions.php">

<table>
 <tr>
  <th></th> 
  <th>ID</th> 
  <th>Username</th> 
  <th>Email</th> 
  <th>User Type</th>
  <th>Password (HASHED)</th>

 </tr>
 <?php


 if (isset($_POST['accidquery'])) {
  $idquery = $_POST["search"];
 


  $query = "SELECT id, username, email, user_type, password FROM users WHERE id='$idquery'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['id']."'></td><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["email"] . "</td><td>" . $row["user_type"]. "</td><td>" . $row["password"] ."</td></tr>";
}
}

echo "</table>";
}




if (isset($_POST['acctypequery'])) {
  $userquery = $_POST["acctype"];
 


  $query = "SELECT id, username, email, user_type, password FROM users WHERE user_type='$userquery'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['id']."'></td><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["email"] . "</td><td>" . $row["user_type"]. "</td><td>" . $row["password"] ."</td></tr>";
}
}
echo "</table>";
} 

?>
</table>
<br>
<input type="submit" name="deleteacc" id="deleteacc" value="Delete User Account" class="btnsubmit">
</form>
<hr>
<p>Search account details linked to an account ID</p>



<form method="post" action="">
<div class="search-container formcontainer">
<h1 class="formcontainerheading">Search for Account Details by User ID</h1>
          <input type="text" placeholder="Account ID" name="search" class="formcontainerinput">
          <input type="submit" name="detidquery" id="detidquery" class="formcontainerbutton" value="Search by Account ID">
</div>
<?php echo display_error(); ?>
</form>



<form method="post" action="../functions.php">


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

if (isset($_POST['detidquery'])) {
  $detidquery = $_POST["search"];


  $query = "SELECT useracclogid, id, userfname, userlname, useraddline1, useraddline2, usertown, usercity, userpcode, usermobile, userdob FROM tbluser WHERE id='$detidquery'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['useracclogid']."'></td><td>" . $row["useracclogid"]. "</td><td>" . $row["id"]. "</td><td>" . $row["userfname"] . "</td><td>" . $row["userlname"]. "</td><td>" . $row["useraddline1"] . "</td><td>" . $row["useraddline2"]. "</td><td>" . $row["usertown"]. "</td><td>" . $row["usercity"]. "</td><td>" . $row["userpcode"]. "</td><td>" . $row["usermobile"]. "</td><td>" . $row["userdob"]. "</td></tr>";
}
echo "</table>";
} else { echo "<p>No address(es) have been found under this account ID</p>"; }
}
?>
</table>

<br>
<input type="submit" name="delete" id="delete" value="Delete Address" class="btnsubmit">


</form>
<hr>
<p>All user accounts registered</p>

<form method="post" action="../functions.php">


<table>
 <tr>
  <th></th> 
  <th>ID</th> 
  <th>Username</th> 
  <th>Email</th> 
  <th>User Type</th>
  <th>Password (HASHED)</th>

 </tr>
 <?php

  $query = "SELECT id, username, email, user_type, password FROM users";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['id']."'></td><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["email"] . "</td><td>" . $row["user_type"]. "</td><td>" . $row["password"] ."</td></tr>";
}
echo "</table>";
} else { echo "<h1>NO ACCOUNTS FOUND!</h1>"; }
$db->close();

?>
</table>
<br>
<input type="submit" name="deleteacc" id="deleteacc" value="Delete User Account" class="btnsubmit">


</form>




<section>
</section>







</div>
</body>














</html>