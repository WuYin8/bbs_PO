<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

$username = $_COOKIE['username'];


display('adminTop.html' , compact('username'));