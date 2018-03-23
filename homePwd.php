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
if (!empty($_POST['submit'])) {
	$jump = $_SERVER['HTTP_REFERER'];
	$icon = '<img src="./public/img/noticeError.gif"/>';
	//判断旧密码是否填写
	if (empty($_POST['passwordOld'])) {
		$message = '旧密码未填写';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	} 
	$passwordOld = $_POST['passwordOld'];
	//判断旧密码是否正确
	$pwd = dbSelect($link , 'bbs_user' , 'password' , "username = '$cname'")[0][0];
	if (md5($passwordOld) !== $pwd) {
		$message = '旧密码不正确';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	} 
	
	if ($_POST['password'] == null) {
		$message = '密码未修改';
		$icon = '<img src="./public/img/notice.gif"/>';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}
	
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	// 验证密码长度，密码是否为纯数字，两次密码是否相同
	$pattenPwd = '/\d/';
	preg_match_all($pattenPwd , $password , $matches);
	$matches = join('' , $matches[0]);//将密码中的数字正则出来，拼接成字符串
	
	if (strlen($password) < 6 || strlen($password) > 12) {
		$message = '密码长度错误，密码由6到12个字符组成';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	} else if ($password !== $password2) {
		$message = '两次密码不一致';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	} else if ($password == $matches) {
		$message = '密码不能为纯数字组成';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}
	
	//判断邮箱格式是否正确
	$patternEmail = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
	if (!isset($email)) {
		
	} else if (!preg_match( $patternEmail, $email)) {
		$notice = true;
		$message[] = '邮箱格式不合法';
	}
	//提取表单中变量
	$password = md5($password);
	$email = $_POST['email'];
	$problem = $_POST['problem'];
	$result = $_POST['result'];
	dbUpdate($link , 'bbs_user' , compact('password' , 'email' , 'problem' , 'result') ,"username = '$cname'");
	//提示页面
	$message = '密码安全修改完成';
	$icon = '<img src="./public/img/noticeRight.gif"/>';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;	
}
$title = '密码安全 - 10分钟学院';
$var = compact('title', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode');
display('homePwd.html' , $var);