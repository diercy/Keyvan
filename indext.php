<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php
if (isset($_GET["empty"])){
	echo "<font color=red size=5>"."تمام مشخصات را پر کنید"."</font>"."<br><br>";
}
if (isset($_GET["error"])){
	echo "<font color=red size=5>"."مشخصات اشتباه است"."</font>"."<br><br>";
}
	
?>
<form action="Check.php" method="post">
Username:<input type="text" name="user">
<br><br>
Password:<input type="password" name="pass">
<br><br>
<input type="submit" name="btn" value="Login">
<body>
	

	
</form>

</body>
</html>