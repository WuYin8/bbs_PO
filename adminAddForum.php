<?php

include './common/home.php';
$link = dbConnect('localhost' ,'root' ,'123123' ,'dbOne' , 'utf8');
$cateBig= dbSelect($link , 'bbs_category' , 'cid , classname' , 'parentid = 0');
//上传icon需要
$mimes = ['image/png' , 'image/jpeg' , 'image/gif'];
$suffixes = ['png' , 'jpg' , 'jpeg' , 'gif'];
$result = upload('classpic' , $mimes , $suffixes);

//判断是否有提交的传参
if (!empty($_POST)) {
	$classname = $_POST['classname'];
	if (!empty($classname)) {
		//对比数据库中是否已有此版块名称
		if (dbSelect($link , 'bbs_category' , 'classname' , "classname = '$classname'") !== false) {
			$addNotice = '提交版块已重名，请更改版块名再试！！！！';
			display('adminAddForum.html' , compact('cateBig' , 'addNotice'));
			exit;
		} 
		if (!empty($_POST['classpic'])) {
			//判断版块ICON是否能上传
			if ($result['errno'] !== 200) {
			$addNotice = $result['msg'];
			display('adminAddForum.html' , compact('cateBig' , 'addNotice'));
			exit;
			}
			//上传头像地址到数据库
			$classpic = $result['msg'];//获取上传图片的缓存路径
		} else {
			//未上传路径，使用默认图片
			$classpic = 'public/img/classLogo.gif';
		}
		var_dump($classpic);
		$parentid = $_POST['parentid'];
		$compere = $_POST['compere'];
		$ispass = $_POST['ispass'];
		$description = $_POST['description'];
		$arrCate = ['classname'=>$classname , 'parentid'=>$parentid , 'classpic'=>$classpic , 'ispass'=>$ispass , 'description'=>$description];
		dbInsert($link , 'bbs_category' , $arrCate);
		
		
	}
}

$addNotice = '重名版块与未命名版块不允许提交';
display('adminAddForum.html' , compact('cateBig' , 'addNotice'));