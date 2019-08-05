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





if (isset($_POST['addprod_btn'])) {
  registerproduct();
}

// REGISTER USER
function registerproduct(){
  // call these variables with the global keyword to make them available in function
  global $db, $errors, $username, $email;

  // receive all input values from the form. Call the e() function
    // defined below to escape form values
  $productname    =  e($_POST['productname']);
  $productprice       =  e($_POST['productprice']);
  $category  =  e($_POST['category']);
  $description  =  e($_POST['description']);
  $f1 = $_FILES['file1']['name'];

  // form validation: ensure that the form is correctly filled
  if (empty($productname)) { 
    array_push($errors, "Product name is required"); 
  }
  if (empty($productprice)) { 
    array_push($errors, "Product price is required"); 
  }
  if (empty($category)) { 
    array_push($errors, "Product category is required"); 
  }
  if (empty($description)) { 
    array_push($errors, "Product description is required"); 
  }

  // register user if there are no errors in the form
  if (count($errors) == 0) {


    

  
  if(isset($_FILES['file1']))
  {
    $f1 = md5(uniqid(rand(), true)) . '.' . substr(strrchr(($_FILES['file1']['name']), '.'), 1);
    
    move_uploaded_file($_FILES['file1']['tmp_name'],"prodimages/$f1");
  }
  else
  {
    echo "Error: Image Upload Failed!!!";
  }






    if (isset($_POST['category'])) 
    {
      $category = e($_POST['category']);
      $query = "INSERT INTO tblproducts (productName, productPrice, productDescription, productCategory, prodImage) 
            VALUES('$productname', '$productprice', '$description', '$category', '$f1')";

      mysqli_query($db, $query);
        $_SESSION['success']  = "New product successfully created!";
		echo "<script type='text/javascript'>alert('The product has been successfully added to the database!');</script>";

      
    }



  }
}


function uploadfile()
{
    $f1 = e($_POST['file1']);


  
  if(isset($_FILES['file1']))
  {
    $f1 = $_FILES['file1']['name'];
    
    move_uploaded_file($_FILES['file1']['tmp_name'],"prodimages/$f1");
    echo "File Uploaded Successfully";
  }
  else
  {
  }
}




if(isset($_POST['uploadprod']))
{

  $f1 = $_FILES['file1']['name'];

  
  if(isset($_FILES['file1']))
  {
    $f1 = $_FILES['file1']['name'];
    
    move_uploaded_file($_FILES['file1']['tmp_name'],"prodimages/$f1");
    echo "File Uploaded Successfully";
  }
  else
  {
    echo "Error: Upload Failed";
  }
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


			<span class="btnSideBarOpen" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Product Management</span>

			
			
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
<p>Add products, run a query for products, and delete them below.</p>

<hr>

<div class="header">
  </div>
  
  <form method="post" enctype="multipart/form-data" action="productmanagement.php" class="formcontainer">

    <?php echo display_error(); ?>
<h1 class="formcontainerheading">Add a Product</h1>
    <div class="input-group">
      <input type="text" name="productname" placeholder="Product Name" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <input type="text" name="productprice" placeholder="Price (DO NOT INCLUDE CURRENCY '£$€')" class="formcontainerinput" required>
    </div>
    <div class="input-group">
      <select name="category" id="category" placeholder="Category" class="formcontainerinput">
        <option value="">Category</option>
        <option value="pantry">Pantry</option>
        <option value="electronics">Electronics</option>
      </select>
    </div>
    <div class="input-group">
			<label>Upload Image (Recommended size: 400px x 400px)</label>
        <input type="file" name="file1">
    </div>
    <div class="input-group">
      <input type="description" name="description" placeholder="Description" class="formcontainerinput" Required>
    </div>
    <div class="input-group">
      <button type="submit" class="btn formcontainerbutton" name="addprod_btn" >Create Product</button>
    </div>
  </form>
  
  

  


<?php

$id = $_SESSION['varname'];
         
?>
<hr>
<p>Run a query to filter products by specific ID, or by the name.</p>






<div class="multiformcontainer">

<form method="post" action="">

<?php echo display_error(); ?>
<div class="search-container multiformblock formcontainer">
<h1 class="formcontainerheading">Search for a Product by ID</h1>
          <input type="text" placeholder="Product ID" name="search" class="formcontainerinput">
          <input type="submit" name="productidquery" id="productidquery" class="formcontainerbutton" value="Search by Product ID">
</div>

<div class="search-container multiformblock formcontainer">
<h1 class="formcontainerheading">Search for a Product By Name</h1>
          <input type="text" placeholder="Product Name" name="acctype" class="formcontainerinput">
          <input type="submit" name="acctypequery" id="acctypequery" class="formcontainerbutton" value="Search by Product Name">
</div>
</form>

</div>





<form method="post" action="../functions.php">

<table>
 <tr>
  <th></th> 
  <th>ID</th> 
  <th>Product Name</th> 
  <th>Price</th> 
  <th>Description</th>
  <th>Category</th>
  <th>Image</th>
 </tr>
 <?php


 if (isset($_POST['productidquery'])) {


  $idquery = $_POST["search"];
 


  $query = "SELECT productID, productName, productPrice, productDescription, productCategory, prodImage FROM tblproducts WHERE productID='$idquery'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['productID']."'></td><td>" . $row["productID"]. "</td><td>" . $row["productName"]. "</td><td>" . $row["productPrice"] . "</td><td>" . $row["productDescription"]. "</td><td>" . $row["productCategory"] ."</td><td>" . '<img width="200" height="200" src="prodimages/'.$row['prodImage'].'"/>' ."</td></tr>";
}
}

echo "</table>";
}




if (isset($_POST['acctypequery'])) {
  $userquery = $_POST["acctype"];
 


  $query = "SELECT productID, productName, productPrice, productDescription, productCategory, prodImage FROM tblproducts WHERE productName LIKE '$userquery'";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['productID']."'></td><td>" . $row["productID"]. "</td><td>" . $row["productName"]. "</td><td>" . $row["productPrice"] . "</td><td>" . $row["productDescription"]. "</td><td>" . $row["productCategory"] ."</td><td>" . '<img width="200" height="200" src="prodimages/'.$row['prodImage'].'"/>' ."</td></tr>";
}
}
echo "</table>";
} 

?>
</table>
<br>
<input type="submit" name="deleteprod" id="deleteprod" value="Delete Product" class="btnsubmit">
</form>



<hr>
<p>All products</p>

<form method="post" action="../functions.php">


<table>
 <tr>
  <th></th> 
  <th>ID</th> 
  <th>Product Name</th> 
  <th>Price</th> 
  <th>Description</th>
  <th>Category</th>
  <th>Image</th>
 </tr>
 <?php

  $query = "SELECT productID, productName, productPrice, productDescription, productCategory, prodImage FROM tblproducts";
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
   // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['productID']."'></td><td>" . $row["productID"]. "</td><td>" . $row["productName"]. "</td><td>" . $row["productPrice"] . "</td><td>" . $row["productDescription"]. "</td><td>" . $row["productCategory"] ."</td><td>" . '<img width="200" height="200" src="prodimages/'.$row['prodImage'].'"/>' ."</td></tr>";
}
echo "</table>";
} else { echo "<h1>NO ACCOUNTS FOUND!</h1>"; }
$db->close();

?>
</table>
<br>
<input type="submit" name="deleteprod" id="deleteprod" value="Delete Product" class="btnsubmit">


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