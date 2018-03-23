<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/friendUrl.css"/>
	</head>
	<body>
		<!-- 友情链接栏 -->
		<div class="friendUP">
		<table>
			<tr>
				<?php if ($topLink !== false): ?>
					<td><img src="<?=$topLink['logo'];?>"/></td>
					<td><a href="<?=$topLink['url'];?>"><b><?=$topLink['name'];?></b></a><br />
					<?=$topLink['description'];?>
					</td>
				<?php endif; ?>
			</tr>
		</table><hr />
		<div class="friendDown">
			<?php if ($friendLink !== false): ?>
				<?php foreach ($friendLink as $vLink):?>
					<a href="<?=$vLink['url'];?>"><?=$vLink['name'];?></a> 
				<?php endforeach;?>
			<?php endif; ?>
		</div>
	</div>
	</body>
</html>