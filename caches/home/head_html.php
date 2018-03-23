<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/head.css"/>
	</head>
	<body>
	<!-- 顶部横栏 -->
		<div class="bgcolor"><!--设置顶栏背景颜色-->
			<div class="topRow">
				<a href="#">设为首页</a>
				<a href="#">收藏本站</a>
			</div>
			<hr style="height:1px; border:none; border-top:1px solid #E6EDF1; margin:0;"/>
			<!-- 登陆栏 -->
			<div class="login">
				<a href="../../index.php"><img src="../../public/img/headLogo.jpg" height="80px"/></a>
				<?php if (empty($_COOKIE['username'])): ?>
					<!--登录状态-未登录-->
					<div class="login3Type">
						<form action="../../login.php" method="post">
							<table  cellspacing="0">
								<tr  align="center">
									<td>用户名</td>
									<td><input type="text" name="username" /></td>
									<td class="loginTd"><input type="checkbox" name="autoLogin" value="1"/>自动登录</td>
									<td><a href = "getpass.php">找回密码</a></td>
								</tr>
								<tr  align="center">
									<td>密码</td>
									<td><input type="password" name="password"/></td>
									<td class="loginTd"><button>登录</button></td>
									<td><a href="register.php" id="loginA1"><b>立即注册</b></a></td>
								</tr>
							</table>
						</form>
					</div>
					<?php elseif ($_COOKIE['undertype'] == 1): ?>
					<!--登录状态-管理员-->
					<div class="login3Type">
						<table>
							<tr align="right">
								<td>
									<div>
										<img src="../../public/img/loginSmall.gif"/>
										<a href="home.php"><b><?=$_COOKIE['username'];?></b></a>
										<span>|</span><a href="home.php">设置</a><span>|</span><a href="admin.php">管理中心</a><span>|</span><a href="/logout.php">退出</a>
									</div>
								</td>
								<td rowspan="2" width="55px">
									<div class="loginPic"><a href="homeFace.php"><img src="<?=$_COOKIE['face'];?>" width="50px" height="50px"/></a></div>
								</td>
							</tr>
							<tr align="right">
								<td>
									<div>
										积分：<?=$_COOKIE['grade'];?><span>|</span>用户权限：管理员
									</div>
								</td>
							</tr>
						</table>
					</div>
					<?php elseif ($_COOKIE['undertype'] == 0): ?>
					<!--登录状态-普通-->
					<div class="login3Type">
						<table>
							<tr align="right">
								<td>
									<div>
										<img src="../../public/img/loginSmall.gif"/>
										<a href="home.php"><b><?=$_COOKIE['username'];?></b></a>
										<span>|</span><a href="home.php">设置</a><span>|</span><a href="/logout.php">退出</a>
									</div>
								</td>
								<td rowspan="2" width="55px">
									<div class="loginPic"><a href="homeFace.php"><img src="<?=$_COOKIE['face'];?>" width="50px" height="50px"/></a></div>
								</td>
							</tr>
							<tr align="right">
								<td>
									<div>
										积分：<?=$_COOKIE['grade'];?><span>|</span>用户权限：普通用户
									</div>
								</td>
							</tr>
						</table>
					</div>
					<?php endif; ?>
			</div>
		</div>
		<!-- 导航栏 -->
		<div class="menu">
			<ul>
				<li class="menu1"><a href="index.php">首页</a></li>
				<?php if ($forumLarge !== false): ?>
					<?php foreach ($forumLarge as $k=>$val):?>
					<li class="menu3"><a href="/index.php?jxid=<?=$val['cid'];?>"><?=$val['classname'];?></a></li>
					<?php endforeach;?>
				<?php endif; ?>
			</ul>
		</div>
		<!--搜索栏-->
		<div class="search">
			<form method="post" action="search.php" class="searchf">
				<table border="0">
					<tr>
						<td><img src="../../public/img/searchLogo.png"/></td>
						<td><input type="text" name="keywds" placeholder="请输入搜索内容"/></td>
						<td><button>搜索</button></td>
						<td class="search_td1">
							<span style="font-weight:bolder;">热搜：</span>
							<a href="search.php?keywds=活动">活动</a>
							<a href="search.php?keywds=交友">交友</a>
							<a href="search.php?keywds=教程">教程</a>
						</td>
					<tr>
				</table>
			</form>
		</div>
	</body>
</html>
