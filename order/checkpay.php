<?php
header('Content-type:text/html;charset=utf-8');
date_default_timezone_set ('Asia/Shanghai');
include './admin/conn.php';
$cusid=$_POST['cusid'];
$sql=mysqli_query($link,"update tb_count set status=1 where cusid='$cusid' and status=0;");
if($sql)
{
	echo "结账成功，欢迎下次光临";
}
else
{
	echo "faile";
}
