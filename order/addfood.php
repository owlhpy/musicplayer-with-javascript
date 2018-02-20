<?php

header('Content-type:text/html;charset=utf-8');
date_default_timezone_set ('Asia/Shanghai');
?>
<table class="table table-striped table-bordered">
	<tr>
		<td>
			菜名
		</td>
		<td>
			数量
		</td>
		<td>
			规格
		</td>
		<td>
			折扣
		</td>
		<td>
			价格
		</td>
		<td>
			时间
		</td>
	</tr>
	<?php
include './admin/conn.php';

$cusname=$_POST['cusname'];
$fid=$_POST['fid'];
$size=$_POST['fsize'];
$amount=$_POST['amount'];
$date=date('Y-m-d h:i:s');
$sql1=mysqli_query($link,"select cusid from tb_custom where cusname='$cusname'");
$result1=mysqli_fetch_object($sql1);
$cusid=$result1->cusid;
$sql2=mysqli_query($link,"select DISTINCT price,fclass,size,discount from tb_food inner join tb_foodsize on tb_foodsize.id=tb_food.id where price in (select price from tb_foodsize where id='$fid' and size='$size') and tb_foodsize.id='$fid'");
$result2=mysqli_fetch_object($sql2);
$price=$result2->price;
$discount=$result2->discount;
$fclass=$result2->fclass;
$status=0;
$sql3=mysqli_query($link,"insert into tb_count(cusid,id,amount,size,price,discount,fclass,createtime,status) values('$cusid','$fid','$amount','$size','$price','$discount','$fclass','$date',0)");
if(!$sql3)
{
	echo "数据无法插入数据库";
	echo $cusname."<br>";
	echo $fid."<br>";
	echo $size."<br>";
	echo $amount."<br>";
	echo $cusid."<br>";

echo $price."<br>";
echo $discount."<br>";
echo $fclass."<br>";
echo $date."<br>";
}
else{
$sql4=mysqli_query($link,"select DISTINCT fname,amount,size,price,discount,createtime from tb_count inner join tb_food ON tb_count.id=tb_food.id where tb_count.cusid='$cusid' and status=0");
$result4=mysqli_fetch_object($sql4);
do{

?>
<tr>
	<td>
		<?php echo $result4->fname;?>
	</td>
	<td>
		<?php echo $result4->amount;?>
	</td>
	<td>
		<?php echo $result4->size;?>
	</td>
	<td>
		<?php if($result4->discount==1) echo "无折扣";else echo $result4->discount;?>
	</td>
	<td>
		<?php echo ($result4->price)*($result4->discount);?>
	</td>
	<td>
		<?php echo $result4->createtime;?>
	</td>
</tr>
<?php	
}while ( $result4=mysqli_fetch_object($sql4));
}
?>
<tr>
	<td>
		<button class="btn btn-success" onclick="pay(<?php echo $cusid;?>);javascript:return false;">
			结账
		</button>
	</td>
</tr>

</table>




