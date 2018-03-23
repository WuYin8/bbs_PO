<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

//限制结果集，分页，使用变量
$motifCount = count(dbSelect($link , 'bbs_user' , 'uid' , null));
$pageCount = 10;//每页设置条数
$pages = ceil($motifCount / $pageCount);//总页数
if ($pages == 0) {
	$pages  = 1;
}

$page =  $_GET['page'];//根据url获得的当前页数
$pageStart = ($page - 1) * $pageCount;//分页起始位置
if (dbSelect($link , 'bbs_user' , 'uid' , null, null , "$pageStart , $pageCount") == false) {
	$realCount = 0;
} else {
$realCount = count(dbSelect($link , 'bbs_user' , 'uid' , null , null , "$pageStart , $pageCount"));//每页实际条数
}


$user = dbSelect($link , 'bbs_user' , 'uid , username , grade , regtime , undertype , allowlogin' , null , null , "$pageStart , $pageCount");
$userCount = count($user);

//锁定，解锁用户
if (!empty($_GET['bid'])) {
	$banUid = $_GET['bid']; 
	$allowlogin = dbSelect($link , 'bbs_user' , 'allowlogin' , "uid = $banUid")[0][0];
	if ($allowlogin == '0') {
		$allowlogin = ['allowlogin'=>1];
		dbUpdate($link , 'bbs_user' , $allowlogin , "uid = $banUid");
		header("location:adminEditUser.php?page=$page");
	} elseif ($allowlogin == '1') {
		$allowlogin = ['allowlogin'=>0, 'errortimes'=>0];
		dbUpdate($link , 'bbs_user' , $allowlogin , "uid = $banUid");
		header("location:adminEditUser.php?page=$page");
	}
}


if (empty($_POST)) {
	display('adminEditUser.html' , compact('user' , 'userCount' , 'page' , 'pages' , 'motifCount' , 'realCount' , 'pageCount'));
	exit;
} else {
	//访问用户详情
	$deleteUid = $_REQUEST['uid'];
	if (is_array($deleteUid)) {
		$deleteUid = join(',', $deleteUid);
		dbDelete($link , 'bbs_details' , "authorid in ($deleteUid)");
		dbDelete($link , 'bbs_user' , "uid in ($deleteUid)");
	} else {
		dbDelete($link , 'bbs_details' , "authorid = $deleteUid");
		dbDelete($link , 'bbs_user' , "uid = $deleteUid");
	}
	header("location:adminEditUser.php?page=$page");
	exit;
}


