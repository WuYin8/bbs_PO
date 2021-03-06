<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/adminFriendLink.css"/>
	</head>
	<body>
		<!-- 管理友情链接 -->
		<div class="title">
			管理友情链接
		</div>
		未填写文字说明的项目将以紧凑型显示
		<hr />
		<form action = 'adminDeleteLink.php' method="post">
			<table rules="none">
				<tr>
					<th></th>
					<th>显示顺序</th>
					<th>站点名称</th>
					<th>站点URL</th>
					<th>文字说明</th>
					<th>LOGO地址</th>
					<th>编辑</th>
				</tr>
				<?php if (empty($friendLink)): ?>
				<?php else: ?>
				<?php foreach ($friendLink as $vLink):?>
				<tr>
					<td><input type = "checkbox" name = "lid[]" value = "<?=$vLink['lid'];?>"/></td>
					<td><?=$vLink['displayorder'];?></td>
					<td><?=$vLink['name'];?></td>
					<td><?=$vLink['url'];?></td>
					<td><?=$vLink['description'];?></td>
					<td><?=$vLink['logo'];?></td>
					<td><a href="adminDeleteLink.php?lid=<?=$vLink['lid'];?>">删除</a>
							<a href="adminUpdateLink.php?lid=<?=$vLink['lid'];?>">修改</a>
					</td>
				</tr>
				<?php endforeach;?>
				<?php endif; ?>
			</table>
			<input type = "hidden" name = "page" value = "<?=$page;?>" />
			<button>多选删除</button>
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
				<a href="adminFriendLink.php?page=1">首页</a>
				<?php if ($page > 1): ?>
				<a href="adminFriendLink.php?page=<?=$page - 1;?>">上一页</a>
				<?php endif; ?>
				<?php if ($page < $pages): ?>
				<a href="adminFriendLink.php?page=<?=$page + 1;?>">下一页</a>
				<?php endif; ?>
				<a href="adminFriendLink.php?page=<?=$pages;?>">尾页</a><br />
				<br />
				共有<?=$motifCount;?>条记录	每页显示<?=$pageCount;?>条，本页显示<?=$realCount;?>条	<?=$page;?>/<?=$pages;?>页
			</div>
		</form>
		
		<!-- 添加友情链接 -->
		<div class="title">
			添加友情链接
		</div>
		<hr />
		<form action = 'adminFriendLink.php' method="post">
			<table>
				<tr>
					<th>显示顺序</th>
					<th>站点名称</th>
					<th>站点URL</th>
					<th>文字说明</th>
					<th>LOGO地址</th>
				</tr>
				<tr>
					<td><input type="text" name="displayorder"/></td>
					<td><input type="text" name="name"/></td>
					<td><input type="text" name="url"/></td>
					<td><input type="text" name="description"/></td>
					<td><input type="text" name="logo"/></td>
				</tr>
			</table>
			<button>添加</button>
		</form>
	</body>
</html>