<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

//判断是否存在删除的传参
if (!empty($_POST)) {
	$displayID = $_POST['id'];
	$displayID = join(',', $displayID);
	$display = ['isdel'=>1];
	dbUpdate($link , 'bbs_details' , $display , "id in ($displayID)");
	// header('location:adminEditReply.php');
	// exit;
}

//限制结果集，分页，使用变量
$motifCount = count(dbSelect($link , 'bbs_details' , '*' , "first = 0 and isdel = 0"));
$pageCount = 10;//每页设置条数
$pages = ceil($motifCount / $pageCount);//总页数
if ($pages == 0) {
	$pages  = 1;
}
$page =  $_GET['page'];//根据url获得的当前页数
$pageStart = ($page - 1) * $pageCount;//分页起始位置
if (dbSelect($link , 'bbs_details' , 'title' , "first = '0'  and isdel = '0'" , null , "$pageStart , $pageCount") == false) {
	$realCount = 0;
} else {
$realCount = count(dbSelect($link , 'bbs_details' , 'title' , "first = '0' and isdel = '0'" , null , "$pageStart , $pageCount"));//每页实际条数
}

$reply = selectThree($link , '*' , 'bbs_details' , 'bbs_user' , 'bbs_category' , 'authorid' , 'uid' , 'classid' , 'cid' , 'first = 0 and isdel = 0' , 'istop desc' , "$pageStart , $pageCount");

display('adminEditReply.html' , compact('reply' , 'author' , 'page' , 'pages' , 'realCount' , 'motifCount' , 'pageCount' ));