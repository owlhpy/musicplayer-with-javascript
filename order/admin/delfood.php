<?php
$id=$_GET['id'];
include './conn.php';
$sql=mysqli_query($link,"delete from tb_food where id='$id'");
$sql2=mysqli_query($link,"delete from tb_foodsize where id='$id'");
if($sql)
if($sql2)
{
	echo "<script>alert('菜品删除成功');window.location.href='./control.php';</script>";
}else{
	echo "<script>alert('菜品删除失败');history.back();</script>";
}