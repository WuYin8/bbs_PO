<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');
$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0');//头部页面用
$time = date('Y-m-d H:i:s' , time());//尾部页面使用

//通过正则判断是那个页面传过来的分页，需要返回到哪个页面
$patten = '/list/';
$subject = $_SERVER['HTTP_REFERER'];
if (empty($_GET['elite'])) {
	if (preg_match($patten, $subject,$matches)) {
		$classid = $_POST['classid'];
		$page = $_POST['page'];
		header("location:list.php?classid=$classid&page=$page");
		exit;
	} 
} else {
	if (preg_match($patten, $subject,$matches)) {
		$classid = $_POST['classid'];
		$page = $_POST['page'];
		header("location:list.php?classid=$classid&page=$page&elite=1");
		exit;
	}
}
	

$patten = '/detail/';
$subject = $_SERVER['HTTP_REFERER'];
if (preg_match($patten, $subject,$matches)) {
	$id = $_POST['id'];
	$page = $_POST['page'];
	header("location:detail.php?id=$id&page=$page");
	exit;
} 

$patten = '/adminEditDetails/';
$subject = $_SERVER['HTTP_REFERER'];
if (preg_match($patten, $subject,$matches)) {
	$page = $_POST['page'];
	header("location:adminEditDetails.php?page=$page");
	exit;
} 

$patten = '/adminEditReply/';
$subject = $_SERVER['HTTP_REFERER'];
if (preg_match($patten, $subject,$matches)) {
	$page = $_POST['page'];
	header("location:adminEditReply.php?page=$page");
	exit;
} 

$patten = '/adminDelDetails/';
$subject = $_SERVER['HTTP_REFERER'];
if (preg_match($patten, $subject,$matches)) {
	$page = $_POST['page'];
	header("location:adminDelDetails.php?page=$page");
	exit;
} 

$patten = '/adminDelReply/';
$subject = $_SERVER['HTTP_REFERER'];
if (preg_match($patten, $subject,$matches)) {
	$page = $_POST['page'];
	header("location:adminDelReply.php?page=$page");
	exit;
}  

$patten = '/adminEditUser/';
$subject = $_SERVER['HTTP_REFERER'];
if (preg_match($patten, $subject,$matches)) {
	$page = $_POST['page'];
	header("location:adminEditUser.php?page=$page");
	exit;
} 


$toTime = 3000;
$title = '提示 - 10分钟学院';
$message = '页面出了一些问题，正在返回首页';
$jump = 'index.php';
$icon = '<img src="./public/img/notice.gif"/>';
display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time'));
exit;