<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');
$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0');
$time = date('Y-m-d H:i:s' , time());
//调用提示页面的变量
$title = '提示 - 10分钟学院';
$jump = 'index.php';
$icon = '<img src="./public/img/notice.gif"/>';
$toTime = 3000;

//判断用户名是否为空
if (empty($_COOKIE['username'])) {
	$title = '登录管理中心';
	$vars = compact('title');
	display('admin.html',$vars);
	exit;
}
$username = $_COOKIE['username'];
//判断用户名是否存在
if (!dbSelect($link , 'bbs_user' , 'username' , "username = '$username'" )) {
	$message = '用户名不存在，请注册后再试';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time'));
	exit;
}
//判断用户名是否为管理员
$undertype = intval(dbSelect($link , 'bbs_user' , 'undertype' , "username = '$username'")[0][0]);
if ($undertype !== 1) {
	$message = '管理中心只允许管理员登录';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time'));
	exit;
}


$title = '管理中心 - 10分钟学院'	;
$vars = compact('title');
display('adminIndex.html',$vars);