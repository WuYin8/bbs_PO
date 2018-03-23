<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/adminBanIP.css"/>
	</head>
	<body>
		<!-- 编辑用户信息 -->
		<div class="title">
			禁止IP
		</div>
		<div class="titleLittle">
			技巧提示
		</div>
		<ul>
			<li>被限制的IP地址不能访问本站</li>
			<li>有效期如果设置为空则默认禁止时间20年</li>
			<li>已有IP提交视为从当前开始重置限制时间</li>
		</ul>
		<hr />
		<table >
			<tr>
				<th></th>
				<th>IP地址</th>
				<th>限制期限/起始时间</th>
				<th>终止时间</th>
				<th>编辑</th>
			</tr>
			<tr>
				<form action = 'adminBanIP.php' method="post">
					<td>新增</td>
					<td>
						<input type="text" name = "ip1" maxlength = "3" style="width:30px;">.
						<input type="text" name = "ip2" maxlength = "3" style="width:30px;">.
						<input type="text" name = "ip3" maxlength = "3" style="width:30px;">.
						<input type="text" name = "ip4" maxlength = "3" style="width:30px;">
					</td>
					<td><input type="text" name = "banTime" style="width:30px;">天</td>
					<td></td>
					<td><button>提交</button></td>
				</form>
			</tr>
			<?php if ($banIP !== false): ?>
			<?php foreach ($banIP as $vIP):?>
				<tr>
				<td>已有</td>
				<td><?php echo long2ip($vIP['ip']);?></td>
				<td><?php echo date ("Y-m-d H:i:s" ,$vIP['addtime']);?></td>
				<td><?php echo date ("Y-m-d H:i:s" ,$vIP['overtime']);?></td>
				<td><a href="adminBanIP.php?id=<?=$vIP['id'];?>">删除</td>
				</tr>
			<?php endforeach;?>
			<?php endif; ?>
		</table>
	</body>
</html>