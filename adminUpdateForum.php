<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

if (empty($_POST)) {
	$cid =$_GET['cid'];
	setcookie('cid' , $cid , time() + 3600);
	$category = dbSelect($link , 'bbs_category' , 'classname , orderby , compere , description , classpic , ispass' , "cid = '$cid'")[0];

	//展示默认值
	display('adminUpdateForum.html' , compact('category'));
	exit;
} else {
	$classname = $_POST['classname'];
	$orderby = $_POST['orderby'];
	$compere = $_POST['compere'];
	$description = $_POST['description'];
	$classpic = $_POST['classpic'];
	$ispass = $_POST['ispass'];
	$cid = $_COOKIE['cid'];
	$set = ['classname'=>$classname , 'orderby'=>$orderby , 'compere'=>$compere , 'description'=>$description , 'classpic'=>$classpic , 'ispass'=>$ispass];
	dbUpdate($link , 'bbs_category' , $set , "cid = $cid");
	unset($_COOKIE['cid']);
	setcookie('cid' , $cid , time() - 3600);
	header('location:adminEditForum.php');
}