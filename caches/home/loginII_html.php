<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/loginII.css"/>
	</head>
	<body>
	<!-- 头部页面 -->
	<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/head_html.php'; ?>
	
	<!-- 登录部分 -->
	<div class="loginII">
		<!--顶栏-->
		<div class="loginIITop">
			<img src="../../public/img/notice.gif"/>
			游客止步，请登录后再继续操作
		</div>
		<!--内容-->
		<div class="title">
			用户登录
		</div>
		<form action="../../login.php" method="post">
			<div class="name">
				用户名：<input type="text" name="username"/>
				<a href="register.php">立即注册</a>
			</div>
			<hr />
			<div class="pwd">
				密码：<input type="password" name="password"/>
				<a href="getpass.php">找回密码</a>
			</div>
			<hr />
			<div class="problem">安全提问：
				<select name="problem">
									<option value="0" selected>无安全提问</option>
									<option value="1">母亲的名字</option>
									<option value="2">父亲的名字</option>
									<option value="3">父亲出生的城市</option>
									<option value="4">您一位老师的名字</option>
									<option value="5">您最喜欢的餐馆的名字</option>
				</select>
			</div>
			<hr />
			<div class="result">答案：<input type="text" name="result"/></div>
			<hr />
			<div class="autologin"><input type="checkbox" name="autoLogin" value="1" />自动登录</div>
			<hr />
			<button>登录</button>
		</form>
	</div>
	
	<!-- 尾部页面 -->
	<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
	</body>
<html>