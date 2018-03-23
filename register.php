<?php

/*注册*/
session_start();
include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

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
// var_dump($_SESSION['yzm']);

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


$link = dbConnect('localhost','root','123123','dbOne','utf8');
 if (!empty($_POST['registerButton'])) {
	$name = trim($_POST['username']);
	$pwd = trim($_POST['password']);
	$pwd2 = trim($_POST['password2']);
	$email = $_POST['email'];
	$code = $_POST['code'];
	
	//给提示页面的准备
	$notice = false;//是否需要切换提示页面
	$title = '注册提示 - 10分钟学院';//提示页面标题
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

	//判断数据库是否存在用户名
	$nameExists = dbSelect($link , 'bbs_user' ,'uid' ,"username = '$name'");
	if ($nameExists) {
		$notice = true;
		$message[] = '用户名已存在';
	}
	
	//验证密码长度，密码是否为纯数字，两次密码是否相同
	$pattenPwd = '/\d/';
	preg_match_all($pattenPwd , $pwd , $matches);
	$matches = join('' , $matches[0]);//将密码中的数字正则出来，拼接成字符串
	
	if (strlen($pwd) < 6 || strlen($pwd) > 12) {
		$notice = true;
		$message[] = '密码长度错误，密码由6到12个字符组成';
	} else if ($pwd !== $pwd2) {
		$notice = true;
		$message[] = '两次密码不一致';
	} else if ($pwd == $matches) {
		$notice = true;
		$message[] = '密码不能为纯数字组成';
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

	//判断验证码
	if (strtolower($code) !== strtolower($_SESSION['yzm'])) {
		$notice = true;
		$message[] = '验证码输入错误';
	}
	
	//提示页面信息注册失败(需要的title和内容，都要在此有变量声明)
	if  ($notice) {
		$message = join('<br />' , $message);
		$jump = 'register.php';
		$icon = '<img src="./public/img/noticeError.gif"/>';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}

	//创建用户
	$money = 50;//自定义变量在哪里？
	if ($_SERVER['REMOTE_ADDR']=='::1') {
		$regIp = '127.0.0.1';
	} else {
		$regIp = $_SERVER['REMOTE_ADDR'];
	} 

	$regIp = ip2long($regIp);
	$data = ['username'=>$name , 'password'=>md5($pwd) , 'email'=>$email , 'undertype'=>0 , 'regtime'=>time() , 'lasttime'=>time() , 'regip'=>$regIp , 'grade'=>$money];
	$result = dbInsert($link , 'bbs_user' ,$data);
	if (!$result) {
		//提示页面信息注册失败
		$message = '注册失败，请联系管理员';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	} else {
		//注册成功后自动登录
		$result = dbSelect($link , 'bbs_user' , 'uid , username , undertype , picture , grade' ,
		'username="'.$name.'" and password="'.md5($pwd).'"', 'uid desc', 1);
		
		setcookie('uid' , $result[0]['uid'] , time() + 86400);
		setcookie('username' , $result[0]['username'] , time() + 86400);
		setcookie('undertype' , $result[0]['undertype'] , time() + 86400);
		setcookie('face' , $result[0]['picture'] , time() + 86400);
		setcookie('grade' , $result[0]['grade'] , time() + 86400);
		//提示页面信息
		$message = '感谢您的注册，现在将以会员身份登录站点';
		$jump = 'home.php';
		$icon = '<img src="./public/img/noticeRight.gif"/>';
		display('notice.html', compact('title' ,'message', 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}
} 
$title = '用户注册 - 10分钟学院';
$var = compact('title', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode');	
display('register.html' , $var);
