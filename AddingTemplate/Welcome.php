<?php require_once("Include/Session.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_login(); ?>
<!DOCTYPE>

<html>
	<head>
		<title>Welcome</title>
	</head>
	<body>
<?php
if(isset($_SESSION["User_Id"])){
echo "My Id is ".$_SESSION["User_Id"]."with the name of".$_SESSION["User_Name"].
"with the email".$_SESSION["User_Email"];}


?>
	   <h1>Welcome</h1>
	   <a href="Logout.php">Logout Now</a>
	</body>
</html>
