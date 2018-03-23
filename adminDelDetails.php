<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

//判断是否存在恢复的传参
if (!empty($_GET['id'])) {
	$backID = $_GET['id'];
	$display = ['isdel'=>0];
	dbUpdate($link , 'bbs_details' , $display , "id = $backID");
}

//判断是否存在删除的传参
if (!empty($_POST['id'])) {
	$displayID = $_POST['id'];
	$displayID = join(',', $displayID);
	dbDelete($link , 'bbs_details' , "id in ($displayID)");
}

//限制结果集，分页，使用变量
if (dbSelect($link , 'bbs_details' , '*' , "first = 1 and isdel = 1") == false) {
	$motifCount = 0;
} else {
	$motifCount = count(dbSelect($link , 'bbs_details' , '*' , "first = 1 and isdel = '1'"));
}
$pageCount = 10;//每页设置条数
$pages = ceil($motifCount / $pageCount);//总页数
if ($pages == 0) {
	$pages  = 1;
}
$page =  $_GET['page'];//根据url获得的当前页数
$pageStart = ($page - 1) * $pageCount;//分页起始位置
if (dbSelect($link , 'bbs_details' , 'title' , "first = 1 and isdel = 1" , null , "$pageStart , $pageCount") == false) {
	$realCount = 0;
} else {
$realCount = count(dbSelect($link , 'bbs_details' , 'title' , "first = '1' and isdel = '1'" , null , "$pageStart , $pageCount"));//每页实际条数
}


$replyDel = selectThree($link , '*' , 'bbs_details' , 'bbs_user' , 'bbs_category' , 'authorid' , 'uid' , 'classid' , 'cid' , 'first = 1 and isdel = 1' , null , "$pageStart , $pageCount");
display('adminDelDetails.html' , compact('replyDel' , 'page' , 'pages' , 'motifCount' , 'realCount' , 'pageCount'));