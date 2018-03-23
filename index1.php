<?php

include './common/home.php';



$title = '首页 - 10分钟学院';
$main = '主页内容';
$headContent = '头部信息';
$footerContent = '尾部信息';

$vars = compact('title','main','headContent','footerContent');
$result = dbSelect($link,'bbs_user');
var_dump($result);
//display('index.html',$vars);