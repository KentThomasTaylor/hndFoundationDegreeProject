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


			<span class="btnSideBarOpen" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Logs</span>

			
			
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
<p>Check login logs below or run a query for specific logs</p>


<div class="multiformcontainer">


<form method="post" action="">
<?php echo display_error(); ?>

<div class="search-container multiformblock formcontainer">
<h1 class="formcontainerheading">Search Logs by Account ID</h1>
<div class="search-container">
      		<input type="text" placeholder="Account ID" name="search" class="formcontainerinput">
          <input style="visibility: hidden;" type="text" placeholder="" name="" class="formcontainerinput">
</div>
<input type="submit" name="accidquery" id="accidquery" value="Search by Account ID" class="formcontainerbutton">
</div>

<?php echo display_error(); ?>
<div class="search-container multiformblock formcontainer">
<h1 class="formcontainerheading">Search Logins Between Dates</h1>
<div class="search-container">
      		<input type="text" placeholder="Date 1" name="date1" class="formcontainerinput">
      		<input type="text" placeholder="Date 2" name="date2" class="formcontainerinput">
</div>
<input type="submit" name="accdatequery" id="accdatequery" value="Search between Dates" class="formcontainerbutton">
</div>
</form>


</div>






<table>
 <tr>
  <th>Login Record #</th> 
  <th>IP Address</th> 
  <th>Account ID</th> 
  <th>Date and Time of Login</th>
 </tr>
 <?php


 if (isset($_POST['accidquery'])) {
  $idquery = $_POST["search"];
 


  $query = "SELECT userloginlogid, logip, id, time FROM tbluserloginlog WHERE id='$idquery'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "</td><td>" . $row["userloginlogid"] . "</td><td>" . $row["logip"]. "</td><td>" . $row["id"]. "</td><td>" . $row["time"]. "</td></tr>";
}
}

echo "</table>";
}




if (isset($_POST['accdatequery'])) {
  $date1 = $_POST["date1"];
  $date2 = $_POST["date2"];



  $query = "
  SELECT userloginlogid, logip, id, time 
  FROM tbluserloginlog 
  WHERE time 
  BETWEEN '$date1' AND '$date2'
  ";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "</td><td>" . $row["userloginlogid"] . "</td><td>" . $row["logip"]. "</td><td>" . $row["id"]. "</td><td>" . $row["time"]. "</td></tr>";
}
}
echo "</table>";
} 

?>
</table>


<br>
<hr>
<p>All Login Logs</p>


<?php

$id = $_SESSION['varname'];
         
?>

<table>
 <tr>
  <th>Login Record #</th> 
  <th>IP Address</th> 
  <th>Account ID</th> 
  <th>Date and Time of Login</th>
 </tr>
 <?php

  $query = "SELECT userloginlogid, logip, id, time FROM tbluserloginlog";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "</td><td>" . $row["userloginlogid"] . "</td><td>" . $row["logip"]. "</td><td>" . $row["id"]. "</td><td>" . $row["time"]. "</td></tr>";
}
echo "</table>";
} 

?>
</table>


<section>
</section>
</div>
</body>
</html>