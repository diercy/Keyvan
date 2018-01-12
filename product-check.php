<?php
include("../functions/connect.php");
include("../functions/funcs.php");

if(isset($_POST["btn"]))
{
	$name=xss($_POST["name"]);
	$price=xss($_POST["price"]);
	$picname=$_FILES["pic"]["name"];
	$pictype=$_FILES["pic"]["type"];
	$picsize=$_FILES["pic"]["size"];
	$pictmp=$_FILES["pic"]["tmp_name"];
	if(isset($pictmp))
	{
		if(is_uploaded_file($pictmp))
		{
			$format=array("image/png","image/jpeg","image/jpg");
			if(in_array($pictype,$format))
			{
				$hash=md5($picname.microtime()).substr($picname,-5,5);
				$location="product-image/".$hash;
				$move=move_uploaded_file($pictmp,$location);
				if($move)
				{
					if(empty($name) || empty($price) || empty($_POST["info"]))
					{
						header("location:product.php?empty=1020");
						exit;
					}
					else
					{
						$sql="INSERT INTO `product` VALUES (NULL, ?, ?, ?, ?, ?, '0');";
						$result=$con->prepare($sql);
						$result->bindvalue(1,$_POST["cat"]);
						$result->bindvalue(2,$name);
						$result->bindvalue(3,$price);
						$result->bindvalue(4,$location);
						$result->bindvalue(5,$_POST["info"]);
						$query=$result->execute();
						if($query)
						{
							header("location:product.php?insert=1030");
							exit;
						}
						else
						{
							header("location:product.php?inserterror=1040");
							exit;
						}
						
					}
				}
			}
			else
			{
				header("location:product.php?typeerror=1010");
				exit;
			}
		}
		else
		{
			header("location:product.php?picempty=1000");
			exit;
		}
	}
}





?>