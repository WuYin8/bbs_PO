<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../../public/css/adminUpdateForum.css"/>
	</head>
	<body>
		<div class="title">
			版块管理
		</div>
		<hr />
		<form action = "adminUpdateForum.php" method = "post">
			<table >
				<tr>
					<th>版块名称</th>
					<th>显示顺序</th>
					<th>谁是版主</th>
					<th>版块描述</th>
					<th>版块ICON</th>
					<th>隐藏版块</th>
				</tr>	
				<tr>
					<td><input type="text" name = "classname" value = "<?=$category['classname'];?>"/></td>
					<td><input type="text" name = "orderby" value = "<?=$category['orderby'];?>"/></td>
					<td><input type="text" name = "compere" value = "<?=$category['compere'];?>"/></td>
					<td><input type="text" name = "description" value = "<?=$category['description'];?>"/></td>
					<td><input type="text" name = "classpic" value = "<?=$category['classpic'];?>"/></td>
					<td>
						<input type="radio" name = "ispass" value = "1" checked />不隐藏
						<input type="radio" name = "ispass" value = "0"/>隐藏
					</td>
				</tr>	
			</table>
			<button>提交</button>
		</form>
	</body>
</html>