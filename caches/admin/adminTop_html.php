<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/adminTop.css"/>
	</head>
	<body>
		<div class="topAll">
			<!-- logo -->
			<div class = "adminLogo">
				<img src = "../../public/img/adminLogo.gif"/>
			</div>
			<!-- 用户信息	-->
			<div class="cookieMsg">
				你好，创始人<b><?=$username;?></b> 
				[<a href="adminLogout.php" target="_top">退出</a>]
				<span><a href="index.php" target="_top">站点首页</a></span>
			</div>
			<!-- 主目录 -->
			<div class="menu">
				<ul>
					<li><a onclick='parent.adminLeft.location="adminLeftMsg.php";parent.adminRight.location="adminWebMsg.php";'>站点信息</a></li>
					<li><a onclick='parent.adminLeft.location="adminLeftuser.php";parent.adminRight.location="adminEditUser.php?page=1";'>用户管理</a></li>
					<li><a onclick='parent.adminLeft.location="adminLeftForum.php";parent.adminRight.location="adminEditForum.php?page=1";'>版块管理</a></li>
					<li><a onclick='parent.adminLeft.location="adminLeftDetails.php";parent.adminRight.location="adminEditDetails.php?page=1";'>帖子管理</a></li>
				</ul>
			</div>
		</div>
	</body>
</html>