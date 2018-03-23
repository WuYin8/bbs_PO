<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

//判断是否存在删除的传参

if (!empty($_POST)) {
	$deleteCid = $_POST['cid'];
	var_dump($deleteCid);
	$deleteCid = join(',', $deleteCid);
	dbDelete($link , 'bbs_category' , "parentid in ($deleteCid)");
	dbDelete($link , 'bbs_category' , "cid in ($deleteCid)");
	header('location:adminEditForum.php');
	exit;
}


$cateLarge = dbSelect($link , 'bbs_category' , 'cid , classname , parentid , compere , orderby , classpic , description , ispass' , 'parentid = 0');
$cateSmall = dbSelect($link , 'bbs_category' , 'cid , classname , parentid , compere , orderby , classpic , description , ispass' , 'parentid > 0');
display('adminEditForum.html' , compact('cateLarge' , 'cateSmall'));