<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/getpass.css"/>
	</head>
	<body>
		<!--头部页面-->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/head_html.php'; ?>
		
		<div class="register">
			<!--注册表顶栏-->
			<div class="registerTop">
				找回密码
			</div>
			<!--注册表内容-->
			<form action="getpass.php" method="post">
				<div class="registerList1"><span>*</span>用户名：<input type="text" name="username"/></div>
				<hr />
				<div class="registerList4"><span>*</span>Email：<input type="text" name="email"/></div>
				<hr />
				<div class="registerList5"><span>*</span>验证码：<input type="text" name="code"/>
					<img src="../../helper/yzm.php" onclick="this.src='../../helper/yzm.php?'+Math.random()" id="img">
							<a href="javascript:;"  id="btn">看不清，换一张</a>
									
									<script>
										var oBtn= document.getElementById('btn');
										var oImg= document.getElementById('img');
										oBtn.onclick = function ()
										{
											oImg.src = '../../helper/yzm.php?'+Math.random();
										}
									</script>
				</div>
				<hr />
				<input type="submit" name="Button" value="提交" />
			</form>
		</div>
		
		<!--尾部页面-->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
	</body>
</html>
