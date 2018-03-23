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

$forumLarge = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid = 0 and ispass = 1' , 'orderby');//头部页面用
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

$classid = $_GET['classid'];
$title = dbSelect($link , 'bbs_category' , 'classname' , "cid = '$classid'")[0][0] . ' - 10分钟学院';

$forumSmall = dbSelect($link , 'bbs_category' , 'classname , cid , parentid' , 'parentid > 0 and ispass = 1' , 'orderby');
$titleSmall = dbSelect($link , 'bbs_category' , 'classname' , "cid = '$classid'")[0][0];//获取小版块名称
$parentid = dbSelect($link , 'bbs_category' , 'parentid' , "cid = '$classid'")[0][0];//获取小版块对应父id
$titleBig = dbSelect($link , 'bbs_category' , 'classname' , "cid = '$parentid'")[0][0];//获得父id对应大版块名称
$urlBig = dbSelect($link , 'bbs_category' , 'cid' , "cid = '$parentid'")[0][0];//获取父级大版块cid，用于返回页面
$compere = dbSelect($link , 'bbs_category' , 'compere' , "cid = '$classid'")[0][0];//获得版主名称
$motifCount = dbSelect($link,'bbs_user u, bbs_details d','count(*)',"u.uid=d.authorid and classid='$classid ' and first=1 and isdel=0")[0][0];//小版块内发帖数


//限制结果集，分页，使用变量
$pageCount = 10;//每页设置条数
if (empty($_GET['elite'])) {
	
	//获取今天内的发帖数(所有)
	if ($motifCount == 0) {
		$todayCount = 0;
	} else {
		$todayCount =  dbSelect($link , 'bbs_user u, bbs_details d' , 'addtime' , "u.uid=d.authorid and classid = '$classid' and first = 1");
		foreach ($todayCount as $v) 
		{
			if (date('Y-m-d' , $v['addtime']) == date('Y-m-d' , time())) {
				$today[] = $v['addtime'];
			}
		}
		if (!isset($today)) {
			$todayCount = 0;
		} else {
			$todayCount = count($today);
		}
	}
	//分页需要的变量
	$pages = ceil($motifCount / $pageCount);//总页数
	//根据url获得的当前页数
	if (empty($_GET['page'])) {
		$page = 1;
	} else {
		$page =  $_GET['page'];
	}
	if ($page <= 0 || $page > $pages) {
		$page = 1;
	}
	//分页起始位置
	$pageStart = ($page - 1) * $pageCount;
	if (dbSelect($link , 'bbs_user u, bbs_details d' , 'title' , "u.uid=d.authorid and classid = '$classid' and tid = 0" , null , "$pageStart , $pageCount") == false) {
		$realCount = 0;
	} else {
		$realCount = count(dbSelect($link , 'bbs_user u, bbs_details d' , 'title' , "u.uid=d.authorid and classid = '$classid' and tid = 0 and isdel = 0 and isdisplay = 0" , null , "$pageStart , $pageCount"));//每页实际条数
	}
} else {
	
	//版块内精华帖的数量
	$motifCount = dbSelect($link , 'bbs_user u, bbs_details d' , 'count(*)' , "u.uid=d.authorid and classid = '$classid' and first = 1 and elite = 1 and isdel = 0 and isdisplay = 0")[0][0];
	//获取今天内的发帖数（精华帖）
	if ($motifCount == 0 ) {
		$todayCount = 0;
	} else {
		$todayCount =  dbSelect($link , 'bbs_user u, bbs_details d' , 'addtime' , "u.uid=d.authorid and classid = '$classid' and elite = 1 and first = 1");
		foreach ($todayCount as $value) 
		{
			if (date('Y-m-d' , $value['addtime']) == date('Y-m-d' , time())) {
				$today[] = $value['addtime'];
			}
		}
		if (!isset($today)) {
			$todayCount = 0;
		} else {
			$todayCount = count($today);
		}
	}
	//分页需要的变量
	$pages = ceil($motifCount / $pageCount);//总页数
	//根据url获得的当前页数
	if (empty($_GET['page'])) {
		$page = 1;
	} else {
		$page =  $_GET['page'];
	}
	if ($page <= 0 || $page > $pages) {
		$page = 1;
	}
	//分页起始位置
	$pageStart = ($page - 1) * $pageCount;
	if (dbSelect($link , 'bbs_user u, bbs_details d' , 'title' , "u.uid=d.authorid and classid = '$classid' and elite = 1 and tid = 0 and isdel = 0" , null , "$pageStart , $pageCount") == false) {
		$realCount = 0;
	} else {
		$realCount = count(dbSelect($link , 'bbs_user u, bbs_details d' , 'title' , "u.uid=d.authorid and classid = '$classid' and elite = 1 and tid = 0 and isdel = 0 and isdisplay = 0" , null , "$pageStart , $pageCount"));//每页实际条数
	}
}
if ($pages == 0) {
	$pages  = 1;
}



//作者名，回帖时间等，需要使用foreach遍历结果，继续在本表或其他数据表中select的，直接在html截面使用代码查询
//回复与点击默认为零，每点击，回复一次，加一并传参至数据表
//两表联查出作者名，发帖时间
$details = dbSelect($link,'bbs_user u, bbs_details d','*',"u.uid=d.authorid and classid='$classid ' and tid=0 and first=1 and isdel=0",'istop desc',"$pageStart , $pageCount");//所有
$detailsElite = dbSelect($link,'bbs_user u, bbs_details d','*',"u.uid=d.authorid and elite =1 and classid='$classid ' and tid=0 and first=1  and isdel=0",'istop desc',"$pageStart , $pageCount");//精华帖


$vars = compact('title' , 'forumSmall' , 'titleSmall', 'titleBig' , 'todayCount' , 'motifCount' , 'classid' , 'compere' , 'urlBig' , 'pageCount' , 'pages', 'page' , 'author' , 'realCount' , 'details' , 'detailsElite' , 'forumLarge' , 'time', 'webName' , 'webUrl' , 'webCode');
display('list.html',$vars);