<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加菜品</title>
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
		    	<form method="post" action="./dealadd.php" method="post" enctype="multipart/form-data">
		    		<div class="form-group">
		    			<label for="foodname">菜名</label>
		    			<input type="text" name="foodname" id="foodname" class="form-control">
		    		</div>
		    		<div class="form-group">
		    			<label for="class">种类</label>
		    			<select name="class" id="class" class="form-control">
		    			<option value="甜点">甜点</option>
		    			<option value="主食">主食</option>
		    			<option value="饮料">饮料</option>
		    			<option value="汤">汤</option>
		    		</select>
		    		</div>
		    		<div class="form-group">
		    			<label for="price">价格</label>
		    			<input type="text" name="price" id="price" class="form-control">
		    		</div>
		    		<div class="form-group">
		    			<label for="size">规格</label>
		    			<select name="size" id="size" class="form-control">
		    			<option value="1">小</option>
		    			<option value="2">中</option>
		    			<option value="3">大</option>
		    		</select>
		    		</div>
		    		<div class="form-group">
		    			<label for="discount">折扣</label>
		    			<select name="discount" id="discount" class="form-control">
		    			<option value="1.0">不打折</option>
		    			<option value="0.5">五折</option>
		    			<option value="0.6">六折</option>
		    			<option value="0.7">七折</option>
		    			<option value="0.8">八折</option>
		    			<option value="0.9">九折</option>
		    			
		    		</select>
		    		</div>
		    		<div class="form-group">
		    			<label for="zp">上传图片</label>
		    			<input type="file" name="zp" id="zp" class="btn btn-primary" class="form-control">
		    		</div>
		    		
		    		<!-- <button id="add" onclick="adds();javascript:return false;">添加规格</button>
		    		<div id="addcontent">
		    			
		    		</div> -->
		    		<input type="submit" name="submit" class="btn btn-success" value="添加菜品">

		    	</form>
		    </div>
		</div>
		
	</div>
	<!-- <script type="text/javascript">
        function adds(){
        	var oselect = document.createElement("select");
        	oselect.options.add(new Option("小","1"));
        	oselect.options.add(new Option("中","2"));
        	oselect.options.add(new Option("大","3"));
        	document.getElementById('addcontent').appendChild(oselect);
        }
	</script> -->
</body>
</html>