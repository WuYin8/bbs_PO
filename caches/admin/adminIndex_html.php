<html>
	<head>
		<title><?=$title;?></title>
		<meta charset="utf-8"/>
		<!-- <link rel="stylesheet" type="text/css" href="../../public/css/adminIndex.css"/> -->
	</head>
	<frameset rows="90px,*" border="1" bordercolor="#B5CFD9" noresize >
		<frame src="adminTop.php" scrolling="no"/>
		<frameset cols="160px,*" border="1" bodercolor="#B5CFD9">
			<frame src="adminLeftMsg.php" scrolling="no" name="adminLeft"/>
			<frame src="adminWebMsg.php" name="adminRight"/>
		</frameset>
	</frameset>
	<noframes>
		<p>浏览器版本过低</p>
	</noframes>
</html>