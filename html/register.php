<?php 

include('functions.php') 

?>


<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="../css/css.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<div class="header">
</div>

<div class="admininfo">
<div class="formcontainer">
<form method="post" action="register.php">
	<h1 class="formcontainerheading">Register</h1>
	<div class="input-group">
		<input class="formcontainerinput" placeholder="Username" type="text" name="username" value="<?php echo $username; ?>" required>
	</div>
	<div class="input-group">
		<input class="formcontainerinput" placeholder="Email" type="email" name="email" value="<?php echo $email; ?>" required>
	</div>
	<div class="input-group">
		<input class="formcontainerinput" placeholder="Password" type="password" name="password_1" required>
	</div>
	<div class="input-group">
		<input class="formcontainerinput" placeholder="Confirm Password" type="password" name="password_2" required>
	</div>
	<div class="input-group">
		<button type="submit" class="btn formcontainerbutton" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
	<?php echo display_error(); ?>
</div>
</div>
</form>
</body>
</html>