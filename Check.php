<?php
session_start();


if(isset ($_POST["btn"]))
{
	if ($_POST["user"]=="" || $_POST["pass"]==""){
		
		header("Location:indext.php?empty=1010");
		exit;
		
	}

	$con=mysqli_connect("localhost","root","","ftest");
	$a="Select * from `users` `username`='".$_POST["user"]."' && `password`='".$_POST["pass"]."';";
	$b=mysqli_query($a);
	$c=mysqli_num_rows($b);
	print_r($c);

	/*if ($c>0){
		
		$_SESSION["x"]=1;
		header("location:panel.php");
		exit;
		
	}else{
		header("location:indext.php?error=2020");
		exit;
		
	}*/
		echo $_POST["user"];
	echo $_POST["pass"];
	
}



?>