<?php
ob_start();
require_once("Include/Session.php"); ?>
<?php require_once("Include/Styles.css"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php require_once("header.php"); ?>
<?php
if(isset($_POST["Submit"])){

$Email=mysql_real_escape_string($_POST["Email"]);

if(empty($Email)){
	$_SESSION["message"]="Email Required";
	Redirect_To("Recover_Account.php");
}elseif(!CheckEmailEkistsOrNot($Email)){
		$_SESSION["message"]="Email not Found";
	Redirect_To("User_Registration.php");	
}
else{
	global $ConnectingDB;
	$Query="SELECT * FROM admin_panel WHERE email='$Email'";
	$Execute=mysql_query($Query);
	if($admin=mysql_fetch_array($Execute)){
		$admin["username"];
		$admin["token"];
 $subject="Reset Password";
 $body='Hi ' .$admin["username"]. 'Here is the link to Reset you Password'.'
 http://localhost/PHPCOURSE/user_registration/AddingTemplate/Reset_Password.php?token='.$admin["token"];
 $SenderEmail="From:jazebakram@gmail.com";
 if (mail($Email, $subject, $body, $SenderEmail)) {
                $_SESSION["SuccessMessage"]="Check Email for Resetting Password";
		Redirect_To("Login.php");
                    } else {
                $_SESSION["message"]="Something Went Wrong Try Again";
	Redirect_To("User_Registration.php");
                    }
}else{
		$_SESSION["message"]="Something Went Wrong Try Again!";
	Redirect_To("User_Registration.php");
	}
	
	
}

	
}

?>
<?php ?>

<div>		
<?php echo Message(); ?>
<?php echo SuccessMessage(); ?></div>
<div id="centerpage">
	<form action="Recover_Account.php" method="post">
	<fieldset>
<span class="FieldInfo">Email:</span><br><input type="email" Name="Email" value=""><br>
<br><input type="Submit" Name="Submit" value="Submit"><br>
		
		
	</fieldset>	
			
		
	</form>
	</div>
<?php require_once("footer.php"); ?>