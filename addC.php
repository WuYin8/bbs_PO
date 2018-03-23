<?php

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

$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0');//头部页面用
$time = date('Y-m-d H:i:s' , time());//尾部页面使用
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


$classid = $_GET['classid'];
$title = dbSelect($link , 'bbs_category' , 'classname' , "cid = '$classid'")[0][0] . '- 发表帖子 - 10分钟学院';
$jump = $_SERVER['HTTP_REFERER'];
$toTime = 3000;
$icon = '<img src="./public/img/noticeError.gif"/>';

//层叠目录，变量
$titleSmall = dbSelect($link , 'bbs_category' , 'classname' , "cid = '$classid'")[0][0];//获取小版块名称
$parentid = dbSelect($link , 'bbs_category' , 'parentid' , "cid = '$classid'")[0][0];//获取小版块对应父id
$titleBig = dbSelect($link , 'bbs_category' , 'classname' , "cid = '$parentid'")[0][0];//获得父id对应大版块名称
$urlBig = dbSelect($link , 'bbs_category' , 'cid' , "cid = '$parentid'")[0][0];//获取父级大版块cid，用于返回页面

//判断是否登录
if (!isset($_COOKIE['username'])) {
	header('location:loginII.php');
	exit;
}

//判断是否选择论坛
if (empty($_GET)) {
	header('location:index.php');
	exit;
}

if (empty($_POST)) {
	$vars = compact('title' , 'classid' , 'titleBig' , 'titleSmall' , 'urlBig' , 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode');
	display('addC.html',$vars);
	exit;
}

//判断帖子
if (empty($_POST['title']) || empty($_POST['content'])) {
	$title = '提示 - 10分钟学院';
	$message = '标题与内容不得为空';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}
//判断标题是否符合要求
if (strlen($_POST['title']) > 60) {
	$title = '提示 - 10分钟学院';
	$message = '标题长度超过60个字节';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}
//判断验证码
if (strtolower($_POST['code']) !== strtolower($_SESSION['yzm'])) {
	$title = '提示 - 10分钟学院';
	$message = '验证码输入错误';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}

//确认无误，可以发帖
$username = $_COOKIE['username'];
$authorid = dbSelect($link , 'bbs_user' , 'uid' , "username = '$username'")[0][0];
$title = $_POST['title'];
$content = $_POST['content'];
$rate = $_POST['rate'];
if ($_SERVER['REMOTE_ADDR']=='::1') {
		$addIP = '127.0.0.1';
	} else {
		$addIP = $_SERVER['REMOTE_ADDR'];
} 
$addIP = ip2long($addIP);
$time = time();
$arr = ['title'=> $title, 'content'=> $content, 'rate'=> $rate , 'authorid'=>$authorid , 'classid'=>$classid , 'addIP'=>$addIP , 'addtime'=>$time , 'tid'=>0 , 'sid' => 0 , 'first'=>1];
dbInsert($link , 'bbs_details' , $arr);

//积分增加，重新传参
$message = '发帖成功，积分+5';
$money = dbSelect($link , 'bbs_user' , 'grade' , "username = '$username'" )[0][0];
$money += 2 ;
dbUpdate($link , 'bbs_user' , "grade = '$money'" , "username = '$username'");
setcookie('grade' , $money , time() +86400);
//凭标题获取一个id
$id = dbSelect($link , 'bbs_details' , 'id' , "title = '$title'")[0][0];
$title = '提示 - 10分钟学院';
$jump = "detail.php?id=$id&page=1";
$icon = '<img src="./public/img/noticeRight.gif"/>';
display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));