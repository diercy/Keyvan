<?php
if(!isset($_SESSION["x"]))
{
	header("location:indext.php");
	exit;
}else{
	echo "Welcome";
	
}




?>