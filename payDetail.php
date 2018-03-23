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

//跳转页面需要信息
$toTime = 3000;
$title = '提示 - 10分钟学院';

//用户uid与帖子id传参错误时跳转
if (empty($_GET['id']) || empty($_GET['uid'])) {
	$message = '页面出了一些问题，正在返回首页';
	$jump = 'index.php';
	$icon = '<img src="./public/img/notice.gif"/>';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}


$id = $_GET['id'];
$uid = $_GET['uid'];
$authorid = $_GET['authorid'];

//购买
$rate = dbSelect($link , 'bbs_details' , 'rate' , "id = $id")[0][0];
$payArr = ['uid'=>$uid , 'id'=>$id , 'rate'=>$rate , 'addtime'=>time() , 'ispay'=>1];
dbInsert($link , 'bbs_pay' , $payArr);

//购买失败时跳转
if (dbSelect($link , 'bbs_pay' , 'oid' , "id=$id and uid = $uid") == false) {
	$message = "订单处理失败，请联系管理员处理";
	$jump = $_SERVER['HTTP_REFERER'];
	$icon = '<img src="./public/img/notice.gif"/>';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;

}

//确认积分数量是否可以购买
$grade = dbSelect($link , 'bbs_user' , 'grade' , "uid = $uid")[0][0];
$grade = $grade - $rate;

if ($grade < 0 ) {
	dbDelete($link , 'bbs_pay' , "uid = $uid and id = $id");
	$grade = $grade + $rate;
	$message = "积分值不足";
	$jump = $_SERVER['HTTP_REFERER'];
	$icon = '<img src="./public/img/notice.gif"/>';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}

setcookie('grade' , $grade , time() + 86400);
$grade = ['grade'=>$grade];
dbUpdate($link , 'bbs_user' , $grade , "uid = $uid");

//支付给作者
$gradeA = dbSelect($link , 'bbs_user' , 'grade' , "uid = $authorid")[0][0];
$gradeA = $gradeA + $rate;
$gradeA = ['grade'=>$gradeA];
dbUpdate($link , 'bbs_user' , $gradeA , "uid = $authorid");

//支付后跳转
$message = "购买成功，积分已扣除";
$jump = "detail.php?id=$id&page=1";
$icon = '<img src="./public/img/noticeRight.gif"/>';
display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
