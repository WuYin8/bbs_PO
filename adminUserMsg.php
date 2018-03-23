<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');
//未传参uid时不允许进入用户信息详情页面
if (empty($_GET['uid']) && empty($_POST)) {
	header('location:adminEditUser.php?page=1');
	exit;
}

//提取数据库中的用户信息进行展示，注意输出的格式全部为string，这是由注册时的input决定的
$uid = $_GET['uid'];
$userMsg = dbSelect($link , 'bbs_user' , 'username , picture , allowlogin , email , regip , regtime , lasttime , grade , autograph , realname , sex , place' , "uid = $uid")[0];
//生日信息单独提取，分割为年月日
$birthday = dbSelect($link , 'bbs_user' , 'birthday' , "uid = $uid")[0][0];
$birthday = explode('/' , $birthday);

//初次进入页面没有POST，只显示本页面，提交后存在POST，header去往上一级
if (!empty($_POST)) {
	//POST内容单独赋值变量，转换为数组形式，上传到数据库，上传数据的格式要注意与输出时相同
	$username = $_POST['username'];
	$allowlogin = $_POST['allowLogin'];
	$email = $_POST['email'];
	$regip = $_POST['regIp'];
	$regtime = $_POST['regTime'];
	$lasttime = $_POST['lastTime'];
	$grade = $_POST['grade'];
	$realname = $_POST['realName'];
	$sex = $_POST['sex'];
	$place = $_POST['place'];
	$arrUser = ['allowlogin'=>$allowlogin ,'email'=>$email ,'regip'=>$regip ,'regtime'=>$regtime ,'lasttime'=>$lasttime ,'grade'=>$grade ,'realname'=>$realname ,'sex'=>$sex , 'place'=>$place];
	dbUpdate($link , 'bbs_user' , $arrUser , "username = '$username'");
	
	//密码，安全提问需要判断是否修改，生日需要组合
	$password = $_POST['password'];
	if (!empty($password)) {
		$password = md5($password);
		dbUpdate($link , 'bbs_user' , "password = '$password'" , "username = '$username'");
	}
	$problem = $_POST['problem'];;
	if ($problem == '1') {
		dbUpdate($link , 'bbs_user' , 'problem = 0' , "username = '$username'");
		dbUpdate($link , 'bbs_user' , "result = null" , "username = '$username'");
	}
	$birthday = $_POST['year'] . '/' . $_POST['month'] . '/' . $_POST['day'] ;
	dbUpdate($link , 'bbs_user' ,"birthday = '$birthday'" ,"username = '$username'");
	header('location:adminEditUser.php?page=1');
	exit;
}

display('adminUserMsg.html' , compact('userMsg' , 'birthday'));