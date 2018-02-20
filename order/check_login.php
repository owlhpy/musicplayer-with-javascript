<?php
session_start();
include './admin/conn.php';
$_SESSION['unc']=$_POST['name'];
$name=$_POST['name'];
$pwd=$_POST['pwd'];

$sql=mysqli_query($link,"select * from tb_custom where (cusname='$name') and (psd='$pwd')");
$row=mysqli_fetch_object($sql);
if((($row->cusname)=="admin")&&($row->psd=="admin"))
{
	echo "<script>window.location.href='./admin/index.php';</script>";
}
if($sql)
{
	echo "<script>window.location.href='./Page.php?name=$name';</script>";
}else{
	echo "<script>alert('用户名或密码错误');window.histroy.back();</script>";
}