<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/detail.css"/>
		<script type='text/javascript' src='/public/ckeditor/ckeditor.js'></script>
	</head>
	<body>
	<!-- 头部页面 -->
	<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/head_html.php'; ?>
	
	<!-- 层叠目录 --><!--需要调整-->
	<div class="tier">
		<img src="../../public/img/tierHouse.png"/><span>></span>
		<a href="../../index.php">论坛</a><span>></span>
		<a href="index.php?jxid=<?=$urlBig;?>"><?=$titleBig;?></a><span>></span>
		<a href="list.php?classid=<?=$classid;?>&page=1"><?=$titleSmall;?></a><span>></span>
		<?=$title1;?>
	</div>
	
	<!-- 发帖回帖按钮栏 -->
	<div class="addLine">
		<a href="addc.php?classid=<?=$classid;?>">
			<div class="addBottun">
				发帖<img src="../../public/img/addBottun.png"/>
			</div>
		</a>
		<a href="#replyEdit">
			<div class="addBottun">
				回复<img src="../../public/img/addBottun.png"/>
			</div>
		</a>
		<a  href="list.php?classid=<?=$classid;?>&page=1">
			<div class="backBottun">
				<img src="../../public/img/backBottun.png"/>返回
			</div>
		</a>
	</div>
	
	<!-- 主贴控制栏 -->
	<?php if (!empty($_COOKIE['username'])): ?>
		<?php if ($_COOKIE['undertype'] == 1): ?>
			<div class = "adminDetail">
				<a href = "detail.php?id=<?=$id;?>&del=<?=$id;?>">
				<?php if ($detail['isdel'] == 0): ?>
				回收主贴
				<?php endif; ?>
				</a><span class = "gray">|</span>
				
				<a href = "detail.php?id=<?=$id;?>&top=<?=$id;?>">
				<?php if ($detail['istop'] == 0): ?>
				设为置顶
				<?php else: ?>
				取消置顶
				<?php endif; ?>
				</a><span class = "gray">|</span>
				
				<a href = "detail.php?id=<?=$id;?>&hot=<?=$id;?>">
				<?php if ($detail['ishot'] == 0): ?>
				设为高亮
				<?php else: ?>
				取消高亮
				<?php endif; ?>
				</a><span class = "gray">|</span>
				
				<a href = "detail.php?id=<?=$id;?>&elite=<?=$id;?>">
				<?php if ($detail['elite'] == 0): ?>
				设为精华
				<?php else: ?>
				取消精华
				<?php endif; ?>
				</a>
			</div>
			
		<?php endif; ?>
	<?php endif; ?>
	
	<!--主贴页面-->
	<?php if ($page == 1): ?>
	<table class = "detail" cellspacing = "0" rules = "0">
		<tr height = "70px">
			<td width = "140px" style = "border-bottom:1px dashed #CDCDCD; border-right:1px solid #CDCDCD;  background-color:#E5EDF2; text-align:center;">
				查看：<span class = "orange"><?=$detail['hits'];?></span>
				<span class = "gray">|</span>
				回复：<span class = "orange"><?=$replyCount + $reReplyCount;?></span>
				<br /><br />
				<?=$author['username'];?>
			</td>
			<td>
				<div class = "titleLeft">
					<span><?=$detail['title'];?></span>
					<br /><br />
					<img src = "../../public/img/detailPerson.gif"/>发表于<?php echo date('Y-m-d H:i:s' , $detail['addtime']);?>
				</div>
				<div class = "titleRight">
					楼主<br /><br />
					<form action = "detail.php?id=<?=$id;?>&page=1" method = "post">
						电梯直达第<input type = "text" name = "floor" maxlength = "3" style="width:30px;">层
						<button>GO</button>
					</form>
				</div>
			</td>
		</tr>
		<tr>
			<td style = "border-right:1px solid #CDCDCD;  background-color:#E5EDF2; text-align:center;">
				<br />
				<img src = "<?=$author['picture'];?>" width = "50px" height = "50px"/>
				<br /><br />
				<?php if ($author['undertype'] == 1): ?>
				<span class = "orange">管理员</span>
				<?php else: ?>
				<span class = "orange">普通用户</span>
				<?php endif; ?><br /><br />
				<span class = "orange"><?php gradeName($author['grade'],$author['undertype']);?></span>
				<br /><br />
			</td>
			
			<td style = "vertical-align:top;">
				<!-- 主贴内容，金币贴判断 -->
				<?php if ($rate == 0): ?>
					<div class = "content">
						<?=$detail['content'];?>
					</div>
				<?php elseif (empty($_COOKIE['username'])): ?>
						<div class = "content2">
							<img src = "../../public/img/lockDetail.gif"/>本主题需向作者支付 <b><?=$rate;?> 积分</b> 才能浏览
							<span><img src = "../../public/img/payDetail.gif"/><a href = "loginII.php"><b>请登陆后购买</b></a></span>
						</div>
				<?php else: ?>
						<!-- <?=$uid = $userFile['uid'];?> -->
						<?php if ($userFile['uid'] == $author['uid'] || $_COOKIE['undertype'] == 1): ?>
							<div class = "content">
								<?=$detail['content'];?>
							</div>
						
						<?php elseif (dbSelect(dbConnect('localhost' , 'root' , '123123' , 'dbOne' , 'utf8') , 'bbs_pay' , 'oid' , "uid = $uid and id = $id and ispay = 1") == false): ?>
							<div class = "content2">
								<img src = "../../public/img/lockDetail.gif"/>本主题需向作者支付 <b><?=$rate;?> 积分</b> 才能浏览
								<span><img src = "../../public/img/payDetail.gif"/><a href = "payDetail.php?id=<?=$id;?>&uid=<?=$uid;?>&authorid=<?=$author['uid'];?>"><b>购买主题</b></a></span>
							</div>
						<?php else: ?>
							<div class = "content">
								<?=$detail['content'];?>
							</div>
						<?php endif; ?>
					
				<?php endif; ?>
			</td>
			
		</tr>
		<tr>
			<td style = "border-right:1px solid #CDCDCD;  background-color:#E5EDF2"></td>
			<td>
				<div class = "action">
					<img src = "../../public/img/detailReply.gif"/><a href="#replyEdit">回复</a>
				</div>
				<!-- 主贴控制栏 -->
				<?php if (!empty($_COOKIE['username'])): ?>
					<?php if ($_COOKIE['undertype'] == 1): ?>
						<div class = "adminDetail2">
							<a href = "detail.php?id=<?=$id;?>&del=<?=$id;?>">
							<?php if ($detail['isdel'] == 0): ?>
							回收主贴
							<?php endif; ?>
							</a><span class = "gray">|</span>
							
							<a href = "detail.php?id=<?=$id;?>&top=<?=$id;?>">
							<?php if ($detail['istop'] == 0): ?>
							设为置顶
							<?php else: ?>
							取消置顶
							<?php endif; ?>
							</a><span class = "gray">|</span>
							
							<a href = "detail.php?id=<?=$id;?>&hot=<?=$id;?>">
							<?php if ($detail['ishot'] == 0): ?>
							设为高亮
							<?php else: ?>
							取消高亮
							<?php endif; ?>
							</a><span class = "gray">|</span>
							
							<a href = "detail.php?id=<?=$id;?>&elite=<?=$id;?>">
							<?php if ($detail['elite'] == 0): ?>
							设为精华
							<?php else: ?>
							取消精华
							<?php endif; ?>
							</a>
						</div>					
					<?php endif; ?>	
					
				<?php endif; ?>
			</td>
		</tr>
	</table>
	<?php endif; ?>
	
	<!-- 回帖页面 -->
	<?php if ($reply !== false): ?>
		<?php foreach ($reply as $value):?>
		<?php if (!empty($value['uid'])): ?>
		<table class = "reply" cellspacing = "0" rules = "0">
			<tr height = "40px">
				<td width = "140px" style = "border-bottom:1px dashed #CDCDCD; border-right:1px solid #CDCDCD;  background-color:#E5EDF2; text-align:center;">
				<?=$value['username'];?>
				</td>
				<td>
					<div class = "titleLeft">
						<img src = "../../public/img/detailPerson.gif"/>发表于<?php echo date('Y-m-d H:i:s' , $value['addtime']);?>
					</div>
					<div class = "titleRight2">
						<?php echo floorJump ($value['tid'],$value['id']);?>
						<?php floorName($value['tid'],$value['id']);?>
					</div>
				</td>
			</tr>
			<tr>
				<td style = "border-right:1px solid #CDCDCD;  background-color:#E5EDF2; text-align:center;">
					<br />
					
					<img src = "<?=$value['picture'];?>" width = "50px" height = "50px"/>
					<br /><br />
					<?php if ($value['undertype'] == 1): ?>
					<span class = "orange">管理员</span>
					<?php else: ?>
					<span class = "orange">普通用户</span>
					<?php endif; ?><br /><br />
					<span class = "orange"><?php gradeName($value['grade'],$value['undertype']);?></span>
					<br /><br />
				</td>
				<td style = "vertical-align:top;">
					<?php if ($value['isdisplay'] == 0): ?>
					<div class = "content">
						<?=$value['content'];?>
					</div>
					<?php elseif ($value['isdisplay'] == 1): ?>
					<div class = "content2">
						<img src = "../../public/img/detailDisplay.gif"/><b>此回帖已被管理员屏蔽</b> 
					</div>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td style = "border-right:1px solid #CDCDCD;  background-color:#E5EDF2"></td>
				<td>
					<div class = "action">
						<img src = "../../public/img/detailReply.gif"/><a href="detail.php?id=<?=$id;?>&page=1&sid=<?=$value['id'];?>#replyEdit">回复</a>
					</div>
					<!-- 回贴控制栏 -->
					<?php if (!empty($_COOKIE['username'])): ?>
						<?php if ($_COOKIE['undertype'] == 1): ?>
							<div class = "adminDetail2">
								<a href = "detail.php?id=<?=$id;?>&del=<?=$value['id'];?>">
								<?php if ($value['isdel'] == 0): ?>
								回收回帖
								<?php endif; ?>
								</a><span class = "gray">|</span>
								
								<a href = "detail.php?id=<?=$id;?>&top=<?=$value['id'];?>">
								<?php if ($value['istop'] == 0): ?>
								设为置顶
								<?php else: ?>
								取消置顶
								<?php endif; ?>
								</a><span class = "gray">|</span>
								
								<a href = "detail.php?id=<?=$id;?>&display=<?=$value['id'];?>">
								<?php if ($value['isdisplay'] == 0): ?>
								屏蔽回帖
								<?php else: ?>
								取消屏蔽
								<?php endif; ?>
								</a>
							</div>
						<?php endif; ?>	
					<?php endif; ?>
				</td>
			</tr>
			<?php if ($value['sid'] == -1): ?>
				<!-- <?=$sid = $value['id'];?> -->
				<!-- <?=$reReply = dbSelect(dbConnect('localhost' , 'root' , '123123' , 'dbOne' , 'utf8'),'bbs_user u, bbs_details d','*',"u.uid=d.authorid and sid=$sid and isdel=0", null );?> -->
				<?php if ($reReply !== false): ?>
				<tr>
					<td style = "border-right:1px solid #CDCDCD;  background-color:#E5EDF2"></td>
					<td class = "reReply">
						<div style = "margin:0 auto;width:100%; max-height:200px;overflow:auto;">
						<?php foreach ($reReply as $vRe):?>
						<?php if (!empty($vRe['uid'])): ?>
							<hr />
							<b><?=$vRe['username'];?>回复于<?php echo date('Y-m-d H:i:s' ,$vRe['addtime']);?>
							:</b>
							<?=$vRe['content'];?>
						<?php endif; ?>
						<?php endforeach;?>
						</div>
					</td>
				</tr>
				<?php endif; ?>
			<?php endif; ?>
		</table>
		<?php endif; ?>
		<?php endforeach;?>
	<?php endif; ?>
	
	<!-- 发帖按钮栏 -->
	<div class="addLine">
		<a href="addc.php?classid=<?=$classid;?>">
			<div class="addBottun">
				发帖<img src="../../public/img/addBottun.png"/>
			</div>
		</a>
		<a href="#replyEdit">
			<div class="addBottun">
				回复<img src="../../public/img/addBottun.png"/>
			</div>
		</a>
		<a  href="list.php?classid=<?=$classid;?>&page=1">
			<div class="backBottun">
				<img src="../../public/img/backBottun.png"/>返回
			</div>
		</a>
	</div>
	
	<!-- 分页跳转栏 -->
	<div class="limit">				
		<form action="listLimit.php" method="post">
			<select name="page">
				<?php for ($i = 1; $i <= $pages ;$i++):?>
				<option value="<?=$i;?>"><?=$i;?></option>
				<?php endfor;?>
			</select>
			<input type="hidden" name="id" value="<?=$id;?>"/>
			<button>GO</button>
		</form>
		<a href="detail.php?id=<?=$id;?>&page=1">首页</a>
		<?php if ($page > 1): ?>
		<a href="detail.php?id=<?=$id;?>&page=<?=$page - 1;?>">上一页</a>
		<?php endif; ?>
		<?php if ($page < $pages): ?>
		<a href="detail.php?id=<?=$id;?>&page=<?=$page + 1;?>">下一页</a>
		<?php endif; ?>
		<a href="detail.php?id=<?=$id;?>&page=<?=$pages;?>">尾页</a><br />
		共有<?=$replyCount;?>条回帖	每页显示<?=$pageCount;?>条，本页显示<?=$realCount;?>条	<?=$page;?>/<?=$pages;?>页
	</div>
	
	<!-- 回帖编辑处 -->
	<div id = "replyEdit">
		<div class = "replyPicture">
		<?php if (!empty($_COOKIE['username'])): ?>
			<img src = "<?=$userFile['picture'];?>" width="45px" height = "45px"/><br />
			<?=$userFile['username'];?>
		<?php else: ?>
			<img src = "../../public/img/avatarBlank.gif" width="45px" height = "45px"/><br />
			未登录
		<?php endif; ?>
		</div>
		<div class = "replyAdd">
		<?php if (empty($_GET['sid'])): ?>
		<!-- <?=$sid = 0;?> -->
		<?php else: ?>
		<!-- <?=$sid = $_GET['sid'];?> -->
		<?php endif; ?>
			<form action = "detail.php?id=<?=$id;?>&sid=<?=$sid;?>&page=1" method = "post">
				<textarea name="content" class='ckeditor' id='textarea'></textarea><br />
				<input type="submit" name="submit"  value="发表回复" style="background: -webkit-gradient(linear, left top, left bottom, from(#2D7BCB), to(#255DAD) );color:white;border:1px solid #235994;font-weight:bolder;font-family:'宋体';"/>
			</form>
		</div>	
	</div>
	
	<!-- 尾部页面 -->
	<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
	</body>
<html>