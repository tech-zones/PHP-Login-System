<?php
ob_start();
require_once("Include/Session.php"); ?>
<?php require_once("Include/Styles.css"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php require_once("header.php"); ?>
<?php
if(isset($_GET['token'])){
    $TokenFromURL=$_GET['token'];
if(isset($_POST["Submit"])){

$Password=mysql_real_escape_string($_POST["Password"]);
$ConfirmPassword=mysql_real_escape_string($_POST["ConfirmPassword"]);

if(empty($Password)||empty($ConfirmPassword)){
	$_SESSION["message"]="All Fields must be filled out";
}elseif($Password!==$ConfirmPassword){
	$_SESSION["message"]="Both Password Values must be Same";
	
}elseif(strlen($Password)<4){
	$_SESSION["message"]="Password Should Include at least 4 values";
	
}
else{
	global $ConnectingDB;
	$Hashed_Password=Password_Encryption($Password);
	$Query="UPDATE admin_panel SET password='$Hashed_Password' WHERE token='$TokenFromURL'";
$Execute=mysql_query($Query);
if($Execute){
	    $_SESSION["SuccessMessage"]="Password Changed Successfully";
		Redirect_To("Login.php");
}else{
		$_SESSION["message"]="Something Went Wrong Try Again!";
	        Redirect_To("Login.php");
}

	
	
}

	
}
}
?>
<?php ?>
<div>		
<?php echo Message(); ?>
<?php echo SuccessMessage(); ?></div>
<div id="centerpage">
	<form action="Reset_Password.php?token=<?php echo $TokenFromURL; ?>" method="post">
	<fieldset>

<span class="FieldInfo">New Password:</span><br><input type="password" Name="Password" value=""><br>
<span class="FieldInfo">Confirm Password:</span><br><input type="password" Name="ConfirmPassword" value="">
<br><input type="Submit" Name="Submit" value="Submit"><br>
		
		
	</fieldset>	
			
		
	</form>
	</div>

<?php require_once("footer.php"); ?>