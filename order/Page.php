<?php 
session_start(); 
date_default_timezone_set ('Asia/Shanghai');
if(!$_SESSION['unc'])
{
	header("Location:login.php");
}
include_once("./admin/conn.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>点餐</title>
	<script type="text/javascript" src="./bootstrap-3.3.7-dist/js/jquery.min.js"></script>
	<script type="text/javascript" src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/index.css">
</head>
<body>
<div class="container">
	<div class="row">
		<h2>客人点餐页</h2>
		<div>
			客人名称:<?php echo $_GET['name'];?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="col-md-2 col-xs-2">
			<ul class="nav nav-tabs nav-stacked col-md-12" role="tablist">
	<?php
	// include './admin/conn.php';
	$sql=mysqli_query($link,"select * from tb_food order by fclass");
	$row=mysqli_fetch_object($sql);
	do{
		?>		
    <li role="presentation"><a href="#<?php echo $row->id;?>"  aria-controls="home" role="tab" data-toggle="tab"><?php echo $row->fname;?></a></li>
	<?php
     }while($row=mysqli_fetch_object($sql));?>
  </ul>
		</div>
	
			<!-- Tab panes -->
  <div class="tab-content col-md-7 col-xs-7">
  	<?php
  	// include './admin/conn.php';
	// $sql1=mysqli_query($link,"select * from tb_foodsize inner join tb_food on tb_food.id=tb_foodsize.id order by fclass");
	// $row1=mysqli_fetch_object($sql1);
	$sql=mysqli_query($link,"select * from tb_food order by fclass");
	$row=mysqli_fetch_object($sql);
	do{?>
		<div role="tabpanel" class="tab-pane" id="<?php echo $row->id;?>">
			<form method="post" action="">
				<h3><?php echo $row->fname;?></h3>
				<input type="hidden" name="cusname" value="<?php echo $_GET['name'];?>">
				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<input type="hidden" name="fclass" value="<?php echo $row->fclass;?>">
				<input type="hidden" name="discount" value="<?php echo $row->discount;?>">
				<img src="./admin/upfile/<?php echo $row->fphoto;?>">
				<div class="form-group">
					<label for="size">菜品规格</label>
					<select id="size" name="size" class="form-control">
					<?php
					// include './admin/conn.php';
					$sql2=mysqli_query($link,"select size from tb_foodsize where id='$row->id'");
					$row2=mysqli_fetch_object($sql2);
					?>
					<?php
					do{
						?>
						<option value="<?php echo $row2->size;?>">
                		<?php if(($row2->size)==1) echo "小";else if(($row2->size)==2) echo "中";else echo "大";?>
                	</option>
                	<?php
					}while($row2=mysqli_fetch_object($sql2));?>               
				</select>
				</div>
				<div class="form-group" class="col-xs-3">
					<label for="amount">菜品数量</label>
					<select id="amount" name="amount" class="form-control">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
				</div>
				
                <input type="submit" name="submit" class="btn btn-success" value="添加" onclick="check(form.cusname.value,form.id.value,form.size.value,form.amount.value);javascript:return false;">
			</form>
		</div>
	<?php
       }while($row=mysqli_fetch_object($sql));?>
  </div>

	

		<div class="col-md-3">
			<h3>我的菜品</h3>
			<div id="mine">
				
				
			</div>
			
            

		</div>
	</div> 

</div>
	<script type="text/javascript">
		
		// var http_request=false;
		var xmlObj;
		//mvar urlData;
		function check(cusname,fid,fsize,amount){
			//var urlData="cusname="+cusname+"&fid="+fid+"&fsize="+fsize+"&amount="+amount;
			
			if(window.ActiveXObject)
			{
				xmlObj=new ActiveXObject("Microsoft.XMLHTTP");
			}else if(window.XMLHttpRequest)
			{
				xmlObj=new XMLHttpRequest();
			}
			xmlObj.onreadystatechange=alertContents;
			xmlObj.open("POST","addfood.php",true);
			xmlObj.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
			// 这句很重要
			xmlObj.send("cusname="+cusname+"&fid="+fid+"&fsize="+fsize+"&amount="+amount);
			
		}
		function pay(cusid){
			//var urlData="cusname="+cusname+"&fid="+fid+"&fsize="+fsize+"&amount="+amount;
			
			if(window.ActiveXObject)
			{
				xmlObj=new ActiveXObject("Microsoft.XMLHTTP");
			}else if(window.XMLHttpRequest)
			{
				xmlObj=new XMLHttpRequest();
			}
			xmlObj.onreadystatechange=alertContents;
			xmlObj.open("POST","checkpay.php",true);
			xmlObj.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
			// 这句很重要
			xmlObj.send("cusid="+cusid);
			
		}
		

function alertContents() {
			if(xmlObj.readyState==4&&xmlObj.status==200)
			{
				document.getElementById('mine').innerHTML=xmlObj.responseText;

				
			}
		}
		document.getElementsByTagName('a')[0].click();
	</script>
</body>
</html>