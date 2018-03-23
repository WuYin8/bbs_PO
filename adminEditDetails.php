<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

//限制结果集，分页，使用变量
$motifCount = count(dbSelect($link , 'bbs_details' , '*' , "first = '1' and isdel = '0'"));
$pageCount = 10;//每页设置条数
$pages = ceil($motifCount / $pageCount);//总页数
if ($pages == 0) {
	$pages  = 1;
}
$page =  $_GET['page'];//根据url获得的当前页数
$pageStart = ($page - 1) * $pageCount;//分页起始位置
if (dbSelect($link , 'bbs_details' , 'title' , "first = '1' and isdel = '0'" ,null , "$pageStart , $pageCount") == false) {
	$realCount = 0;
} else {
$realCount = count(dbSelect($link , 'bbs_details' , 'title' , "first = '1'  and isdel = '0'" , null , "$pageStart , $pageCount"));//每页实际条数
}


//判断是否存在加精的传参
if (!empty($_GET['id'])) {
	$id = $_GET['id']; 
	$elite = dbSelect($link , 'bbs_details' , 'elite' , "id = $id")[0][0];
	if ($elite == '0') {
		$elite = ['elite'=>1];
		dbUpdate($link , 'bbs_details' , $elite , "id = $id");
		header("location:adminEditDetails.php?page=$page");
	} elseif ($elite == '1') {
		$elite = ['elite'=>0];
		dbUpdate($link , 'bbs_details' , $elite , "id = $id");
		header("location:adminEditDetails.php?page=$page");
	}
}
//判断是否存在高亮的传参
if (!empty($_GET['hot'])) {
	$id = $_GET['hot']; 
	$ishot = dbSelect($link , 'bbs_details' , 'ishot' , "id = $id")[0][0];
	if ($ishot == '0') {
		$ishot = ['ishot'=>1];
		dbUpdate($link , 'bbs_details' , $ishot , "id = $id");
		header("location:adminEditDetails.php?page=$page");
	} elseif ($ishot == '1') {
		$ishot = ['ishot'=>0];
		dbUpdate($link , 'bbs_details' , $ishot , "id = $id");
		header("location:adminEditDetails.php?page=$page");
	}
}
//判断是否存在置顶的传参
if (!empty($_GET['top'])) {
	$id = $_GET['top']; 
	$istop = dbSelect($link , 'bbs_details' , 'istop' , "id = $id")[0][0];
	if ($istop == '0') {
		$istop = ['istop'=>1];
		dbUpdate($link , 'bbs_details' , $istop , "id = $id");
		header("location:adminEditDetails.php?page=$page");
	} elseif ($istop == '1') {
		$istop = ['istop'=>0];
		dbUpdate($link , 'bbs_details' , $istop , "id = $id");
		header("location:adminEditDetails.php?page=$page");
	}
}

//判断是否存在删除的传参
if (!empty($_POST['id'])) {
	$displayID = $_POST['id'];
	$displayID = join(',', $displayID);
	$display = ['isdel'=>1];
	dbUpdate($link , 'bbs_details' , $display , "tid in ($displayID)");
	dbUpdate($link , 'bbs_details' , $display , "id in ($displayID)");
	// header('location:adminEditReply.php');
	// exit;
}

$reply = selectThree($link , '*' , 'bbs_details' , 'bbs_user' , 'bbs_category' , 'authorid' , 'uid' , 'classid' , 'cid' , 'first = 1 and isdel = 0' , null , "$pageStart , $pageCount");
display('adminEditDetails.html' , compact('reply' , 'author' , 'page' , 'pages' , 'motifCount' , 'pageCount' , 'realCount' ));