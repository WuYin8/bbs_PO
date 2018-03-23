<?php


include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

$webTitle = dbSelect($link , 'bbs_msg' , 'content' , "name = 'WebTitle'")[0][0];
$webName = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webName'")[0][0];
$webUrl = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webUrl'")[0][0];
$webCode = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webCode'")[0][0];
$isset = dbSelect($link , 'bbs_msg' , 'isset' , "id = 1")[0][0];

if (!empty($_POST)) {
	$title = ['content'=>$_POST['webTitle']];
	$name = ['content'=>$_POST['webName']];
	$url = ['content'=>$_POST['webUrl']];
	$code = ['content'=>$_POST['webCode']];
	$set = ['isset'=>$_POST['isset']];
	dbUpdate($link , 'bbs_msg' , $title , "name = 'webTitle'");
	dbUpdate($link , 'bbs_msg' , $name , "name = 'webName'");
	dbUpdate($link , 'bbs_msg' , $url , "name = 'webUrl'");
	dbUpdate($link , 'bbs_msg' , $code , "name = 'webCode'");
	dbUpdate($link , 'bbs_msg' , $set , "id = 1");
	header('location:adminWebMsg.php');
	exit;
}
display('adminWebMsg.html' , compact('webTitle' , 'webName' , 'webUrl' , 'webCode' , 'isset'));