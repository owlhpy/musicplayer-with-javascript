<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>点餐系统登录页面</title>
	<script type="text/javascript" src="./bootstrap-3.3.7-dist/js/jquery.min.js"></script>
	<script type="text/javascript" src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<style type="text/css">
body {
display: flex;
min-height: 100vh;
margin: 0;
}
main {
margin: auto;
}
.hide{
	display: none;
}
		
	</style>
</head>
<body>
	<main>
		<h4>*普通用户账号：小明&nbsp;密码：aaa<br>
        管理员账户：admin&nbsp;密码：admin<br>
        或者可以选择注册账号。
		</h4>
	<div id="login">
		<form method="post" action="check_login.php">
			<div class="form-group">
				<label for="name">
					用户名
				</label>
				<input type="text" name="name" id="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="pwd">
					密码
				</label>
				<input type="password" name="pwd" id="pwd" class="form-control">
			</div>
	
		<input type="submit" name="submit" class="btn btn-success btn-block" value="登录">
		
		</form>
		<span>
			<h6>若无账号，请点击注册</h6>
		</span>
		<input type="submit" name="submit1" class="btn btn-success btn-block" onclick="change();" value="注册">
	</div>
	<div id="regist" style="display: none;">
		<form method="post" action="check_sign.php">
			<div class="form-group">
			     <label for="name">
			     	用户名
			     </label>
			    <input type="text" name="name" id="name" class="form-control"> 
			</div>
			<div class="form-group">
				<label for="pwd">
					密码
				</label>
				<input type="password" name="pwd" id="pwd" class="form-control">
			</div>
		    <div class="form-group">
		    	<label for="phone">
		    		手机号
		    	</label>
		    	<input type="text" name="phone" id="phone" class="form-control">
		    </div>
		
		<input type="submit" name="submit" class="btn btn-success btn-block" value="注册">
	    </form>
	    <span><a href="" onclick="back();"><h5>返回登录</h5></a></span>
	</div>		
	</main>
	<script type="text/javascript">
		function change(){
			document.getElementById('login').style.display="none";
			document.getElementById('regist').style.display="block";
			return false;
		}
		function back(){
			document.getElementById('login').style.display="block";
			document.getElementById('regist').style.display="none";
		}
	</script>
</body>
</html>