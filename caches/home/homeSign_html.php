<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/homeSign.css"/>
		<script type='text/javascript' src='/public/ckeditor/ckeditor.js'></script>
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
			<!-- 个人签名 -->
			<div class="personSign">
				<table cellspacing="0" class="smallTitle">
					<tr>
						<td class="trTd1"></td>
						<td class="trTd2">个人签名</td>
						<td class="trTd3"></td>
					</tr>
				</table>
				<!--富文本编辑器-->
				<div class="RTE">
					<form action="homeSign.php" method="post">
						<textarea name="content" class='ckeditor' id='textarea'></textarea>
						<input type="submit" name="submit"  value="保存" style="background: -webkit-gradient(linear, left top, left bottom, from(#2D7BCB), to(#255DAD) );color:white;border:1px solid #235994;font-weight:bolder;font-family:'宋体';"/>
					</form>
				</div>
			</div>
		</div>
		
		<!-- 尾部页面 -->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
	</body>
</html>