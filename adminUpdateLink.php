<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

	
if (empty($_POST)) {
$lid =$_GET['lid'];
setcookie('lid' , $lid , time() + 3600);
$friendLink = dbSelect($link , 'bbs_link' , 'displayorder , name , url , logo , description' , "lid = '$lid'")[0];

//展示默认值
	$displayorder = $friendLink['displayorder'];
	$name = $friendLink['name'];
	$url = $friendLink['url'];
	$description = $friendLink['description'];
	$logo = $friendLink['logo'];
	display('adminUpdateLink.html' , compact('friendLink' , 'displayorder' , 'name' , 'url' , 'description' , 'logo'));
	exit;
} else {
	$displayorder = $_POST['displayorder'];
	$name = $_POST['name'];
	$url = $_POST['url'];
	$description = $_POST['description'];
	$logo = $_POST['logo'];
	$lid = $_COOKIE['lid'];
	$set = ['displayorder'=>$displayorder , 'name'=>$name , 'url'=>$url , 'description'=>$description , 'logo'=>$logo];
	dbUpdate($link , 'bbs_link' , $set , "lid = $lid");
	unset($_COOKIE['lid']);
	setcookie('lid' , $lid , time() - 3600);
	header('location:adminFriendLink.php?page=1');
}