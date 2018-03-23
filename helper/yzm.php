<?php

session_start();
include '../config/common.php';
include 'verify.php';

$_SESSION['yzm'] = verify(150,30,4,2);