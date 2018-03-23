<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/adminEditReply.css"/>
	</head>
	<body>
		<!-- 编辑版块信息 -->
		<div class="title">
			回帖管理
		</div>
		<hr />
		<form action = "adminEditReply.php?page=<?=$page;?>" method = "post">
			<table>
				<tr>
					<th></th>
					<th>回复内容</th>
					<th>版块</th>
					<th>作者</th>
					<th>回复时间</th>
				</tr>
				<!-- 回帖循环 -->
				<?php foreach ($reply as $vReply):?>		
				<tr>
					<td><input type ="checkbox" name = "id[]" value = "<?=$vReply['id'];?>"/></td>
					<td><a href = "detail.php?id=<?=$vReply['tid'];?>&page=1" target = "_blank"><?=$vReply['content'];?></a></td>
					
					<!-- 根据本表的classid，三表联查，得到版块名 -->
					<td>
						<a href = "list.php?classid=<?=$vReply['classid'];?>&page=1" target = "_blank">
						<?=$vReply['classname'];?></a>
					</td>
					
					<!-- 根据本表的authorid，三表联查，得到用户名 -->
					<td><?=$vReply['username'];?></td>
					<td><?php echo date('Y-m-d H:i:s' ,$vReply['addtime']);?></td>
					
				</tr>	
				<?php endforeach;?>
			</table>
			<button>多选放入回收站</button>
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
			<a href="adminEditReply.php?page=1">首页</a>
			<?php if ($page > 1): ?>
			<a href="adminEditReply.php?page=<?=$page - 1;?>">上一页</a>
			<?php endif; ?>
			<?php if ($page < $pages): ?>
			<a href="adminEditReply.php?page=<?=$page + 1;?>">下一页</a>
			<?php endif; ?>
			<a href="adminEditReply.php?page=<?=$pages;?>">尾页</a><br />
			<br />
			共有<?=$motifCount;?>条记录	每页显示<?=$pageCount;?>条，本页显示<?=$realCount;?>条	<?=$page;?>/<?=$pages;?>页
		</div>
	</body>
</html>