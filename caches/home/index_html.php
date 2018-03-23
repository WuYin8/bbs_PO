<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/index.css"/>
	</head>
	<body>
	<!-- 头部页面 -->
	<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/head_html.php'; ?>
	
	<!-- 层叠目录与论坛信息 -->
	<div class="tier">
		<img src="../../public/img/tierHouse.png"/><span>></span>
		<a href="../../index.php">论坛</a>
	</div>
	<div class="classMsg">
		<img src="../../public/img/classMsg.png"/>帖子：<?=$sumMotif;?><span>|</span>会员：<?=$userCount;?><span>|</span>欢迎新会员：<?=$lastOne;?>
	</div>
	<!-- 板块内容 --> 
	<?php if ($big !== false): ?>
		<?php foreach ($big as $k=>$v):?>
		<div class="forum">
			<!-- 标题 -->
			<div class="forumLarge">
			<a href="/index.php?jxid=<?=$v['cid'];?>"><?=$v['classname'];?></a>
			</div>
			<!-- 列表 -->
			<div class="forumSmall">
				<table  rules="none">
					<?php if ($forumSmall !== false): ?>
						<?php foreach ($forumSmall as $key => $value):?>
						<?php if ($value['parentid'] == $v['cid']): ?>
							<tr>
								<td width="50px" align="center"><a href="/index.php?classid=<?=$value['cid'];?>&page=1"><img src="<?=$value['classpic'];?>" width = "40px" height = "40px"/></a></td>
								<td><a href="/list.php?classid=<?=$value['cid'];?>&page=1"> <b><?=$value['classname'];?></b></a><br />
								版主：<span><?=$value['compere'];?></span></td>
								
								<!-- 版块内发帖数与回帖数，也是要查询其他表 -->
								<td width="50px">
									<span>
										<!-- <?=$classid = $value['cid'];?> -->
										<?php if (dbSelect(dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8') , 'bbs_details d,bbs_user u' , 'id' , "u.uid=d.authorid and classid = '$classid' and first = 0 and isdel = 0") == false): ?>
										0
										<?php else: ?>
											<?php echo count(dbSelect(dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8') , 'bbs_details d,bbs_user u' , 'id' , "u.uid=d.authorid and classid = '$classid' and first = 0 and isdel = 0"));?>
										<?php endif; ?>
									</span>
									/
									<?php if (dbSelect(dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8') , 'bbs_details d,bbs_user u' , 'id' , "u.uid=d.authorid and classid = '$classid' and first = 1 and isdel = 0 ") == false): ?>
									0
									<?php else: ?>
										<?php echo count(dbSelect(dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8') , 'bbs_details d,bbs_user u' , 'id' , "u.uid=d.authorid and classid = '$classid' and first = 1 and isdel = 0"));?>
									<?php endif; ?>
								</td>
								<td width="230px"><span><?=$value['description'];?></span></td>
							</tr>
						<?php endif; ?>
						<?php endforeach;?>
					<?php endif; ?>
				</table>
			</div>
		</div>
		<?php endforeach;?>
	<?php endif; ?>
	<!-- 友情链接 -->
	<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/friendUrl_html.php'; ?>
	
	<!-- 尾部页面 -->
	<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
	</body>
<html>