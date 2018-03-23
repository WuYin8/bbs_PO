<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/list.css"/>
	</head>
	<body>
	<!-- 头部页面 -->
	<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/head_html.php'; ?>
	
	<!-- 层叠目录 -->
	<div class="tier">
		<img src="../../public/img/tierHouse.png"/><span>></span>
		<a href="../../index.php">论坛</a><span>></span>
		<a href="index.php?jxid=<?=$urlBig;?>"><?=$titleBig;?></a><span>></span>
		<a href="list.php?classid=<?=$classid;?>&page=1"><?=$titleSmall;?></a>
	</div>
	
	<div class="middle">
		<!-- 侧边导航栏 -->
		<div class="left">
			<table cellspacing="0" border="1"  bordercolor="#BDD7E3">
				<tr>
					<td class="allTitle">版块导航</td>
				</tr>
			</table>
			<?php foreach ($forumLarge as $vLarge):?>
				<table cellspacing="0" border="1"  bordercolor="#BDD7E3">
					<tr>
						<td class="bigTitle"><a href="index.php?jxid=<?=$vLarge['cid'];?>"><?=$vLarge['classname'];?></a>
						<img src="../../public/img/listLeft1.png"/>
						</td>
					</tr>
					<?php foreach ($forumSmall as $vSmall):?>
					<?php if ($vSmall['parentid'] == $vLarge['cid']): ?>
						<tr>
							<td class="smallTitle"><a href="list.php?classid=<?=$vSmall['cid'];?>&page=1"><?=$vSmall['classname'];?>
							</a></td>
						</tr>
					<?php endif; ?>
					<?php endforeach;?>
				</table>
			<?php endforeach;?>
		</div>
		
		<!-- 小标题 -->
		<div class="titleSmall">
			<span class="ts1"><?=$titleSmall;?></span> 今日：<span  class="ts2"><?=$todayCount;?></span><span class="ts4">|</span>主题：<span  class="ts2"><?=$motifCount;?></span>
			<br /><br />
			版主：<span  class="ts3"><?=$compere;?></span>
		</div>
		
		<!-- 发帖按钮栏 -->
		<div class="addLine">	
			<a href="addc.php?classid=<?=$classid;?>">
				<div class="addBottun">
					发帖<img src="../../public/img/addBottun.png"/>
				</div>
			</a>
			<a href="index.php?jxid=<?=$urlBig;?>">
				<div class="backBottun">
					<img src="../../public/img/backBottun.png"/>返回
				</div>
			</a>
		</div>
		
		<!-- 帖子列表 -->
		<div class="list">
			<table cellspacing="0"  rules = "none">
				<tr class="listMenu">
					<td width="38px" align="right">筛选：</td>
					<td width = "530px"><a href="list.php?classid=<?=$classid;?>&page=1">全部</a><span>|</span><a href="list.php?classid=<?=$classid;?>&page=1&elite=1">精华</a></td>
					<td width = "85px" align = "center">作者/发帖时间</td>
					<td width = "60px" align = "center">回复/查看</td>
					<td align = "center">最后回帖</td>
				</tr>
				
				<!--筛选精品贴，展示-->
				<?php if (isset($_GET['elite'])): ?>
					<?php if ($detailsElite !== false): ?>
						<?php foreach ($detailsElite as $vElite):?>
						<?php if (!empty($vElite['uid'])): ?>
						<tr>
							<td align="right"><img src="../../public/img/detailLogo.gif" /></td>
							<td style="font-size:14px;">
								<!-- 判断是否高亮 -->
								<?php if ($vElite['ishot'] == 1): ?>
								<a href="detail.php?id=<?=$vElite['id'];?>&page=1" class = "ishot"><?=$vElite['title'];?></a>
								<?php else: ?>
								<a href="detail.php?id=<?=$vElite['id'];?>&page=1"><?=$vElite['title'];?></a>
								<?php endif; ?>
								<!-- 判断是否售价 -->
								<?php if ($vElite['rate'] > 0): ?>
									<span class="money">- [售价 <?=$vElite['rate'];?> 金钱]</span>
								<?php endif; ?>
								<!-- 判断是否置顶 -->
								<?php if ($vElite['istop'] == 1): ?>
									<span class="money">- [置顶]</span>
								<?php endif; ?>
								<img src="../../public/img/elite.gif"/>
							</td>
							<td align = "center">
								<?=$vElite['username'];?>
								<br /><?php echo date('Y-m-d' ,$vElite['addtime']);?>
							</td>
							
							<td align = "center">
							<?=$vElite['replycount'];?><span>/</span><?=$vElite['hits'];?>
							</td>
							
							<td align = "center">
							<!-- <?=$id = $vElite['id'];?> -->
							<?php if ($vElite['replycount'] == 0): ?>
							暂无回帖
							<?php else: ?>
							<?php echo  date('Y-m-d H:i:s' ,dbSelect(dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8') , 'bbs_details' , 'max(addtime)' , "tid = '$id' and isdel = 0 and isdisplay = 0")[0][0]);?>
							<?php endif; ?>
							</td>
							
						</tr>
						<?php endif; ?>
						<?php endforeach;?>
					<?php endif; ?>
				<?php elseif ($details !== false): ?>
				
				<!--无筛选，全部展示-->
					<?php foreach ($details as $vDetail):?>
					<?php if (!empty($vDetail['uid'])): ?>
						<tr>
							<td align="right"><img src="../../public/img/detailLogo.gif" /></td>
							<!-- {if判断是否为精品，售价，是否添加图表，修改颜色，分支以后在使用css添加效果} -->
							<td style="font-size:14px;">
								<!-- 判断是否高亮 -->
								<?php if ($vDetail['ishot'] == 1): ?>
									<a href="detail.php?id=<?=$vDetail['id'];?>&page=1" class="ishot"><?=$vDetail['title'];?></a>
								<?php else: ?>
									<a href="detail.php?id=<?=$vDetail['id'];?>&page=1"><?=$vDetail['title'];?></a>
								<?php endif; ?>
								<!-- 判断是否售价 -->
								<?php if ($vDetail['rate'] > 0): ?>
									<span class="money">- [售价 <?=$vDetail['rate'];?> 金钱]</span>
								<?php endif; ?>
								<!-- 判断是否置顶 -->
								<?php if ($vDetail['istop'] == 1): ?>
									<span class="money">- [置顶]</span>
								<?php endif; ?>
								<!-- 判断是否精华，加小图 -->
								<?php if ($vDetail['elite'] == 1): ?>
									<img src="../../public/img/elite.gif"/>
								<?php endif; ?>
							</td>
							
							<td align = "center">
								<?=$vDetail['username'];?>
								<br /><?php echo date('Y-m-d' ,$vDetail['addtime']);?>
							</td>
							
							<td align = "center">
							<?=$vDetail['replycount'];?><span>/</span><?=$vDetail['hits'];?>
							</td>
							
							<td align = "center">
							<!-- <?=$id = $vDetail['id'];?> -->
							<?php if ($vDetail['replycount'] == 0): ?>
							暂无回帖
							<?php else: ?>
							<?php echo  date('Y-m-d H:i:s' ,dbSelect(dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8') , 'bbs_details' , 'max(addtime)' , "tid = '$id' and isdel = 0 and isdisplay = 0")[0][0]);?>
							<?php endif; ?>
							</td>
						</tr>
						<?php endif; ?>
					<?php endforeach;?>
				<?php endif; ?>
			</table>			
		</div>
		
		<!-- 发帖按钮栏 -->
		<div class="addLine">	
			<a href="addc.php?classid=<?=$classid;?>">
				<div class="addBottun">
					发帖<img src="../../public/img/addBottun.png"/>
				</div>
			</a>
			<a href="index.php?jxid=<?=$urlBig;?>">
				<div class="backBottun">
					<img src="../../public/img/backBottun.png"/>返回
				</div>
			</a>
		</div>
		
		<!-- 分页跳转栏 -->
		<div class="limit">		
			<?php if (isset($_GET['elite'])): ?>
			<form action="listLimit.php?elite=1" method="post">
			<?php else: ?>
			<form action="listLimit.php" method="post">
			<?php endif; ?>
				<select name="page">
					<?php for ($i = 1; $i <= $pages ;$i++):?>
					<option value="<?=$i;?>"><?=$i;?></option>
					<?php endfor;?>
				</select>
				<input type="hidden" name="classid" value="<?=$classid;?>"/>
				<button>GO</button>
			</form>
			<br />
			<?php if (isset($_GET['elite'])): ?>
				<a href="list.php?classid=<?=$classid;?>&page=1&elite=1">首页</a>
				<?php if ($page > 1): ?>
				<a href="list.php?classid=<?=$classid;?>&page=<?=$page - 1;?>&elite=1">上一页</a>
				<?php endif; ?>
				<?php if ($page < $pages): ?>
				<a href="list.php?classid=<?=$classid;?>&page=<?=$page + 1;?>&elite=1">下一页</a>
				<?php endif; ?>
				<a href="list.php?classid=<?=$classid;?>&page=<?=$pages;?>&elite=1">尾页</a>
			<?php else: ?>
				<a href="list.php?classid=<?=$classid;?>&page=1">首页</a>
				<?php if ($page > 1): ?>
				<a href="list.php?classid=<?=$classid;?>&page=<?=$page - 1;?>">上一页</a>
				<?php endif; ?>
				<?php if ($page < $pages): ?>
				<a href="list.php?classid=<?=$classid;?>&page=<?=$page + 1;?>">下一页</a>
				<?php endif; ?>
				<a href="list.php?classid=<?=$classid;?>&page=<?=$pages;?>">尾页</a>
			<?php endif; ?>
			<br /><br />
			共有<?=$motifCount;?>条记录	每页显示<?=$pageCount;?>条，本页显示<?=$realCount;?>条	<?=$page;?>/<?=$pages;?>页
		</div>
	</div>
	
	<!-- 尾部页面 -->
	<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
	</body>
<html>