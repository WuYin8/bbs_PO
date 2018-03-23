<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="./public/css/notice.css"/>
	</head>
	<body>
		<!--头部页面-->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/head_html.php'; ?>
		
		<!--提示信息-->
		<div class = "notice">
			<table  cellspacing="10px">
				<tr>
					<td rowspan="2" style="vertical-align:top;">
						<?=$icon;?></td>
					<td>	
						<div class="noticeMsg">
							<?=$message;?>
							<script type="text/javascript" reload="1">setTimeout("location.href='<?=$jump;?>';", <?=$toTime;?>);</script>
							<!-- JS实现跳转 -->
						</div>请稍后……
					</td>
				</tr>
				<tr>
					<td><a href="<?=$jump;?>">如果您的浏览器没有跳转，请点击此链接</a></td>
				</tr>
			</table>
		</div>
		
		<!--尾部页面-->
		<?php include 'D:/app/wamp64/www/php1714/bbsOne/caches/home/foot_html.php'; ?>
	</body>
</html>