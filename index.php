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

//遍历需要的变量，head.php中使用，在此再声明一次
$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0 and ispass = 1');
$webName = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webName'")[0][0];
$webUrl = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webUrl'")[0][0];
$webCode = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webCode'")[0][0];
$time = date('Y-m-d H:i:s' , time());

//判断IP是否被锁定
if ($_SERVER['REMOTE_ADDR']=='::1') {
		$loginIP = '127.0.0.1';
	} else {
		$loginIP = $_SERVER['REMOTE_ADDR'];
} 

$loginIP = ip2long($loginIP);
if (dbSelect($link , 'bbs_closeip' , 'ip' , "ip = '$loginIP'" ) !== false) {
	$title = '提示 - 10分钟学院';
	$jump = '#';
	$toTime = 86400000;
	$icon = '<img src="./public/img/noticeError.gif"/>';;
	$message = "IP已被锁定，请联系管理员进行处理";
	display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}

$title = '首页 - 10分钟学院';
if (empty($_GET['jxid'])) {
	$where = 'parentid = 0 and ispass = 1';
	$big = dbSelect($link,'bbs_category' , 'classname , cid , parentid',$where , 'orderby');
} else {
	$id = (int)$_GET['jxid'];
	$where = "cid = $id and ispass = 1";
	$big =  dbSelect($link,'bbs_category' , 'classname , cid , parentid',$where , 'orderby');
}
$forumSmall = dbSelect($link , 'bbs_category' , 'classname , cid , parentid , classpic , replycount , motifcount , compere , description' , 'parentid > 0 and ispass = 1' , 'orderby');

//论坛信息栏需要的变量
$sumMotif = count(dbSelect($link , 'bbs_details d,bbs_user u' , '*' , 'u.uid = d.authorid and first = 1 and isdel = 0'));
$userCount = dbSelect($link , 'bbs_user' , 'count(*)')[0][0];
$lastTime = intval(dbSelect($link , 'bbs_user' , 'max(regtime)')[0][0]);
$lastOne = dbSelect($link , 'bbs_user' , 'username' , "regtime = '$lastTime'")[0][0];

//友情链接需要的变量
$friendLink = dbSelect($link , 'bbs_link' , '*' ,'displayorder > 0' , 'displayorder');
$topLink = dbSelect($link , 'bbs_link' , '*' ,'displayorder = 0')[0];



$vars = compact('title' , 'forumLarge' , 'big' , 'forumSmall' , 'sumMotif' , 'userCount' , 'lastOne' , 'friendLink' , 'topLink' , 'time', 'webName' , 'webUrl' , 'webCode');
display('index.html',$vars);