<?php 

include('functions.php') 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<div class="header">
	
</div>
<div class="admininfo">
<div class="formcontainer">
	<form method="post" action="login.php">
		<h1 class="formcontainerheading">Login</h1>
		<div class="input-group">
			<input class="formcontainerinput" type="text" name="username" placeholder="Username" required>
		</div>
		<div class="input-group">
			<input class="formcontainerinput" type="password" name="password" placeholder="Password" required>
		</div>
		<div class="input-group">
			<button type="submit" class="btn formcontainerbutton" name="login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
			<?php echo display_error(); ?>
		</p>
	</form>
</div>
</div>
</body>
</html>