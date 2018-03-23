<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');
$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0 and ispass = 1');
$time = date('Y-m-d H:i:s' , time());
$webName = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webName'")[0][0];
$webUrl = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webUrl'")[0][0];
$webCode = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webCode'")[0][0];
//调用提示页面的变量
$title = '提示 - 10分钟学院';
$jump = $_SERVER['HTTP_REFERER'];
$icon = '<img src="./public/img/notice.gif"/>';
$toTime = 3000;

//判断用户名是否为空
if (empty($_POST['username'])) {
	$title = '登录管理中心';
	$vars = compact('title');
	display('admin.html',$vars);
	exit;
}
$username = $_POST['username'];
//判断用户名是否存在
if (!dbSelect($link , 'bbs_user' , 'username' , "username = '$username'" )) {
	$message = '用户名不存在，请注册后再试';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time' , 'webUrl' , 'webName' , 'webCode'));
	exit;
}
//判断用户名是否为管理员
$undertype = intval(dbSelect($link , 'bbs_user' , 'undertype' , "username = '$username'")[0][0]);
if ($undertype !== 1) {
	$message = '管理中心只允许管理员登录';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time' , 'webUrl' , 'webName' , 'webCode'));
	exit;
}
//判断密码是否正确
$password = dbSelect($link , 'bbs_user' , 'password' , "username = '$username'")[0][0];
if (md5($_POST['password']) !== $password) {
	$message = '密码不正确';
	$icon = '<img src="./public/img/noticeError.gif"/>';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time' , 'webUrl' , 'webName' , 'webCode'));
	exit;
}
//判断安全问题
$problem = dbSelect($link , 'bbs_user' , 'problem' , "username = '$username'")[0][0];
$result = dbSelect($link , 'bbs_user' , 'result' , "username = '$username'")[0][0];
if ($problem !== '0') {
	if ($_POST['problem'] !== $problem) {
		$message = "安全提问选择错误";
		display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time' , 'webUrl' , 'webName' , 'webCode'));
		exit;
	}
	if ($_POST['result'] !== $result) {
		$message = "安全提问答案错误";
		display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webUrl' , 'webName' , 'webCode'));
		exit;
	}
}
//向cookie传参,传参内容与login相同
setcookie('username' , $username , time() + 3600);
setcookie('undertype' , $undertype , time() + 3600);
$grade = dbSelect($link , 'bbs_user' , 'grade' , "username = '$username'" )[0][0];
$grade += 2 ;
dbUpdate($link , 'bbs_user' , "grade = '$grade'" , "username = '$username'");
setcookie('grade' , $grade , time() +3600);
$face =dbSelect($link , 'bbs_user' , 'picture' , "username = '$username'")[0][0];
setcookie('face' , $face , time() +3600);
header('location:adminIndex.php');