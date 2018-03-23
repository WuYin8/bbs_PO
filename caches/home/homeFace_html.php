<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/homeFace.css"/>
	</head>
	<body>
		<!-- 头部页面 -->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/head_html.php'; ?>
		
		<!-- 设置-个人资料 -->
		
		<!-- 层叠目录 -->
		<div class="tier">
			<img src="../../public/img/tierHouse.png"/><span>></span>
			<a href="../../index.php">论坛</a><span>></span>
			<a href="../../home.php">设置</a><span>></span>
			个人资料
		</div>
		<!-- 个人资料 -->
		<div class="home">
			<!-- 目录 -->
			<div class="homeMenu">
				<ul>
					<li><h3>设置</h3></li>
					<li class="li1"><a href="../../homeFace.php">修改头像</a></li>
					<li class="li2"><a href="../../home.php">个人资料</a></li>
					<li class="li3"><a href="../../homeSign.php">个人签名</a></li>
					<li class="li4"><a href="../../homePwd.php">密码安全</a></li>
				</ul>
			</div>
			<!-- 修改头像 -->
			<div class="personData">
				<h3>当前我的头像</h3>
				<p>如果您还没有设置自己的头像，系统会显示为默认头像，您需要自己上传一张新照片来作为自己的个人头像</p>
				<div class="loginPic"><img src="<?=$_COOKIE['face'];?>" width="50px" height="50px"/></div>
				<br />
				<h3>设置我的新头像</h3>
				<form enctype="multipart/form-data" action="../../homeFace.php" method="post">
					<input type="file" name="face" />
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
					<br />
					<p class="attention">注意：文件大小不得超过2m，且只支持png/jpg/jpeg/gif格式</p>
					<br />
					<input type="submit" name="submit"  value="保存" style="background: -webkit-gradient(linear, left top, left bottom, from(#2D7BCB), to(#255DAD) );color:white;border:1px solid #235994;font-weight:bolder;font-family:'宋体';"/>
				</form>
			</div>
		</div>
		
		<!-- 尾部页面 -->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
	</body>
</html>