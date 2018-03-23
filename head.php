<?php

/*头部页面*/
include './common/home.php';
$link = dbConnect('localhost' , 'root' , '123123' , 'dbOne' , 'utf8');

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
$title = '头部 - 10分钟学院';

$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0 and ispass = 1' , 'orderby');
var_dump($forumLarge);
display('head.html' , compact('face' , 'title' , 'forumLarge'));