<?php

/**
*功能
*参数
*返回值
*/
function verify($width=200,$height=50,$len=4,$type=0)
{
	//1、创建画布
	$img = imagecreatetruecolor($width,$height);
	//2、创建相关颜色
	$light = lightColor($img);
	$dark = darkColor($img);
	//3、设置浅色背景
	imagefill($img,0,0,$light);
	//4、产生随机验证码字符串
	$code = randString($len,$type);
	//5、将验证码字符串逐一画到画布上
	$perWidth = $width / $len;
	$fontSize = floor($height/1.5);
	$delta = ($perWidth-$fontSize)/2;
	$offsetY = ($height+$fontSize)/2;
	for ($i = 0; $i < $len; $i++) {
		$offsetX = $i * $perWidth + $delta;
		$hanzi = mb_substr($code,$i,1);
		$angle = mt_rand(-30,30);
		imagettftext($img,$fontSize,$angle,$offsetX,$offsetY,$dark, TTF_PATH .'xdxwz.ttf',$hanzi);
	}
	//6、添加干扰元素(类型不限，如：点、线、弧)
	for ($i = 0; $i < $width*$height/50; $i++) {
		$x = mt_rand(0, $width-1);
		$y = mt_rand(0, $height-1);
		$color = darkColor($img);
		imagesetpixel($img, $x, $y,$color);
	}
	//7、发送header
	header('Content-Type:image/png');
	//8、发送图片
	imagepng($img);
	//9、释放资源
	imagedestroy($img);	
	//10、返回验证码字符串
	return $code;
}

function lightColor($img)
{
	return imagecolorallocate($img,mt_rand(128,255),mt_rand(128,255),mt_rand(128,255));
}

function darkColor($img)
{
	return imagecolorallocate($img,mt_rand(0,127),mt_rand(0,127),mt_rand(0,127));
}

function randString($len=4,$type=0)
{
	switch ($type) {
		case 0:	//纯数字
			return randNumber($len);
		case 1:	//纯字母
			return randAlpha($len);
		case 2:	//数字字母混合
			return randMixed($len);
		case 3:	//汉字
			return randChinese($len);
		default://未知类型
			return randUnknow($len);
	}
}

function randNumber($len)
{
	/*
	$str = '0123456789';
	return substr(str_shuffle($str),0,$len);
	*/
	$arr = range('0','9');
	shuffle($arr);
	$result = array_chunk($arr,$len);
	$result = $result[0];
	return join('',$result);
}

function randAlpha($len)
{
	/*
	$arr1 = range('a','z');
	$arr2 = range('A','Z');
	$arr = array_merge($arr1,$arr2);
	$arr3 = array_flip($arr);
	$result = array_rand($arr3,$len);	
	return join('', $result);
	*/
	$arr1 = range('a','z');
	$arr2 = range('A','Z');
	$arr = array_merge($arr1,$arr2);
	shuffle($arr);
	$result = array_slice($arr,0,$len);
	return join('', $result);
}

function randMixed($len)
{
	/*
	$arr = range('a','z');
	$str = join('', $arr);
	$str .= strtoupper($str);
	$str .= join('', range('0','9'));
	return substr(str_shuffle($str),0,$len);
	*/
	$str = '';
	for ($i = 0; $i < $len; $i++) {
		$type = mt_rand(0,2);
		switch ($type) {
			case 0:	//数字
				$str .= chr(mt_rand(48,57));
				break;
			case 1:	//大写字母
				$str .= chr(mt_rand(65,90));
				break;
			case 2:	//小写字母
				$str .= chr(mt_rand(97,122));
				break;
		}
	}
	return $str;
}

function randChinese($len)
{
	$str = '';
	for ($i = 0; $i < $len; $i++) {
		$c1 = mt_rand(176,214);
		$c2 = mt_rand(161,254);
		$str .= chr($c1).chr($c2);
	}
	return iconv('gbk','utf-8',$str);
	//return mb_convert_encoding($str,'utf-8','GB18030');
}

function randUnknow($len)
{
	//return str_repeat('0',$len);
	
	$arr = array_fill(0,$len,'8');
	return join('', $arr);
}