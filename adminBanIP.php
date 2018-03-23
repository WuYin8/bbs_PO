<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

//判断是否有删除的传参
if (!empty($_GET)) {
	$id = $_GET['id'];
	dbDelete($link , 'bbs_closeip' , "id = $id");
	header('location:adminBanIP.php');
	exit;
}
//判断是否有提交的传参
if (!empty($_POST)) {
	$addIP = $_POST['ip1'] . '.' . $_POST['ip2'] . '.' . $_POST['ip3'] . '.' .  $_POST['ip4'];
	$addIP = ip2long($addIP);
	//对比数据库中是否已有此IP，已有IP删除后重新添加
	if (dbSelect($link , 'bbs_closeip' , 'ip' , "ip = $addIP") !== false) {
		dbDelete($link , 'bbs_closeip' , "ip = $addIP");
	}
	if (empty($_POST['banTime'])) {
		$banTime = 20 * 365 * 86400;
	} else {
		$banTime = $_POST['banTime'] * 86400;
	}
	$addTime = time();
	$overTime = $addTime + $banTime;
	$arrIP = ['ip'=>$addIP , 'addtime'=>$addTime , 'overtime'=>$overTime];
	
	dbInsert($link , 'bbs_closeip' , $arrIP);
}
$banIP = dbSelect($link , 'bbs_closeip' , 'id , ip , addtime , overtime');
display('adminBanIP.html' , compact('banIP'));