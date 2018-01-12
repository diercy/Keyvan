<?php 
include("../functions/connect.php");
include("../functions/funcs.php");
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="ckeditor/ckeditor.js"></script>
<script language="javascript" src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#cat").val("<?php echo $_GET["cat"] ?>");
	
	
});	
	
	
</script>
</head>

<body id="product-edit" dir="rtl">
<?php

if(isset($_GET["id"]))
{
$id=$_GET["id"];
$sql="SELECT * FROM `product` WHERE `product-id`=?";
$result=$con->prepare($sql);
$result->bindvalue(1,$id);
$result->execute();
$rows=$result->fetch(PDO::FETCH_ASSOC);
$name=$rows["name"];
$price=$rows["gheymat"];
$pic=$rows["pic"];
$info=$rows["tozihat"];
echo "<center>";
				  
if(isset($_GET["empty"]))	
{
echo "<div><font color=#C10003>تمام مشخصات را پر کنید</font></div>";
$name=$_GET["name"];
$price=$_GET["price"];
$info=$_GET["info"];
$pic=$_GET["pic"];
}
if(isset($_GET["error"]))
{
echo "<div><font color=#C10003>خطا در بروز رسانی</font></div>";
$name=$_GET["name"];
$price=$_GET["price"];
$info=$_GET["info"];
$pic=$_GET["pic"];
}
if(isset($_GET["editerror"]))	
{
echo "<div><font color=#C10003>خطا در آپلود</font></div>";
$name=$_GET["name"];
$price=$_GET["price"];
$info=$_GET["info"];
$pic=$_GET["pic"];
}
if(isset($_GET["uploaderror"]))
{
$name=$_GET["name"];
$price=$_GET["price"];
$info=$_GET["info"];
$pic=$_GET["pic"];
echo "<div><font color=#C10003>خطا در بروز رسانی</font></div>";

}
				  
echo "</center>";
?>
<form action='check-product-edit.php?id="<?= $rows["product-id"]?>"&name="<?= $rows["name"]?>"&cat="<?= $rows["cat-id"]?>"&price="<?= $rows["gheymat"]?>"&pic="<?= $rows["pic"]?>"&info="<?= $rows["tozihat"]?>"' enctype='multipart/form-data' method='post'>
<center>
	<div id=proedit-name>
	  <p>
	    <label for='name'>نام محصول</label>
      </p>
	  <p>
	    <input type='text' name='name' id='name' value='<?=$name?>'>
      </p>
	</div>
	<div id='proedit-price'>
	  <p>قیمت 
	    <label for='price'></label>
	  </p>
	  <p>
	    <input type='text' name='price' id='price' value="<?=$price?>">
      </p>
	</div>
	<div id='proedit-cat'>
	  <p>دسته
	    <label for='cat'></label>
	  </p>
	  <p>
	    <select name='cat' id='cat'>
       <?php
		$sql2="SELECT * FROM `category`";
		$result2=$con->query($sql2);
		foreach($result2 as $cat)
		{
			echo "
			<option value='".$cat["catid"]."'>".$cat["name"]."</option>
			";
		}
		?>
        </select>
      </p>
	</div>
	<div id='proedit-pic'>
	  <p>تصویر محصول
	    <label for='pic'></label>
	  </p>
	  <p>
	    <input type='file' name='pic' id='pic'>
	    <div id="proedit-up-error">
	    <?php
		if(isset($_GET["type"]))	
		echo "<div><font color=#C10003>از فایل های png,jpeg,jpg استفاده کنید</font></div>";	
		?>
	    	
	    </div>
      </p>
	</div>
	<div id='proedit-pic-show'><img src="<?=$pic?>"; height="100px" width="100px;"></div>
  <div id='proedit-info'>
    <p>توضیحات
      <label for='textarea'></label>
      </p>
    <p>
      <textarea name='info' id='info' class='ckeditor'><?= $info?></textarea>
    </p>
  </div>
  <div id='proedit-btn'><input type='submit' name='btn' value="ذخیره"></div>
</center>
</form>
<?php
}
?>
</body>
</html>
