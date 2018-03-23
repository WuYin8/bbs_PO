<?php

include './common/home.php';
$link = dbConnect('localhost' , 'root' , '123123' , 'dbOne' , 'utf8');
$friendLink = dbSelect($link , 'bbs_link' , '*' ,'displayorder > 0' , 'displayorder');
$topLink = dbSelect($link , 'bbs_link' , '*' ,'displayorder = 0')[0];
display('friendUrl.html' , compact('friendLink' , 'topLink'));