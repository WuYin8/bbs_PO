<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

$friendLink = dbSelect($link , 'bbs_link' , 'lid , displayorder , name , url , logo , description');

//限制结果集，分页，使用变量
$motifCount = count(dbSelect($link , 'bbs_link' , '*' ));
$pageCount = 10;//每页设置条数
$pages = ceil($motifCount / $pageCount);//总页数
if ($pages == 0) {
	$pages  = 1;
}
$page =  $_GET['page'];//根据url获得的当前页数
$pageStart = ($page - 1) * $pageCount;//分页起始位置
if (dbSelect($link , 'bbs_link' , '*' , null ,null , "$pageStart , $pageCount") == false) {
	$realCount = 0;
} else {
	$realCount = count(dbSelect($link , 'bbs_link' , '*' , null , null , "$pageStart , $pageCount"));//每页实际条数
}

//添加友情链接
if (empty($_POST)) {
} else {
	$displayorder = $_POST['displayorder'];
	$name = $_POST['name'];
	$url = $_POST['url'];
	$description = $_POST['description'];
	$logo = $_POST['logo'];
	$time = time();
	
	$data = ['displayorder'=>$displayorder , 'name'=>$name , 'url'=>$url , 'description'=>$description , 'logo'=>$logo, 'addtime'=>$time ];
	dbInsert($link , 'bbs_link' , $data);
	
	header('location:adminFriendLink.php?page=1;');
	exit;
}
display('adminFriendLink.html' , compact('friendLink' , 'page' , 'pages' , 'motifCount' , 'pageCount' , 'realCount'));
