<?php
session_start();
include 'conn.php';
$name=$_POST['name'];
$pwd=$_POST['pwd'];
$_SESSION['unc']=$name;
$sql=mysqli_query($link,"insert into tb_user(username,pwd) values('$name','$pwd')");
if($sql)
{
	echo "<script>window.location.href='./index.php?name=$name';</script>";
}