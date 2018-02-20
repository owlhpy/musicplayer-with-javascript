<?php
$name=$_POST['name'];
$phone=$_POST['phone'];
$pwd=$_POST['pwd'];
include './admin/conn.php';
$sql=mysqli_query("insert into tb_custom(cusname,psd,contact) values('$name','$pwd','$phone')");
if($sql)
{
	echo "<script>window.location.href='./index.php?name=$name';</script>";
}