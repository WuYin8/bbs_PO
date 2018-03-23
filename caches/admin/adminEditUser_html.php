<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/adminEditUser.css"/>
	</head>
	<body>
		<!-- 用户管理 -->
		<div class="title">
			用户管理
		</div>
		<div class = "titleLittle">
			共有<?=$userCount;?>条用户记录
		</div>
		<hr />
		<form action = 'adminEditUser.php?page=<?=$page;?>' method="post">
			<table rules="none">
				<tr>
					<th></th>
					<th>用户名</th>
					<th>积分</th>
					<th>注册时间</th>
					<th>用户类型</th>
					<th>编辑</th>
				</tr>
				<?php if (empty($user)): ?>
				<?php else: ?>
				<?php foreach ($user as $vUser):?>
				<tr>
					<td><input type = "checkbox" name = "uid[]" value = "<?=$vUser['uid'];?>"/></td>
					<td><?=$vUser['username'];?></td>
					<td><?=$vUser['grade'];?></td>
					<td><?php echo date ("Y-m-d H:i:s" ,$vUser['regtime']);?></td>
					<td>
						<?php if ($vUser['undertype'] == 1): ?>
							管理员
						<?php else: ?>
							普通用户
						<?php endif; ?>
					</td>
					<td>
							<a href="adminUserMsg.php?uid=<?=$vUser['uid'];?>&page=<?=$page;?>">详情</a>
							<a href="adminEditUser.php?bid=<?=$vUser['uid'];?>&page=<?=$page;?>">
							<?php if ($vUser['allowlogin'] == 0): ?>
								锁定用户
							<?php else: ?>
								解锁
							<?php endif; ?>
							</a>
					</td>
				</tr>
				<?php endforeach;?>
				<?php endif; ?>
			</table>
			<button>多选删除</button>
		</form>
		<!-- 分页跳转栏 -->
		<div class="limit">				
			<form action="listLimit.php" method="post">
				<select name="page">
					<?php for ($i = 1; $i <= $pages ;$i++):?>
					<option value="<?=$i;?>"><?=$i;?></option>
					<?php endfor;?>
				</select>
				<button>GO</button>
			</form>
			<a href="adminEditUser.php?page=1">首页</a>
			<?php if ($page > 1): ?>
			<a href="adminEditUser.php?page=<?=$page - 1;?>">上一页</a>
			<?php endif; ?>
			<?php if ($page < $pages): ?>
			<a href="adminEditUser.php?page=<?=$page + 1;?>">下一页</a>
			<?php endif; ?>
			<a href="adminEditUser.php?page=<?=$pages;?>">尾页</a><br />
			<br />
			共有<?=$motifCount;?>条记录	每页显示<?=$pageCount;?>条，本页显示<?=$realCount;?>条	<?=$page;?>/<?=$pages;?>页
		</div>
	</body>
</html>