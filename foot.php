<?php

/*尾部页面*/
include './common/home.php';
$time = date('Y-m-d H:i:s' , time());

$webName = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webName'")[0][0];
$webUrl = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webUrl'")[0][0];
$webCode = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webCode'")[0][0];


display('foot.html' , compact('time' , 'webTitle' , 'webName' , 'webUrl' , 'webCode'));