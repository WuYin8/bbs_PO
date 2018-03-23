<?php

/*注册*/
session_start();
include './common/home.php';

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


// var_dump($_SESSION['yzm']);




$link = dbConnect('localhost','root','123123','dbOne','utf8');
 if (!empty($_POST['Button'])) {
	$name = trim($_POST['username']);
	$email = $_POST['email'];
	$code = $_POST['code'];
	
	//给提示页面的准备
	$notice = false;//是否需要切换提示页面
	$title = '找回密码 - 10分钟学院';//提示页面标题
	$toTime = 3000;//notice.html页面使用，计时回跳
	
	//验证用户名长度
	$nameLen = strlen($name);
	if (empty($name)) {
		$notice = true;
		$message[] = '用户名不能为空';
	} else if ($nameLen < 6 || $nameLen > 12) {
		$notice = true;
		$message[] = '用户名长度错误，用户名由6到12个字符组成';
		// exit();
	}

	//判断用户名是否在数据库中
	if (!dbSelect($link , 'bbs_user' , 'username' , "username = '$name'" )) {
		$message = '用户名不存在';
		$jump = $_SERVER['HTTP_REFERER'];
		$icon = '<img src="./public/img/notice.gif"/>';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}

	//验证邮箱
	 $patternEmail = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
	if (!$email) {
		$notice = true;
		$message[] = '邮箱不能为空';
	} else if (!preg_match( $patternEmail, $email)) {
		$notice = true;
		$message[] = '邮箱格式不合法';
	}
	
	//判断邮箱是否在数据库中
	if (!dbSelect($link , 'bbs_user' , 'username' , "email = '$email'" )) {
		$message = '邮箱与用户名不匹配';
		$jump = $_SERVER['HTTP_REFERER'];
		$icon = '<img src="./public/img/notice.gif"/>';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}
	
	//判断验证码
	if (strtolower($code) !== strtolower($_SESSION['yzm'])) {
		$notice = true;
		$message[] = '验证码输入错误';
	}
	
	//提示失败信息(需要的title和内容，都要在此有变量声明)
	if  ($notice) {
		$message = join('<br />' , $message);
		$jump = $_SERVER['HTTP_REFERER'];
		$icon = '<img src="./public/img/noticeError.gif"/>';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}

	
	$message = '一份邮件已发送至您的邮箱，请点击邮件中的链接修改/找回密码';
	$jump = 'index.php';
	$icon = '<img src="./public/img/noticeRight.gif"/>';
	display('notice.html', compact('title' ,'message', 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));

	
} 
$title = '用户注册 - 10分钟学院';
$var = compact('title', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode');	
display('getpass.html' , $var);