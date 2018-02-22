<?php
session_start();
include '../conn.php';
$musicid=$_GET['musicid'];
$name=$_SESSION['unc'];
$sql=mysqli_query($link,"select userid from tb_user where username='$name'");
$result=mysqli_fetch_object($sql);
$uid=$result->userid;
echo $uid;
$sql2=mysqli_query($link,"select musicid from tb_collecte where userid='$uid'");
 $result2=mysqli_fetch_object($sql2);
            $a=[];
            $num=mysqli_num_rows($sql2);
            for($i=0;$i<$num;$i++)
            {
             $a[$i]=$result2->musicid;
             $result2=mysqli_fetch_object($sql2);
           }
if(in_array($musicid, $a))
{
	$sql1=mysqli_query($link,"delete from tb_collecte where userid='$uid' and musicid='$musicid'");	

}
else{
    $sql1=mysqli_query($link,"insert into tb_collecte(musicid,userid) values($musicid,$uid)");	
}
if($sql1)
{
	echo "<script>window.location.href=document.referrer;</script>";
}