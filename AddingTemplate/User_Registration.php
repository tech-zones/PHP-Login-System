<?php
ob_start();
require_once("Include/Session.php"); ?>
<?php require_once("Include/Styles.css"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php require_once("header.php"); ?>
<?php
if(isset($_POST["Submit"])){
$Username=mysql_real_escape_string($_POST["Username"]);
$Email=mysql_real_escape_string($_POST["Email"]);
$Password=mysql_real_escape_string($_POST["Password"]);
$ConfirmPassword=mysql_real_escape_string($_POST["ConfirmPassword"]);
$Token=bin2hex(openssl_random_pseudo_bytes(40));

if(empty($Username)&&empty($Email)&&empty($Password)&&empty($ConfirmPassword)){
	$_SESSION["message"]="All Fields must be filled out";
	Redirect_To("User_Registration.php");
}elseif($Password!==$ConfirmPassword){
	$_SESSION["message"]="Both Password Values must be Same";
	Redirect_To("User_Registration.php");
	
}elseif(strlen($Password)<4){
	$_SESSION["message"]="Password Should Include at least 4 values";
	Redirect_To("User_Registration.php");
	
}elseif(CheckEmailEkistsOrNot($Email)){
		$_SESSION["message"]="Email is Already in Use";
	Redirect_To("User_Registration.php");	
}
else{
	global $ConnectingDB;
	$Hashed_Password=Password_Encryption($Password);
	$Query="INSERT INTO admin_panel(username,email,password,token,active)
	VALUES('$Username','$Email','$Hashed_Password','$Token','OFF')";
	$Execute=mysql_query($Query);
	if($Execute){
 $subject="Confirm Account";
 $body='Hi'.$Username. 'Here is the link to Active your account
 http://localhost/PHPCOURSE/user_registration/AddingTemplate/Activate.php?token='.$Token;
 $SenderEmail="From:jazebakram@gmail.com";
 if (mail($Email, $subject, $body, $SenderEmail)) {
                $_SESSION["SuccessMessage"]="Check Email for Activation";
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
	<br><a href="Login.php"><span class="FieldInfo">Already a member? Login Now!</span></a>
		<br>
	<form action="User_Registration.php" method="post">
	<fieldset>
<span class="FieldInfo">Username:</span><br><input type="text" Name="Username" value=""><br>
<span class="FieldInfo">Email:</span><br><input type="email" Name="Email" value=""><br>
<span class="FieldInfo">Password:</span><br><input type="password" Name="Password" value=""><br>
<span class="FieldInfo">Confirm Password:</span><br><input type="password" Name="ConfirmPassword" value="">
<br><input type="Submit" Name="Submit" value="Register"><br>
		
		
	</fieldset>	
			
		
	</form>
	</div>
<?php require_once("footer.php"); ?>