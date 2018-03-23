<?php


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

//销毁cookie传参的用户名
setcookie('username','',time()-3600);
setcookie('grade','',time()-3600);
setcookie('face','',time()-3600);
setcookie('undertype','',time()-3600);
unset($_COOKIE['username']);
unset($_COOKIE['grade']);
unset($_COOKIE['face']);
unset($_COOKIE['undertype']);

//打开提示页面，自动跳转回去
$title = '退出提示 - 10分钟学院';//提示页面使用
$toTime = 3000;
$jump = $_SERVER['HTTP_REFERER'];
$icon = '<img src="./public/img/noticeRight.gif"/>';
$message = "您已退出站点，现将已游客身份浏览网站";

display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));