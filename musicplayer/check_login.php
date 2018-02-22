<?php
session_start();
include 'conn.php';
$_SESSION['unc']=$_POST['name'];
$name=$_POST['name'];
$pwd=$_POST['pwd'];

$sql=mysqli_query($link,"select * from tb_user where (username='$name') and (pwd='$pwd')");
$row=mysqli_fetch_object($sql);
// if((($row->cusname)=="admin")&&($row->psd=="admin"))
// {
// 	echo "<script>window.location.href='./admin/index.php';</script>";
// }
if($sql)
{
	echo "<script>window.location.href='./index.php?name=$name';</script>";
}else{
	echo "<script>alert('用户名或密码错误');window.histroy.back();</script>";
}
