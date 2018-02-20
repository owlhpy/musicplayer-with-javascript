<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>点餐系统</title>
	<script type="text/javascript" src="../bootstrap-3.3.7-dist/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	
</head>
<body>
<div class="container">
		<div class="row">
			<h2>餐厅菜品营业管理后台</h2>
		</div>
		<div class="row">
			<div class="col-md-2">
			<?php include "./leftbar.php";?>
		   
		    </div>
		<div class="col-md-10">
			<div class="col-md-3">
				<h3>查询条件</h3>
				<form method="post" action="">
				<select id="term" name="term">
					<option value="1">今天</option>
					<option value="3">近三天</option>
					<option value="7">近一个星期</option>
				</select>
				<input type="submit" class="btn btn-success" name="submit">
				</form>			
			</div>
			<div class="col-md-11">
				<table class="table table-bordered">
					
					<tr>
						<td>类别</td>
						<td>数量</td>
						<td>营业额</td>
						
					</tr>
					<?php
					include "./conn.php";
                    date_default_timezone_set('PRC');
					$sql=mysqli_query($link,"select fclass,sum(price) as money,count(*) as shuliang from tb_count where status=1 group by fclass");
$row=mysqli_fetch_object($sql);
$term=0;
if(isset($_POST["submit"]))
{
 $term=$_POST['term'];
 if($term==1)
 {
 	$sql=mysqli_query($link,"select fclass,sum(price*discount) as money,count(*) as shuliang from tb_count where to_days(createtime) = to_days(now()) and status=1 group by fclass");
$row=mysqli_fetch_object($sql);
 }
 else if($term==7)
 {
 	$sql=mysqli_query($link,"select fclass,sum(price*discount) as money,count(*) as shuliang from tb_count where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(createtime) and status=1 group by fclass");
    $row=mysqli_fetch_object($sql);
 }
 else {
 	$sql=mysqli_query($link,"select fclass,sum(price*discount) as money,count(*) as shuliang from tb_count where DATE_SUB(CURDATE(), INTERVAL 3 DAY) <= date(createtime) and status=1 group by fclass");
    $row=mysqli_fetch_object($sql);
 }
// $sql=mysqli_query($link,"select fclass,sum(price) as money,count(*) as shuliang from tb_count '$term' group by fclass");
// $row=mysqli_fetch_object($sql);

}
// if(!$row)
// {
// echo "nothing";
// }
?>
<div><?php if($term==1) echo '今日营业额';else if($term==3) echo '近三天营业额';else if($term==7) echo '近一周营业额';else echo '全部营业额';?></div>
<?php
if($row)
{
	do{

?>


<tr>
	<td>
		<?php echo $row->fclass;?>
	</td>
	<td>
		<?php echo $row->shuliang;?>
	</td>
	<td>
		<?php echo $row->money;?>
	</td>
	
</tr>
<?php
}while($row=mysqli_fetch_object($sql));
}else{echo "暂无营业额";}
mysqli_free_result($sql);
mysqli_close($link);
?>



				</table>
		
			</div>
		</div>
	</div>
</div>
			
</body>
</html>