<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/admin.css"/>
	</head>
	<body>
		<!-- 登录界面 -->
		<form action="admin.php" method="post">
			<table cellspacing="0" rules="none">
				<tr>
					<td rowspan="2" width="290px">
						<img src="../../public/img/adminTitleLogo.gif"/>
					</td>
					<td class="left" rowspan="5"></td>
					<td rowspan="5" width="6px"></td>
					<td class="project" width="60px">
						用户名：
					</td>
					<td>
						<input type="text" name="username"/>
					</td>
				</tr>
				<tr>
					<td class="project">
						密&nbsp;码：
					</td>
					<td>
						<input type="password" name="password"/>
					</td>
				</tr>
				<tr>
					<td rowspan="2" style="font-size:12px;">
						Discuz!是<a href="http://www.tencent.com">腾讯</a>旗下<a href="http://www.comsenz.com">Comsenz</a>公司推出的以社区为基础的专业建站平台，帮助网站实现一站式服务。
					</td>
					<td class="project">
						提&nbsp;问：
					</td>
					<td>
						<select name="problem">
							<option value="0" selected>无安全提问</option>
							<option value="1">母亲的名字</option>
							<option value="2">父亲的名字</option>
							<option value="3">父亲出生的城市</option>
							<option value="4">您一位老师的名字</option>
							<option value="5">您最喜欢的餐馆的名字</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="project">
						回&nbsp;答：
					</td>
					<td>
						<input type="text" name="result"/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><button>提交</button></td>
				</tr>	
			</table>
		</form>
		
		<!-- 支持信息 -->
		<div class="backMsg">
			Powered by <a href="http://www.discuz.net">Discuz!</a> V2 &copy; 2001-2011, <a href="http://www.comsenz.com">Comsenz</a> Inc.
		</div>
	</body>
</html>