<?php

include './common/home.php';
$link = dbConnect('localhost','root','123123','dbOne','utf8');

//站点关闭
if (dbSelect($link , 'bbs_msg' , 'isset' , 'id = 1')[0][0] == 1) {
	if (!isset($_COOKIE['username'])) {
		header('location:close.php');
		exit;
	} 
	$username = $_COOKIE['username'];
	if (dbSelect($link , 'bbs_user' , 'undertype' , "username = '$username'")[0][0] == 0) {
		header('location:close.php');
		exit;
	}
}
$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0 and ispass = 1');
$time = date('Y-m-d H:i:s' , time());
$webName = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webName'")[0][0];
$webUrl = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webUrl'")[0][0];
$webCode = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webCode'")[0][0];

//判断IP是否被锁定
if ($_SERVER['REMOTE_ADDR']=='::1') {
		$loginIP = '127.0.0.1';
	} else {
		$loginIP = $_SERVER['REMOTE_ADDR'];
} 

$loginIP = ip2long($loginIP);
if (dbSelect($link , 'bbs_closeip' , 'ip' , "ip = '$loginIP'" ) !== false) {
	$title = '提示 - 10分钟学院';
	$jump = ' # ';
	$toTime = 86400000;
	$icon = '<img src="./public/img/noticeError.gif"/>';;
	$message = "IP已被锁定，请联系管理员进行处理";
	display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}

$title = '提示 - 10分钟学院';
$toTime = 3000;
//首先判断是否登录
if (empty($_COOKIE['username'])) {
	$jump = 'index.php';
	$message = '用户名不存在，请重新登录';
	$icon = '<img src="./public/img/notice.gif"/>';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}
$cname = $_COOKIE['username'];
//判断表单数据是否有提交，无提交和有提交情况展示的页面不一样
//多个项目，多次上传，防止上传为空时报错
if (!empty($_POST['button'])) {
	//判断时间是否符合规范，不符合直接返回，不予注册
	if (isset($_POST['year']) && isset($_POST['month']) && isset($_POST['day'])) {
		$message = '日期格式不正确';
		$jump = $_SERVER['HTTP_REFERER'];
		$icon = '<img src="./public/img/notice.gif"/>';
		if ($_POST['year'] % 4 == 0 && $_POST['month'] == 2 && $_POST['day'] >29) {
			display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
			exit;
		} else if ($_POST['year'] % 4 !== 0 && $_POST['month'] == 2 && $_POST['day'] >28) {
			display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
			exit;
		}	else if (in_array($_POST['month'] , [4 , 6, 9 ,11])  && $_POST['day'] >30) {
			display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
			exit;
		}	
		$birthday = $_POST['year'] . '/' . $_POST['month'] . '/' . $_POST['day'] ;
		dbUpdate($link , 'bbs_user' ,"birthday = '$birthday'" ,"username = '$cname'");
	}
	if (isset($_POST['realname'])) {
		$realname = $_POST['realname'];
		dbUpdate($link , 'bbs_user' ,"realname = '$realname'" ,"username = '$cname'");
	}

	if (isset($_POST['sex'])) {
		$sex = $_POST['sex'];
		dbUpdate($link , 'bbs_user' ,"sex = '$sex'" ,"username = '$cname'");
	}	

	if (isset($_POST['qq'])) {
		$qq = $_POST['qq'];
		dbUpdate($link , 'bbs_user' ,"qq = '$qq'" ,"username = '$cname'");
	}	

	if (isset($_POST['place'])) {
		$place = $_POST['place'];
		dbUpdate($link , 'bbs_user' ,"place = '$place'" ,"username = '$cname'");
	}	
	$jump = $_SERVER['HTTP_REFERER'];
	$cname = $_COOKIE['username'];
	$icon = '<img src="./public/img/noticeRight.gif"/>';
	$message = "保存成功";
	display('notice.html' , compact('title', 'message', 'icon', 'toTime', 'jump', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}	
$title = '个人资料 - 10分钟学院';
display('home.html' , compact('title' , 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));




