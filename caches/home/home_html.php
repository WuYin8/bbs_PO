<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/home.css"/>
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
			<!-- 修改资料 -->
			<div class="personData">
				<table cellspacing="0" class="smallTitle">
					<tr>
						<td class="trTd1"></td>
						<td class="trTd2">基本资料</td>
						<td class="trTd3"></td>
					</tr>
				</table>
				<table cellspacing="0" class="data">
					<form action="home.php" method="post">
						<tr>
							<td style="width:70px;">用户名：</td>
							<td><?=$_COOKIE['username'];?></td>
						</tr>
						<tr>
							<td>真实姓名：</td>
							<td><input type="text" name="realname"/></td>
						</tr>
						<tr>
							<td>性别：</td>
							<td>
								<select name="sex">
									<option value="1">男</option>
									<option value="2">女</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>出生日期：</td>
							<td>
								<select name="year">年
									<option value="0" selected disabled style="display:none;">年</option>
									<?php for ($y = 1970 ; $y <= 2010 ; $y++):?>
									<option value=<?=$y;?>><?=$y;?></option>
									<?php endfor;?>
								</select>
								<select name="month">月
									<option value="0" selected disabled style="display:none;">月</option>
									<?php for ($m = 1 ; $m <= 12 ; $m++):?>
									<option value=<?=$m;?>><?=$m;?></option>
									<?php endfor;?>
								</select>
								<select name="day">日
									<option value="0" selected disabled style="display:none;">日</option>
									<?php for ($d = 1 ; $d <= 31 ; $d++):?>
									<option value=<?=$d;?>><?=$d;?></option>
									<?php endfor;?>									
								</select>
							</td>
						</tr>
						<tr>
							<td>所在地：</td>
							<td>
								<select name="place">
									<option value="0" selected disabled style="display:none;">--省--</option>
									<option value="北京市">北京市</option>
									<option value="天津市">天津市</option>
									<option value="河北省">河北省</option>
									<option value="山西省">山西省</option>
									<option value="内蒙古自治区">内蒙古自治区</option>
									<option value="辽宁省">辽宁省</option>
									<option value="吉林省">吉林省</option>
									<option value="黑龙江省">黑龙江省</option>
									<option value="上海市">上海市</option>
									<option value="江苏省">江苏省</option>
									<option value="浙江省">浙江省</option>
									<option value="安徽省">安徽省</option>
									<option value="福建省">福建省</option>
									<option value="江西省">江西省</option>
									<option value="山东省">山东省</option>
									<option value="河南省">河南省</option>
									<option value="湖北省">湖北省</option>
									<option value="湖南省">湖南省</option>
									<option value="广东省">广东省</option>
									<option value="广西壮族自治区">广西壮族自治区</option>
									<option value="海南省">海南省</option>
									<option value="重庆市">重庆市</option>
									<option value="四川省">四川省</option>
									<option value="贵州省">贵州省</option>
									<option value="云南省">云南省</option>
									<option value="西藏自治区">西藏自治区</option>
									<option value="陕西省">陕西省</option>
									<option value="甘肃省">甘肃省</option>
									<option value="青海省">青海省</option>
									<option value="宁夏回族自治区">宁夏回族自治区</option>
									<option value="新疆维吾尔自治区">新疆维吾尔自治区</option>
									<option value="台湾省">台湾省</option>
									<option value="香港特别行政区">香港特别行政区</option>
									<option value="澳门特别行政区">澳门特别行政区</option>
									<option value="海外">海外</option>
									<option value="其他">其他</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>QQ号码：</td>
							<td><input type="text" name="qq"/></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" name ="button" value="保存" style="background: -webkit-gradient(linear, left top, left bottom, from(#2D7BCB), to(#255DAD) );color:white;border:1px solid #235994;font-weight:bolder;font-family:'宋体';"/></td>
						</tr>
					</form>
				</table>
			</div>
		</div>
		
		<!-- 尾部页面 -->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
	</body>
</html>