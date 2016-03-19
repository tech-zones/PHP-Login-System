<!DOCTYPE>

<html>
	<head>
		<title>Name</title>
	</head>
	<body>
<?php
$Password="Pakistan";
$BlowFish_Hash_Format="$2y$12$";
$Salt="MYNAMEisjazebakramking";
echo "Length :".strlen($Salt);
$Formatting_Blowfish_With_Salt=$BlowFish_Hash_Format .$Salt;
$Hash=crypt($Password,$Formatting_Blowfish_With_Salt);
echo "<br>";
echo $Hash;
$Password="12345678";
$BlowFish_Hash_Format="$2y$10$";
$Salt="MYNAMEisjazebakram12345";
echo "Length :".strlen($Salt);
$Formatting_Blowfish_With_Salt=$BlowFish_Hash_Format .$Salt;
$Hash=crypt($Password,$Formatting_Blowfish_With_Salt);
echo "<br>";
echo $Hash;
?>
	    
	</body>
</html>
