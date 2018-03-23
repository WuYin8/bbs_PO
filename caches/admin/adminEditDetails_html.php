<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/adminEditReply.css"/>
	</head>
	<body>
		<!-- 编辑版块信息 -->
		<div class="title">
			主帖管理
		</div>
		<hr />
		<form action = "adminEditDetails.php?page=<?=$page;?>" method = "post">
			<table>
				<tr>
					<th></th>
					<th>主贴标题</th>
					<th>版块</th>
					<th>作者</th>
					<th>发帖时间</th>
					<th>精华帖</th>
					<th>高亮帖</th>
					<th>置顶帖</th>
				</tr>
				<!-- 主贴循环 -->
				<?php foreach ($reply as $vReply):?>		
				<tr>
					<td><input type ="checkbox" name = "id[]" value = "<?=$vReply['id'];?>"/></td>
					<td><a href = "detail.php?id=<?=$vReply['id'];?>&page=1" target = "_blank"><?=$vReply['title'];?></a></td>
					
					<!-- 查询，得到版块名 -->
					<td>
						<a href = "list.php?classid=<?=$vReply['classid'];?>&page=1" target = "_blank">
						<?=$vReply['classname'];?></a>
					</td>
					
					<!-- 查询，得到用户名 -->
					<td><?=$vReply['username'];?></td>
					<td><?php echo date('Y-m-d H:i:s' ,$vReply['addtime']);?></td>
					
					<td>
						<a href="adminEditDetails.php?id=<?=$vReply['id'];?>&page=<?=$page;?>">
							<?php if ($vReply['elite'] == 0): ?>
								设为精华帖
							<?php else: ?>
								取消精华帖
							<?php endif; ?>
						</a>
					</td>
					<td>
						<a href="adminEditDetails.php?hot=<?=$vReply['id'];?>&page=<?=$page;?>">
							<?php if ($vReply['ishot'] == 0): ?>
								设为高亮帖
							<?php else: ?>
								取消高亮帖
							<?php endif; ?>
						</a>
					</td>
					<td>
						<a href="adminEditDetails.php?top=<?=$vReply['id'];?>&page=<?=$page;?>">
							<?php if ($vReply['istop'] == 0): ?>
								设为置顶帖
							<?php else: ?>
								取消置顶帖
							<?php endif; ?>
						</a>
					</td>
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
			<a href="adminEditDetails.php?page=1">首页</a>
			<?php if ($page > 1): ?>
			<a href="adminEditDetails.php?page=<?=$page - 1;?>">上一页</a>
			<?php endif; ?>
			<?php if ($page < $pages): ?>
			<a href="adminEditDetails.php?page=<?=$page + 1;?>">下一页</a>
			<?php endif; ?>
			<a href="adminEditDetails.php?page=<?=$pages;?>">尾页</a><br />
			<br />
			共有<?=$motifCount;?>条记录	每页显示<?=$pageCount;?>条，本页显示<?=$realCount;?>条	<?=$page;?>/<?=$pages;?>页
		</div>
		
	</body>
</html>