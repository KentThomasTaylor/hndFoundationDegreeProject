<?php 
session_start();


// connect to database
$db = mysqli_connect('localhost', 'root', '', 'ecommercedb');


// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 


// variable declaration
$username = "";
$email    = "";
$errors   = array(); 


// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}


// REGISTER USER
function register(){

	global $db, $errors, $username, $email;

	

	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);


	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database, MD5 weak, but dev purposes only

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: usermanagement.php');

		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: login.php'); // throw back to login page, destroys session to start a new

		}
	}
}
if (isset($_POST['changepassword_btn'])) {
	changeuserpass();
}
function changeuserpass(){

		global $db, $errors, $username, $email;


	$oldpassword  =  e($_POST['oldpassword']);
	$newpassword  =  e($_POST['newpassword']);
	$confirmnewpassword  =  e($_POST['confirmnewpassword']);
	$id = $_SESSION['varname'];

	if (empty($oldpassword)) { 
		array_push($errors, "Old password is required"); 
	}
	if (empty($newpassword)) { 
		array_push($errors, "New password is required"); 
	}
	if ($newpassword != $confirmnewpassword) {
		array_push($errors, "The two new passwords do not match");
	}

	if (count($errors) == 0) {
		$oldpassword1 = md5($oldpassword);
		$newpassword1 = md5($newpassword);//encrypt the password before saving in the database, MD5 weak, but dev purposes only
		$query ="SELECT id, password FROM users WHERE id = '$id'";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result);

		if ($row['password'] = $oldpassword1) {
    		$sql = "UPDATE users SET password = '$newpassword1' WHERE id = '$id'";
			mysqli_query($db, $sql);
 		} else {
			array_push($errors, "Old password is incorrect"); 
 		}


		


		}


}
// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}


// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}


function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	


function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}


// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}


// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}


// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);


	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		$sql = "SELECT id FROM users WHERE username='$username'";
			$result = mysqli_query($db, $sql);
			$id = mysqli_fetch_array($result);
			$_SESSION['varname'] = $id['id'];

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			
			

			$logged_in_user = mysqli_fetch_assoc($results);

			
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;


				$_SESSION['success']  = "You are now logged in";


				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;


				$_SESSION['success']  = "You are now logged in";


				header('location: loggedin.php');

				

			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}


function logLogin()
{
	$db = mysqli_connect('localhost', 'root', '', 'ecommercedb');


	$id = $_SESSION['varname'];
	$ip = $_SERVER['REMOTE_ADDR'];


	$sql = "INSERT INTO tbluserloginlog (id, logip) VALUES ('$id', '$ip')";

	if ($db->query($sql) === TRUE) {
    echo "Session Logged";
} else {
    echo "Error logging session: " . $sql . "<br>" . $db->error;
}
}


function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}


if (isset($_POST['addaddress_btn'])) {
	insertaddress();
}
if (isset($_POST['addcc_btn'])) {
	insertcc();
}

function insertaddress(){
	global $db, $username, $errors;

	// grap form values
	$id = $_SESSION['varname'];
	$fname = e($_POST['firstname']);
	$lname = e($_POST['lastname']);
	$addline1 = e($_POST['addline1']);
	$addline2 = e($_POST['addline2']);
	$town = e($_POST['town']);
	$city = e($_POST['city']);
	$pcode = e($_POST['pcode']);
	$mobile = e($_POST['mobile']);
	$dob = e($_POST['dob']);


	// make sure form is filled properly
	if (empty($fname)) {
		array_push($errors, "First Name Required");
	}
	if (empty($lname)) {
		array_push($errors, "Last Name Required");
	}
	if (empty($addline1)) {
		array_push($errors, "Address Lin 1 Required");
	}
	if (empty($town)) {
		array_push($errors, "Town Required");
	}
	if (empty($city)) {
		array_push($errors, "City Required");
	}
	if (empty($pcode)) {
		array_push($errors, "Postal Code Required");
	}
	if (empty($mobile)) {
		array_push($errors, "Mobile Number Required");
	}
	if (empty($dob)) {
		array_push($errors, "Date of Birth Required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {

		$query = "INSERT INTO tbluser (id, userfname, userlname, useraddline1, useraddline2, usertown, usercity, userpcode, usermobile, userdob) VALUES('$id', '$fname', '$lname', '$addline1', '$addline2', '$town', '$city', '$pcode', '$mobile', '$dob')";
		mysqli_query($db, $query);
		$_SESSION['success']  = "Address Added";
		header('location: manageUserDetails.php');

		

		
	}
}
function insertcc(){
	global $db, $username, $errors;

	// grap form values
	$id = $_SESSION['varname'];
	$ccnum = e($_POST['ccnum']);
	$ccexdate = e($_POST['ccexdate']);
	$cccvv = e($_POST['cccvv']);


	// make sure form is filled properly
	if (empty($ccnum)) {
		array_push($errors, "Credit Card Number Required");
	}
	if (empty($ccexdate)) {
		array_push($errors, "Expiration Date Required");
	}
	if (empty($cccvv)) {
		array_push($errors, "CVV Required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {

		$query = "INSERT INTO tblusercc (id, ccnumber, ccexdate, cccvv) VALUES('$id', '$ccnum', '$ccexdate', '$cccvv')";
		mysqli_query($db, $query);
		$_SESSION['success']  = "Credit Card Added";
		header('location: manageUserDetails.php');

		

		
	}
}


if(isset($_POST['delete'])){
	$checked = $_POST['checkbox'];
	foreach($checked as $useracclogid){
		mysqli_query($db, "DELETE from users where useracclogid=$useracclogid");
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if(isset($_POST['deletecc'])){
	$checked = $_POST['checkbox'];
	foreach($checked as $ccid){
		mysqli_query($db, "DELETE from tblusercc where ccid=$ccid");
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if(isset($_POST['deleteacc'])){
	$checked = $_POST['checkbox'];
	foreach($checked as $id){
		mysqli_query($db, "DELETE from users where id=$id");
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if(isset($_POST['deleteprod'])){
	$checked = $_POST['checkbox'];
	foreach($checked as $productID){
		mysqli_query($db, "DELETE from tblproducts where productID=$productID");
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if(isset($_POST['myBtn1'])){

	$id = $_SESSION['varname'];
    $productid = $_POST["hidden_productid"];

		$query = "INSERT INTO tbltempbasket (id, productid) VALUES ('$id', '$productid')";
		mysqli_query($db, $query);
		
	

			header('Location: ' . $_SERVER['HTTP_REFERER']);

}


if(isset($_POST['removebasketitem'])){
	$checked = $_POST['checkbox'];
	foreach($checked as $tempbasketid){
		mysqli_query($db, "DELETE FROM tbltempbasket WHERE tempbasketid=$tempbasketid");
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(isset($_POST['cancelorder'])){
	$checked = $_POST['checkbox'];
	foreach($checked as $orderid){
		mysqli_query($db, "DELETE FROM tblorders WHERE orderid=$orderid");
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}



if(isset($_POST['purchase'])){
	$id = $_SESSION['varname'];
	$checked = $_POST['checkbox'];
	$ccid = $_POST['checkbox1'];
	foreach($checked as $useracclogid){
		mysqli_query($db, "INSERT INTO tblorders (id, useracclogid, ccid, productid) VALUES ('$id', '$useracclogid', '$ccid')");
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
}



if(isset($_POST['confirmcheckout'])){
	    $id = $_SESSION['varname'];
		$date = date('d-m-y H:i:s');
		$_SESSION['date'] = $date;



		foreach($_POST['productid'] as $productid){
			foreach($_POST['useracclogidcheckbox'] as $useracclogid){
				foreach($_POST['ccidcheckbox'] as $ccid){
			mysqli_query($db, "INSERT INTO tblorders (id, useracclogid, ccid, productid, ordertime) VALUES ('$id', '$useracclogid', '$ccid', '$productid', '$date')");
			mysqli_query($db, "DELETE FROM tbltempbasket WHERE id=$id");
		}
	}
}
	header('Location: confirmcheckout.php');
}