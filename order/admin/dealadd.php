<?php
date_default_timezone_set ('Asia/Shanghai');
include "./conn.php";
$name=$_POST['foodname'];
$class=$_POST['class'];
$size=$_POST['size'];
$price=$_POST['price'];
$discount=$_POST['discount'];
if(!is_dir("./upfile"))
{
mkdir("./upfile");
};
$path="upfile/".$_FILES['zp']['name'];
move_uploaded_file($_FILES['zp']['tmp_name'], $path);
$file=$_FILES['zp']['name'];
echo $file;
$sql1=mysqli_query($link,"insert into tb_food(fname,fclass,fphoto) values('$name','$class','$file')");
$sql2=mysqli_query($link,"insert into tb_foodsize(id,size,price,discount) values((select id from tb_food where fname='$name'),'$size','$price','$discount')");
//$sql2=mysqli_query($link,"insert into tb_foodsize ");
if($sql1&&$sql2)

{
	echo "<script>alert('菜品添加成功');window.location.href='./addfood.php';</script>";
}else{
	echo "<script>alert('菜品添加失败');history.back();</script>";
}
