<?php
include './conn.php';
$name=$_POST['foodname'];
$price=$_POST['price'];
$class=$_POST['class'];
$size=$_POST['size'];
$discount=$_POST['discount'];
$id=$_GET['id'];
$path="./upfile".$_FILES['zp']['name'];
move_uploaded_file($_FILES['zp']['tmp_name'], $path);
$file=$_FILES['zp']['name'];
if($_FILES['zp']['name']){
$path=$_FILES['zp']['name'];	
}
else{
$path=$_POST['classpic'];	
}
$sql=mysqli_query($link,"update tb_food set fname='$name',fclass='$class',fphoto='$path' where id='$id'");
$sql2=mysqli_query($link,"update tb_foodsize set price='$price',discount='$discount' where id='$id' and size='$size'");

if($sql)
	if($sql2)
	{
	echo "<script>alert('菜品修改成功');history.back();</script>";
}else{
	echo "<script>alert('菜品修改失败');history.back();</script>";
}