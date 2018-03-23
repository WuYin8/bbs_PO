<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');

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
if (!empty($_COOKIE['PHPSESSID'])) {
	setcookie('PHPSESSID','',time()-3600);
	unset($_COOKIE['PHPSESSID']);
}

$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0 and ispass = 1');//头部页面用
$time = date('Y-m-d H:i:s' , time());//尾部页面使用
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


$toTime = 3000;
$title = '提示 - 10分钟学院';


//url中id丢失的处理方式
 if (empty($_GET['id'])) {
	$message = '页面出了一些问题，正在返回首页';
	$jump = 'index.php';
	$icon = '<img src="./public/img/notice.gif"/>';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));
	exit;
 }
$id = $_GET['id'];

//楼中楼回复用
if (empty($_GET['sid'])) {
	$sid = 0;
} else {
	$sid = $_GET['sid'];
	dbUpdate($link , 'bbs_details' , 'sid = -1' , "id = $sid");
}


//页面被点击，计算一次查看数
$hits = dbSelect($link , 'bbs_details' , 'hits' , "id =$id")[0][0];
$hits++;
$hitsArr = ['hits'=>$hits];
dbUpdate($link , 'bbs_details' , $hitsArr , "id=$id");

//判断是否存在加精的传参
if (!empty($_GET['elite'])) {
	$id2 = $_GET['elite']; 
	$elite = dbSelect($link , 'bbs_details' , 'elite' , "id = $id2")[0][0];
	if ($elite == '0') {
		$elite = ['elite'=>1];
		dbUpdate($link , 'bbs_details' , $elite , "id = $id2");
		header("location:detail.php?id=$id&page=1");
	} elseif ($elite == '1') {
		$elite = ['elite'=>0];
		dbUpdate($link , 'bbs_details' , $elite , "id = $id2");
		header("location:detail.php?id=$id&page=1");
	}
}
//判断是否存在高亮的传参
if (!empty($_GET['hot'])) {
	$id2 = $_GET['hot']; 
	$ishot = dbSelect($link , 'bbs_details' , 'ishot' , "id = $id2")[0][0];
	if ($ishot == '0') {
		$ishot = ['ishot'=>1];
		dbUpdate($link , 'bbs_details' , $ishot , "id = $id2");
		header("location:detail.php?id=$id&page=1");
	} elseif ($ishot == '1') {
		$ishot = ['ishot'=>0];
		dbUpdate($link , 'bbs_details' , $ishot , "id = $id2");
		header("location:detail.php?id=$id&page=1");
	}
}
//判断是否存在置顶的传参
if (!empty($_GET['top'])) {
	$id2 = $_GET['top']; 
	$istop = dbSelect($link , 'bbs_details' , 'istop' , "id = $id2")[0][0];
	if ($istop == '0') {
		$istop = ['istop'=>1];
		dbUpdate($link , 'bbs_details' , $istop , "id = $id2");
		header("location:detail.php?id=$id&page=1");
	} elseif ($istop == '1') {
		$istop = ['istop'=>0];
		dbUpdate($link , 'bbs_details' , $istop , "id = $id2");
		header("location:detail.php?id=$id&page=1");
	}
}

//判断是否存在回收的传参
$classid = dbSelect($link , 'bbs_details' , 'classid' , "id = '$id'")[0][0];
if (!empty($_GET['del'])) {
	$id2 = $_GET['del']; 
	$isdel = dbSelect($link , 'bbs_details' , 'isdel' , "id = $id2")[0][0];
	if ($isdel == '0') {
		$isdel = ['isdel'=>1];
		dbUpdate($link , 'bbs_details' , $isdel , "id = $id2");
		header("location:list.php?classid=$classid&page=1");
	} elseif ($isdel == '1') {
		$isdel = ['isdel'=>0];
		dbUpdate($link , 'bbs_details' , $isdel , "id = $id2");
		header("location:list.php?classid=$classid&page=1");
	}
}

//判断是否存在屏蔽的传参
if (!empty($_GET['display'])) {
	$idd = $_GET['display']; 
	$isdisplay = dbSelect($link , 'bbs_details' , 'isdisplay' , "id = $idd")[0][0];
	if ($isdisplay == '0') {
		$isdisplay = ['isdisplay'=>1];
		dbUpdate($link , 'bbs_details' , $isdisplay , "id = $idd");
		header("location:detail.php?id=$id&page=1");
	} elseif ($isdisplay == '1') {
		$isdisplay = ['isdisplay'=>0];
		dbUpdate($link , 'bbs_details' , $isdisplay , "id = $idd");
		header("location:detail.php?id=$id&page=1");
	}
}

//层叠目录，变量

$title1 = dbSelect($link , 'bbs_details' , 'title' , "id = '$id'")[0][0];
$titleSmall = dbSelect($link , 'bbs_category' , 'classname' , "cid = '$classid'")[0][0];//获取小版块名称
$parentid = dbSelect($link , 'bbs_category' , 'parentid' , "cid = '$classid'")[0][0];//获取小版块对应父id
$titleBig = dbSelect($link , 'bbs_category' , 'classname' , "cid = '$parentid'")[0][0];//获得父id对应大版块名称
$urlBig = dbSelect($link , 'bbs_category' , 'cid' , "cid = '$parentid'")[0][0];//获取父级大版块cid，用于返回页面

//主贴的回帖数
if (dbSelect($link , 'bbs_user u, bbs_details d' , 'id' , "u.uid=d.authorid and tid = '$id' and isdel = 0 and isdisplay = 0") == false) {
	$replyCount = 0;
} else {
	$replyCount = count(dbSelect($link , 'bbs_user u, bbs_details d' , 'id' , "u.uid=d.authorid and tid = '$id' and isdel = 0 and sid <= 0"));
}

$arrReplyC = ['replyCount'=>$replyCount];
dbUpdate($link , 'bbs_details' , $arrReplyC , "id = '$id'");

//限制结果集，分页，使用变量
$pageCount = 10;//每页设置条数
$pages = ceil($replyCount / $pageCount);//总页数

if ($pages == 0) {
	$pages  = 1;
}

//根据url获得的当前页数
if (empty($_GET['page'])) {
	$page = 1;
} else {
	$page =  $_GET['page'];
}
if ($page <= 0 || $page > $pages) {
	$page = 1;
}

$pageStart = ($page - 1) * $pageCount;//分页起始位置
if (dbSelect($link , 'bbs_user u, bbs_details d' , 'title' , "u.uid=d.authorid and tid = '$id' and first = 0 and isdel = 0 and sid <= 0" , null , "$pageStart , $pageCount") == false) {
	$realCount = 0;
} else {
$realCount = count(dbSelect($link , 'bbs_user u, bbs_details d' , 'title' , "u.uid=d.authorid and tid = '$id' and first = 0 and isdel = 0 and sid <= 0" , null , "$pageStart , $pageCount"));//每页实际条数
}

//判断是否存在锚点的传参
if (!empty($_POST['floor'])) {
	$floor = $_POST['floor'];
	$floor = intval($floor); 
		if ($floor >= 1 and $floor <= $replyCount) {
		$floorPage = ceil($floor / $pageCount);
		if ($floorPage == 0) {
			$floorPage = 1;
		}
		$floor--;
		$floorJump = "$floor" . 'F';
		header("location:detail.php?id=$id&page=$floorPage#$floorJump");
		exit;
		}	
		header("location:detail.php?id=$id&page=1");
		exit;
}

//涉及到登录用户的信息，未登录状态跳转登录页面
if (isset($_COOKIE['username'])) {
	$username = $_COOKIE['username'];
	$userFile = dbSelect($link , 'bbs_user' , '*' , "username = '$username'")[0];
	$userPay = dbSelect($link,'bbs_user u, bbs_pay p','*',"u.uid=p.uid and classid='$classid ' and tid=0 and first=1 and isdisplay=0 and isdel=0",'istop desc',"$pageStart , $pageCount");
}
//涉及到主贴的信息
$detail = dbSelect($link , 'bbs_details' , '*' , "id = '$id'")[0];
$rate = $detail['rate'];
$authorid = $detail['authorid'];
$author = dbSelect($link , 'bbs_user' , '*' , "uid = '$authorid'")[0];//主贴作者的信息


//涉及到回帖的信息
$reply = dbSelect($link,'bbs_user u, bbs_details d','*',"u.uid=d.authorid and tid=$id and isdel=0 and sid <= 0 ",'istop desc',"$pageStart , $pageCount");

//回帖编辑
if (!empty($_POST['content'])) {
	//在回帖提交时判断，未登录则跳转到登录页面
	if (!isset($_COOKIE['username'])) {
	header('location:loginII.php');
	exit;
	}
	$uid = $userFile['uid'];
	$content = $_POST['content'];
	$tid = $_GET['id'];
	if ($_SERVER['REMOTE_ADDR']=='::1') {
		$addip = '127.0.0.1';
	} else {
		$addip = $_SERVER['REMOTE_ADDR'];
	} 
	$addip = ip2long($addip);
	$replyArr = ['authorid'=>$uid , 'content'=>$content , 'tid'=>$tid , 'classid'=>$classid , 'first'=>0 , 'addtime'=>time() , 'addip'=>$addip , 'title'=>'' , 'sid'=>$sid];
	dbInsert($link , 'bbs_details' , $replyArr);//成功回帖，添加到数据库
	
	
	//回帖数++
	$replycount = dbSelect($link , 'bbs_details' , 'replycount' , "id = $id" )[0][0];
	$replycount++ ;
	dbUpdate($link , 'bbs_details' , "replycount = $replycount" , "id = $id");
	//回帖完成后的提示
	$money = dbSelect($link , 'bbs_user' , 'grade' , "username = '$username'" )[0][0];
	$money++ ;
	dbUpdate($link , 'bbs_user' , "grade = '$money'" , "username = '$username'");
	setcookie('grade' , $money , time() +86400);
	$message = '回帖成功，积分+1';
	$jump = "detail.php?id=$tid&page=1";
	$icon = '<img src="./public/img/noticeRight.gif"/>';
	display('notice.html', compact('title' ,'message' , 'jump' , 'toTime' , 'icon' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode' , 'reReply'));
	exit;
}
if (dbSelect($link , 'bbs_user u, bbs_details d' , '*' , "u.uid=d.authorid and tid = $id and sid > 0") == false) {
	$reReplyCount = 0;
} else {
	$reReplyCount = count(dbSelect($link , 'bbs_user u, bbs_details d' , '*' , "u.uid=d.authorid and tid = $id and sid > 0"));
}

	
$title = dbSelect($link , 'bbs_details' , 'title' , "id = '$id'")[0][0] . '- 10分钟学院';
display('detail.html' , compact('title' , 'id', 'title1' , 'titleSmall' , 'titleBig' , 'urlBig' , 'classid' , 'userFile' , 'uid' , 'author' , 'detail' , 'reply' , 'replyCount'  , 'reReplyCount' , 'page' , 'pages' , 'pageCount' , 'realCount' , 'rate' ,'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode'));