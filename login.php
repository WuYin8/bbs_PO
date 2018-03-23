<?php

/*登录*/
include './common/home.php';
$link = dbConnect('localhost' , 'root' , '123123' , 'dbOne' , 'utf8');

//站点关闭
if (dbSelect($link , 'bbs_msg' , 'isset' , 'id = 1')[0][0] == 1) {
	if (!isset($_COOKIE['username'])) {
		header('location:close.php');
		exit;
	} 
	$username = $_COOKIE['username'];
	if (dbSelect($link , 'bbs_user' , 'undertype' , "username = '$username'")[0][0] == 0) {
		header('location:close.php');
		exit;
	}
}

$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0 and ispass = 1');
$time = date('Y-m-d H:i:s' , time());
$webName = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webName'")[0][0];
$webUrl = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webUrl'")[0][0];
$webCode = dbSelect($link , 'bbs_msg' , 'content' , "name = 'webCode'")[0][0];

//判断IP是否被锁定
if ($_SERVER['REMOTE_ADDR']=='::1') {
		$loginIP = '127.0.0.1';
	} else {
		$loginIP = $_SERVER['REMOTE_ADDR'];
} 

$loginIP = ip2long($loginIP);
if (dbSelect($link , 'bbs_closeip' , 'ip' , "ip = '$loginIP'" ) !== false) {
	$title = '提示 - 10分钟学院';
	$jump = ' # ';
	$toTime = 86400000;
	$icon = '<img src="./public/img/noticeError.gif"/>';;
	$message = "IP已被锁定，请联系管理员进行处理";
	display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}

if (dbSelect($link , 'bbs_closeip' , 'ip' , "ip = '$loginIP'" ) !== false) {
	$title = '提示 - 10分钟学院';
	$jump = ' # ';
	$toTime = 86400000;
	$icon = '<img src="./public/img/noticeError.gif"/>';;
	$message = "IP已被锁定，请联系管理员进行处理";
	display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}


$name = trim($_POST['username']);
$pwd = trim($_POST['password']);
$title = '登录提示 - 10分钟学院';//提示页面使用
$toTime = 3000;
$jump = $_SERVER['HTTP_REFERER'];
$icon = '<img src="./public/img/notice.gif"/>';
//判断是否已登录
if (isset($_COOKIE['username'])) {
	$jump = 'index.php';
	$message = '您已登录，正在返回首页';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
}

//自动登录
if (isset ($_POST['autoLogin'])) {
	$autoLogin = trim($_POST['autoLogin']);
	$lastTime = intval(dbSelect($link , 'bbs_user' , 'max(lasttime)')[0][0]);
	$name = dbSelect($link , 'bbs_user' , 'username' , "lasttime = '$lastTime'")[0][0];
} else {	//手动登录
	
	//判断用户名是否为空
	if (empty($name)) {
		header('location:loginII.php');
		exit;
	}

	//判断用户名是否在数据库中
	if (!dbSelect($link , 'bbs_user' , 'username' , "username = '$name'" )) {
		$message = '用户名不存在，请注册后再试';
		$jump = $_SERVER['HTTP_REFERER'];
		$icon = '<img src="./public/img/notice.gif"/>';
		display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}

	$icon = '<img src="./public/img/noticeError.gif"/>';
	//判断密码是否匹配
	foreach (dbSelect($link , 'bbs_user' , 'password' , "username = '$name'" )[0] as $v) {
		$dbpwd = $v;
	}
	foreach (dbSelect($link , 'bbs_user' , 'errortimes' , "username = '$name'" )[0] as $v1) {
		$errortimes = $v1;//将错误次数赋值出来
	}
	//五次密码错误锁定账号
	if (md5($pwd) !== $dbpwd) {
		if ($errortimes < 4) {
			$errortimes++;
			dbUpdate($link , 'bbs_user' , "errortimes = '$errortimes'" , "username = '$name'");
			$message = "密码错误{$errortimes}次，请重试，错误5次后锁定账户";
			display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
			exit;
		} else {
			$errortimes++;
			dbUpdate($link , 'bbs_user' , "errortimes = '$errortimes'" , "username = '$name'");
			dbUpdate($link , 'bbs_user' , "allowlogin = 1" , "username = '$name'");
			$message = "账户已被锁定，请联系管理员进行处理";
			display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
			exit;
		}
	}

	//判断安全提问是否满足，(第二种登录时)
	if (isset($_POST['problem'])) {
		$problem = dbSelect($link , 'bbs_user' , 'problem' , "username = '$name'")[0][0];
		$result = dbSelect($link , 'bbs_user' , 'result' , "username = '$name'")[0][0];
		if ($problem !== '0') {
			if ($_POST['problem'] !== $problem) {
				$message = "安全提问选择错误";
				display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
				exit;
			}
			if ($_POST['result'] !== $result) {
				$message = "安全提问答案错误";
				display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time'
				, 'webName' , 'webUrl' , 'webCode'));
				exit;
			}
		}
	}
	
	//判断是否允许登录
	foreach (dbSelect($link , 'bbs_user' , 'allowlogin' , "username = '$name'" )[0] as $v2) {
		$allowlogin = $v2;
	}
	if ($allowlogin == 1) {
		$message = "账户已被锁定，请联系管理员进行处理";
		display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
		exit;
	}
}

//密码正确后，错误次数恢复为0
dbUpdate($link , 'bbs_user' , "errortimes = 0" , "username = '$name'");
//获取最后登录时间
$lastTime = time();
dbUpdate($link , 'bbs_user' , "lasttime = '$lastTime'" , "username = '$name'");
//登录,积分+2
$money = dbSelect($link , 'bbs_user' , 'grade' , "username = '$name'" )[0][0];
$money += 2 ;
dbUpdate($link , 'bbs_user' , "grade = '$money'" , "username = '$name'");
setcookie('grade' , $money , time() +86400);
$face =dbSelect($link , 'bbs_user' , 'picture' , "username = '$name'")[0][0];
setcookie('face' , $face , time() +86400);

//传参至cookie ，判断用户是否为管理员
setcookie('username' , $name , time() + 86400);
$undertype = dbSelect($link , 'bbs_user' , 'undertype' , "username = '$name'" )[0][0];
setcookie('undertype' , $undertype , time() + 86400);

//打开页面
$icon = '<img src="./public/img/noticeRight.gif"/>';
$message = "登录成功，积分+2";
display('notice.html', compact('title' ,"message" , 'jump' , 'toTime' , 'icon', 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));