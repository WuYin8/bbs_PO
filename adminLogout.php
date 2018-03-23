<?php

include './common/home.php';
//销毁管理员用户名
setcookie('username','',time()-3600);
setcookie('grade','',time()-3600);
setcookie('face','',time()-3600);
setcookie('undertype','',time()-3600);
unset($_COOKIE['username']);
unset($_COOKIE['grade']);
unset($_COOKIE['face']);
unset($_COOKIE['undertype']);
header('location:admin.php');