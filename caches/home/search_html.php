<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/search.css"/>
	</head>
	<body>
		<!-- 头部页面 -->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/head_html.php'; ?>
	
		<div class="title">
			分类搜索结果
		</div>
		
		<div class = "titleLittle">
			关于帖子标题的搜索结果
		</div>
		<table  rules = "none" class = "searchTable">
			<tr>
				<th>主题帖标题</th>
				<th>主题帖内容</th>
				<th>作者</th>
				<th>发表时间</th>
			</tr>
			<?php if ($searchDetail == '无查询结果'): ?>
			<tr><td><?=$searchDetail;?></td></tr>
			<?php else: ?>
				<?php foreach ($searchDetail as $vDetail):?>
				<tr>
					<td><a href = "detail.php?id=<?=$vDetail['id'];?>&page=1"><?=$vDetail['title'];?></td>
					<td><?=$vDetail['content'];?></td>
					<td><?=$vDetail['username'];?></td>
					<td><?php echo date('Y-m-d H:i:s' , $vDetail['addtime']);?></td>
				</tr>
				<?php endforeach;?>
			<?php endif; ?>
		</table>
		
		<div class = "titleLittle">
			关于帖子内容的搜索结果
		</div>
		<table  rules = "none" class = "searchTable">
			<tr>
				<th>帖子内容</th>
				<th>类别</th>
				<th>作者</th>
				<th>发表时间</th>
			</tr>
			<?php if ($searchReply == '无查询结果'): ?>
			<tr><td><?=$searchReply;?></td></tr>
			<?php else: ?>
				<?php foreach ($searchReply as $vReply):?>
				<tr>
					<td><?=$vReply['content'];?></td>
					<td>
						<?php if ($vReply['first'] == 1): ?>
						<a href = "detail.php?id=<?=$vReply['id'];?>&page=1">主题帖</a>
						<?php elseif ($vReply['first'] == 0): ?>
						<a href = "detail.php?id=<?=$vReply['tid'];?>&page=1">回帖</a>
						<?php endif; ?>
					</td>
					<td><?=$vReply['username'];?></td>
					<td><?php echo date('Y-m-d H:i:s' , $vReply['addtime']);?></td>
				</tr>
				<?php endforeach;?>
			<?php endif; ?>
		</table>
		
		<div class = "titleLittle">
			关于论坛版块的搜索结果
		</div>
		<table  rules = "none" class = "searchTable">
			<tr>
				<th>版块标题</th>
				<th>版主</th>
				<th>类型与地址</th>
				<th>审核状态</th>
			</tr>
			<?php if ($searchCategory == '无查询结果'): ?>
			<tr><td><?=$searchCategory;?></td></tr>
			<?php else: ?>
				<?php foreach ($searchCategory as $vCategory):?>
				<tr>
					<td><?=$vCategory['classname'];?></td>
					<td><?=$vCategory['compere'];?></td>
					<td>
						<?php if ($vCategory['parentid'] == 0): ?>
						<a href = "index.php?jxid=<?=$vCategory['cid'];?>">大版块</a>
						<?php elseif ($vCategory['parentid'] == 1): ?>
						<a href = "list.php?classid=<?=$vCategory['cid'];?>&page=1">小版块</a>
						<?php endif; ?>
					</td>
					<td>
					<?php if ($vCategory['ispass'] == 1): ?>
					已审核
					<?php elseif ($vCategory['ispass'] == 0): ?>
					未审核
					<?php endif; ?>
					</td>
				</tr>
				<?php endforeach;?>
			<?php endif; ?>
		</table>
		
		<div class = "titleLittle">
			关于用户名的搜索结果
		</div>
		<table  rules = "none" class = "searchTable">
			<tr>
				<th>用户名</th>
				<th>权限</th>
				<th>积分</th>
				<th>注册时间</th>
			</tr>
			<?php if ($searchUser == '无查询结果'): ?>
			<tr><td><?=$searchUser;?></td></tr>
			<?php else: ?>
				<?php foreach ($searchUser as $vUser):?>
				<tr>
					<td><?=$vUser['username'];?></td>
					<td>
					<?php if ($vUser['undertype'] == 1): ?>
					管理员
					<?php elseif ($vUser['undertype'] == 0): ?>
					普通用户
					<?php endif; ?>
					</td>
					<td><?=$vUser['grade'];?></td>
					<td><?php echo date('Y-m-d H:i:s' , $vUser['regtime']);?></td>
				</tr>
				<?php endforeach;?>
			<?php endif; ?>
		</table>
		
		<div class = "titleLittle">
			关于友情链接的搜索结果
		</div>
		<table  rules = "none" class = "searchTable">
			<tr>
				<th>链接名字</th>
				<th>链接URL</th>
				<th>链接描述</th>
				<th>添加时间</th>
			</tr>
			<?php if ($searchLink == '无查询结果'): ?>
			<tr><td><?=$searchLink;?></td></tr>
			<?php else: ?>
				<?php foreach ($searchLink as $vLink):?>
				<tr>
					<td><a href = "<?=$vLink['url'];?>"><?=$vLink['name'];?></a></td>
					<td><?=$vLink['url'];?></td>
					<td><?=$vLink['description'];?></td>
					<td><?php echo date('Y-m-d H:i:s' , $vLink['addtime']);?></td>
				</tr>
				<?php endforeach;?>
			<?php endif; ?>
		</table>
		
		<!-- 尾部页面 -->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
		
	</body>
</html>

