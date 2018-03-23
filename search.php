<?php

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

$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');
$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0 and ispass = 1');//头部页面用
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

$toTime = 3000;
$icon = '<img src="./public/img/notice.gif"/>';
if (empty($_POST['keywds']) && empty($_GET['keywds'])) {
	$title = '提示 - 10分钟学院';
	$jump = 'index.php';
	$message = '请输入搜索关键字';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}

//获取搜索关键字
if (empty($_POST['keywds'])) {
	$keywds = $_GET['keywds'];
} else {
	$keywds = $_POST['keywds'];
}

//在主题帖标题中搜索
$searchDetail  = dbSelect($link,'bbs_details d , bbs_user u','*',"d.authorid=u.uid and title like '%$keywds%' and first=1 and isdisplay=0 and isdel=0",'addtime desc');
if ($searchDetail == false) {
	$searchDetail = '无查询结果';
} 

//在帖子内容中搜索
$searchReply  = dbSelect($link,'bbs_details d , bbs_user u','*',"d.authorid=u.uid and content like '%$keywds%' and isdisplay=0 and isdel=0",'addtime desc');
if ($searchReply == false) {
	$searchReply = '无查询结果';
} 

//在板块列表中搜索
$searchCategory = dbSelect($link , 'bbs_category' , '*' , "classname like '%$keywds%' and ispass = 1" , 'cid');
if ($searchCategory == false) {
	$searchCategory = '无查询结果';
} 

//在用户列表中搜索
$searchUser = dbSelect($link , 'bbs_user' , '*' , "username like '%$keywds%'" , 'undertype desc , grade desc');
if ($searchUser == false) {
	$searchUser = '无查询结果';
} 

//在友情链接列表中搜索
$searchLink = dbSelect($link , 'bbs_link' , '*' , "name like '%$keywds%'" , 'displayorder');
if ($searchLink == false) {
	$searchLink = '无查询结果';
}
$title = '搜索 - 10分钟学院';
display('search.html' , compact('title' , 'forumLarge' , 'time' , 'webCode' , 'webName' , 'webUrl' , 'searchCategory' , 'searchDetail' , 'searchLink' , 'searchReply' , 'searchUser' ));