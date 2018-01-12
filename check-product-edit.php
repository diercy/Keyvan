<?php
include("../functions/connect.php");
include("../functions/funcs.php");
session_start();
$name=xss($_POST["name"]);
$price=xss($_POST["price"]);

if(isset($_POST["btn"]))
{
	if(empty($_POST["name"]) || empty($_POST["price"]) || empty($_POST["info"]))
	{
		header("location:product-edit.php?empty=1000");
		exit;
	}
	else
	{//notempty
		$picname=$_FILES["pic"]["name"];
		$pictype=$_FILES["pic"]["type"];
		$pictmp=$_FILES["pic"]["tmp_name"];
		if(!isset($pictmp))
		{
			$sql1="UPDATE `product` SET `cat-id` = ?, `name` = ?, `gheymat` = ?, `tozihat` = ? ' WHERE `product`.`product-id` = ?;";
			$result1=$con->prepare($sql1);
			$result1->bindvalue(1,$_POST["cat"]);
			$result1->bindvalue(2,$name);
			$result1->bindvalue(3,$price);
			$result1->bindvalue(4,$_POST["info"]);
			$result1->bindvalue(5,$_GET["id"]);
			$query1=$result1->execute();
			if($query1)
			{
				header("location:products-manage.php?edited=1010");
				exit;
			}
			else
			{//query error
				header("location:product-edit.php?error=1020&id=".$_GET["id"]."");
				exit;
			}
		}
		else
		{//select image
			if(is_uploaded_file($pictmp))
			{
				$format=array("image/png","image/jpg","image/jpeg");
				if(in_array($pictype,$format))
				{
					$hash=md5($picname.microtime()).substr($picname,-5,5);
					$location="product-image/".$hash;
					$move=move_uploaded_file($pictmp,$location);
					if($move)
					{
						$sql="UPDATE `product` SET `cat-id` = ?, `name` = ?, `gheymat` = ?, `pic` = ?, `tozihat` = ? ' WHERE `product`.`product-id` = ?;";
						$result=$con->prepare($sql);
						$result->bindvalue(1,$_POST["cat"]);
						$result->bindvalue(2,$name);
						$result->bindvalue(3,$price);
						$result->bindvalue(4,$location);
						$result->bindvalue(5,$_POST["info"]);
						$result->bindvalue(6,$_GET["id"]);
						$query=$result->execute();
						if($query)
						{
							unlink($_SESSION["pic"]);
							header("location:product-edit.php?edited=1050");
							exit;
						}
					}
					else
					{//move error
						header("location:product-edit.php?editerror=1060&id=".$_GET["id"]."");
						exit;
					}
					
				}
				else
				{
					header("location:product-edit.php?type=1040&id=".$_GET["id"]."");
					exit;
				}
			}
			else
			{//image upload error
				header("location:product-edit.php?uploaderror=1030&id=".$_GET["id"]."&name=".$_GET["name"]."&price=".$_GET["price"]."&cat=".$_GET["cat"]."&info=".$_GET["info"]."&pic=".$_GET["pic"]."");
				exit;
			}
		}
	}
}
else
{
	header("location:product-edit.php");
	exit;
}




?>