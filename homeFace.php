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

//判断上传头像是否符合要求
$mimes = ['image/png' , 'image/jpeg' , 'image/gif'];
$suffixes = ['png' , 'jpg' , 'jpeg' , 'gif'];
$result = upload('face' , $mimes , $suffixes);
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
if (!empty($_POST['submit'])) {
	$jump = $_SERVER['HTTP_REFERER'];
	if ($result['errno'] !== 200) {
		$message = $result['msg'];
		$icon = '<img src="./public/img/notice.gif"/>';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}
	//上传头像地址到数据库
	$savePath = $result['msg'];//获取上传头像的缓存路径
	dbUpdate($link , 'bbs_user' , "picture = '$savePath'" , "username = '$cname'");
	$message = '用户头像保存成功';
	$icon = '<img src="./public/img/noticeRight.gif"/>';
	//上传完成后，重新赋值给cookie，立刻刷新头像
	$face =dbSelect($link , 'bbs_user' , 'picture' , "username = '$cname'")[0][0];
	setcookie('face' , $face , time() +86400);
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}
$title = '修改头像 - 10分钟学院';
$var = compact('title', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode');
display('homeFace.html' , $var);