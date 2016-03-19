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
$Password=mysql_real_escape_string($_POST["Password"]);
if(empty($Email)||empty($Password)){
	$_SESSION["message"]="All Fields must be filled out";
	Redirect_To("Login.php");
}else{
	if(ConfirmingAccountActiveStatus()){
	$Found_Account=Login_Attempt($Email,$Password);
	if($Found_Account){
		$_SESSION["User_Id"]=$Found_Account['id'];
		$_SESSION["User_Name"]=$Found_Account['username'];
		$_SESSION["User_Email"]=$Found_Account['email'];
		if(isset($_POST["Remember"])){
			$ExpireTime=time()+86400;
			setcookie("SettingEmail",$Email,$ExpireTime);
			setcookie("SettingName",$Username,$ExpireTime);
		}
		
		Redirect_To("FrontPageContent.php");
	}else{
		$_SESSION["message"]="Invalid Email / Password";
	Redirect_To("Login.php");
	}
	}else{
	$_SESSION["message"]="Account Confirmation Required";
	Redirect_To("Login.php");
	}
}
}
?>
<?php ?>

<div>		
<?php echo Message(); ?>
<?php echo SuccessMessage(); ?></div>
<div id="centerpage">
<br><a href="User_Registration.php"><span class="FieldInfo">Don't Have an account? Creat One !</span></a><br>
	<form action="Login.php" method="post">
	<fieldset>
<span class="FieldInfo">Email:</span><br><input type="email" Name="Email" value=""><br>
<span class="FieldInfo">Password:</span><br><input type="password" Name="Password" value=""><br>
<input type="checkbox" Name="Remember" ><span class="FieldInfo"> &nbsp;Remember me<span class="FieldInfo"><br>
<br><a href="Recover_Account.php"><span class="FieldInfo">Forgot Password</span></a>

<br><input type="Submit" Name="Submit" value="Login"><br>
		
		
	</fieldset>	
			
		
	</form>
	</div>

<?php require_once("footer.php"); ?>