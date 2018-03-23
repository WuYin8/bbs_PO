<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/adminUserMsg.css"/>
	</head>
	<body>
		<!-- 编辑用户信息 -->
		<div class="title">
			编辑用户 - <?=$userMsg['username'];?>
		</div>
		<div class="titleLittle">
			基本信息
		</div>
		<hr />
		<form action = 'adminUserMsg.php' method="post">
			<b>用户名：</b><br />
			<?=$userMsg['username'];?>
			<input type = "hidden" name = "username" value = "<?=$userMsg['username'];?>"/>
			<hr />
			<b>头像：</b><br />
			<img src = "<?=$userMsg['picture'];?>" style = "width:50px; height:50px;"/>
			<hr />
			<b>新密码：</b><br />
			<input type = "password" name = "password"/>
			<hr />
			<b>清除用户安全提问：</b><br />
			<input type = "radio" name = "problem" value = "1"/>是
			<input type = "radio" name = "problem" value = "0" checked />否
			<hr />
			<b>锁定当前用户：</b><br />
			<?php if ($userMsg['allowlogin'] == '0'): ?>
			<input type = "radio" name = "allowLogin" value = "1"/>是
			<input type = "radio" name = "allowLogin" value = "0" checked />否
			<?php elseif ($userMsg['allowlogin'] == '1'): ?>
			<input type = "radio" name = "allowLogin" value = "1" checked />是
			<input type = "radio" name = "allowLogin" value = "0"/>否
			<?php endif; ?>
			<hr />
			<b>Email：</b><br />
			<input type = "text" name = "email" value = "<?=$userMsg['email'];?>"/>
			<hr />
			<b>注册IP：</b><br />
			<input type = "text" name = "regIp" value = "<?=$userMsg['regip'];?>"/>
			<hr />
			<b>注册时间：</b><br />
			<input type = "text" name = "regTime" value = "<?=$userMsg['regtime'];?>"/>
			<hr />
			<b>最近访问时间：</b><br />
			<input type = "text" name = "lastTime" value = "<?=$userMsg['lasttime'];?>"/>
			<hr />
			
			<div class="titleLittle">
			积分奖惩
			</div>
			<hr />
			<b>积分：</b><br />
			<input type = "text" name = "grade" value = "<?=$userMsg['grade'];?>"/>
			<hr />
			
			<div class="titleLittle">
			论坛选项
			</div>
			<hr />
			<b>个人签名：</b><br />
			<textarea name = "autoGraph" ><?=$userMsg['autograph'];?></textarea>
			<hr />
			
			
			<div class="titleLittle">
			用户栏目
			</div>
			<hr />
			<b>真实姓名：</b><br />
			<input type = "text" name = "realName" value = "<?=$userMsg['realname'];?>"/>
			<hr />
			<b>性别：</b><br />
			<?php if ($userMsg['sex'] == '1'): ?>
			<input type = "radio" name = "sex" value = "2"/>女
			<input type = "radio" name = "sex" value = "1" checked />男
			<?php elseif ($userMsg['sex'] == '2'): ?>
			<input type = "radio" name = "sex" value = "2" checked />女
			<input type = "radio" name = "sex" value = "1"/>男
			<?php endif; ?>
			<hr />
			<b>生日：</b><br />
			<select name="year">年
				<option value="<?=$birthday['0'];?>" selected  style="display:none;"><?=$birthday['0'];?></option>
				<?php for ($y = 1970 ; $y <= 2010 ; $y++):?>
				<option value=<?=$y;?>><?=$y;?></option>
				<?php endfor;?>
			</select>
			<select name="month">月
				<?php if (isset($birthday['1']) == true): ?><!--生日数据不存在时对应更改-->
				<option value="<?=$birthday['1'];?>" selected  style="display:none;"><?=$birthday['1'];?></option>
				<?php else: ?>
				<option selected  style="display:none;"></option>
				<?php endif; ?>
				
				<?php for ($m = 1 ; $m <= 12 ; $m++):?>
				<option value=<?=$m;?>><?=$m;?></option>
				<?php endfor;?>
			</select>
			<select name="day">日
				<?php if (isset($birthday['2']) == true): ?>
				<option value="<?=$birthday['2'];?>" selected  style="display:none;"><?=$birthday['2'];?></option>
				<?php else: ?>
				<option selected  style="display:none;"></option>
				<?php endif; ?>
				<?php for ($d = 1 ; $d <= 31 ; $d++):?>
				<option value=<?=$d;?>><?=$d;?></option>
				<?php endfor;?>									
			</select>
			<hr />
			<b>籍贯：</b><br />
			<select name="place">
				<option value="<?=$userMsg['place'];?>" selected  style="display:none;"><?=$userMsg['place'];?></option>
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
			<hr />
			
			<button>提交</button>
		</form>
		
	</body>
</html>