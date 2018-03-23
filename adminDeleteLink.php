<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

$deleteId = $_REQUEST['lid'];
$page = $_POST['page'];
if (is_array($deleteId)) {
	$deleteId = join(',', $deleteId);
	dbDelete($link , 'bbs_link' , "lid in ($deleteId)");
} else {
	dbDelete($link , 'bbs_link' , "lid = $deleteId");
}
header("location:adminFriendLink.php?page=$page");