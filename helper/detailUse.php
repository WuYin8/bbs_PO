<?php

function floorJump($tid , $id)
{
	$link = dbConnect('localhost' , 'root' , '123123' , 'dbOne' , 'utf8');
	$arr = dbSelect($link , 'bbs_user u, bbs_details d' , 'id' , "u.uid=d.authorid and tid = '$tid' and isdel = 0 and sid <= 0" , 'istop desc');
	foreach ($arr as $v)
	{
		$varr[] = $v['id'];
	}
	$varr = array_flip($varr);
	foreach ($varr as $key=>$value) {
		$varr[$key] ="<span id = \"". $value ."F\"></span>";
	}
	return $varr[$id];
}

 function floorName($tid ,$id) 
{
	$link = dbConnect('localhost' , 'root' , '123123' , 'dbOne' , 'utf8');
	$arr = dbSelect($link , 'bbs_user u, bbs_details d' , 'id' , "u.uid=d.authorid and tid = '$tid' and isdel = 0 and sid <= 0" , 'istop desc');
	foreach ($arr as $v)
	{
		$varr[] = $v['id'];
	}
	foreach ($varr as $k=>$value)
	{
		if ($k == 0) {
			$k = "沙发";
			$var[$k] = $value;
		}
		if ($k == 1) {
			$k = "板凳";
			$var[$k] = $value;
		}
		if ($k == 2) {
			$k = "地板";
			$var[$k] = $value;
		}
		if ($k == 3) {
			$k = "地下室";
			$var[$k] = $value;
		}
		if ($k == 4) {
			$k = "地狱";
			$var[$k] = $value;
		}
		if ($k >= 5) {
			$k++;
			$k = '第' . $k . '楼';
			$var[$k] = $value;
		}
	}
	echo array_search($id , $var);
}

function gradeName($grade , $undertype)
{
	if ($grade >= 0 && $grade < 100) {
		echo '乳臭未干';
	}
	if ($grade >= 100 && $grade < 300) {
		echo '少小离家';
	}
	if ($grade >= 300 && $grade < 600) {
		echo '入门弟子';
	}
	if ($grade >= 600 && $grade < 1000) {
		echo '艺满出师';
	}
	if ($grade >= 1000 && $grade < 1500) {
		echo '牛刀小试';
	}
	if ($grade >= 1500 && $grade < 2500) {
		echo '暂露头角';
	}
	if ($grade >= 2500 && $grade < 4000) {
		echo '兵强马壮';
	}
	if ($grade >= 4000 && $grade < 6000) {
		echo '呼风唤雨';
	}
	if ($grade >= 6000 && $grade < 9000) {
		echo '君临天下';
	}
	if ($grade >= 9000) {
		echo '独孤求败';
	} 
}