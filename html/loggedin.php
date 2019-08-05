<?php 
	include('functions.php');

	logLogin();

//...
?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<h1>Logged In. Redirecting to User Landing Page in 5 seconds</h1>
<h2>
	<?php

$id = $_SESSION['varname'];
$ip = $_SERVER['REMOTE_ADDR'];

echo '<div id="username">Your user ID is: '. $id .'</div>';
echo '<div id="ip">Your IP is: '. $ip .'</div>';

header( "refresh:5;index.php" );

?>
</h2>
</body>
</html>
