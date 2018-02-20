<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑菜品</title>
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
			<?php
			include './conn.php';
			date_default_timezone_set ('Asia/Shanghai');
			$id=$_GET['id'];
			$size=$_GET['size'];
			$sql=mysqli_query($link,"select * from tb_food join tb_foodsize on tb_foodsize.id=tb_food.id where tb_food.id='$id'");
			
			$result=mysqli_fetch_object($sql);
			?>
			<div class="col-md-10">
				<form method="post" action="./check_mdfood.php?id=<?php echo $result->id;?>" enctype="multipart/form-data">
					<?php do{?>
					菜名：<input type="text" name="foodname" id="foodname" value="<?php echo $result->fname;?>">
		    		种类：<select name="class">
		    			<option value="甜点" <?php if(($result->fclass)=="甜点") {echo "selected";}?>>甜点</option>
		    			<option value="主食" <?php if(($result->fclass)=="主食") {echo "selected";}?>>主食</option>
		    			<option value="饮料" <?php if(($result->fclass)=="饮料") {echo "selected";}?>>饮料</option>
		    			<option value="汤" <?php if(($result->fclass)=="汤") {echo "selected";}?>>汤</option>
		    		</select>
		    		规格：<select name="size">
		    			<option value="1"  <?php if(($result->size)==1) {echo "selected";}?>>小</option>
		    			<option value="2" <?php if(($result->size)==2) {echo "selected";}?>>中</option>
		    			<option value="3" <?php if(($result->size)==3) {echo "selected";}?>>大</option>
		    		</select>
		    		价格：<input type="text" name="price" id="price" value="<?php echo $result->price;?>">
		    		折扣：<select name="discount">
		    			<option value="0">不打折</option>
		    			<option value="5">五折</option>
		    			<option value="6">六折</option>
		    			<option value="7">七折</option>
		    			<option value="8">八折</option>
		    			<option value="9">九折</option>
		    			
		    		</select>
		    		<img src="./upfile/<?php echo $result->fphoto;?>">
		    		<input type="hidden" name="classpic" value="<?php echo $result->fphoto;?>">
		    		<input type="file" name="zp">
		    		<input type="submit" name="submit" class="btn btn-success"><br>
		    		<?php 
		    	}while($result=mysqli_fetch_object($sql));?>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
