<?php

function zoomImage($srcPath,$width,$height,$savePath='./')
{
	//1、获取源图信息
	list($srcWidth,$srcHeight,$type) = getimagesize($srcPath);
	//2、计算新的尺寸
	$size = getSize($width,$height,$srcWidth,$srcHeight);
	//3、打开源图
	$ext = image_type_to_extension($type, false);	
	$openFunc = 'imagecreatefrom' . $ext;
	$srcImg = $openFunc($srcPath);
	//4、创建目标图片
	$dstImg = imagecreatetruecolor($width,$height);
	//5、合并图片
	zoom($dstImg,$srcImg,$size);
	//6、保存
	//6-1、处理保存路径
	$savePath = rtrim($savePath,'/') . '/';
	//6-2、处理文件名
	$fileName = uniqid() . '.';
	//6-3、拼接完整文件路径名
	$dstPath = $savePath . $fileName . $ext;
	$saveFunc = 'image' . $ext;
	$saveFunc($dstImg, $dstPath);
	
	//7、释放资源
	imagedestroy($dstImg);
	imagedestroy($srcImg);
	//8、返回图片路径名
	return realpath($dstPath);
}

function zoom($dstImg,$srcImg,$size)
{
	//处理黑边
	//1、获取原图片的透明色
	$lucidColor = imagecolortransparent($srcImg);
	if ($lucidColor == -1) {
		//如果没有透明色，指定黑色作为透明色
		$lucidColor = imagecolorallocate($dstImg,0,0,0);
	}
	//2、填充目标图片的背景色
	imagefill($dstImg,0,0,$lucidColor);
	//3、设置目标图片的透明色
	imagecolortransparent($dstImg,$lucidColor);
	//合并图片
	imagecopyresampled($dstImg,$srcImg,$size['offsetX'],$size['offsetY'],0,0,$size['newWidth'],$size['newHeight'],$size['srcWidth'],$size['srcHeight']);
}

function getSize($width,$height,$srcWidth,$srcHeight)
{
	$size['srcWidth'] = $srcWidth;
	$size['srcHeight'] = $srcHeight;
	
	$scaleWidth = $width / $srcWidth;
	$scaleHeight = 	$height / $srcHeight;
	$scaleFinal = min($scaleWidth,$scaleHeight);
	
	$size['newWidth'] = round($srcWidth * $scaleFinal);
	$size['newHeight'] = round($srcHeight * $scaleFinal);
	
	if ($scaleWidth < $scaleHeight) {
		$size['offsetX'] = 0;
		$size['offsetY'] = round(abs($size['newHeight']-$height)/2);
	} else {
		$size['offsetY'] = 0;
		$size['offsetX'] = round(abs($size['newWidth']-$width)/2);
	}
	return $size;
}

function watermark($dstPath,$srcPath,$randName=true,$savePath='./watermarks',$subfix='png',$pos=9,$pct=100)
{
	//1、打开大图(目标图片)
	$dstImg = anyOpen($dstPath);
	//2、打开小图(源图片)
	$srcImg = anyOpen($srcPath);
	
	//3、计算位置
	list($dstWidth,$dstHeight) = getimagesize($dstPath);
	list($srcWidth,$srcHeight) = getimagesize($srcPath);
	if ($pos >= 1 && $pos <= 9) {
		$offsetX = (($pos-1)%3) * (($dstWidth-$srcWidth)/2);
		$offsetY = floor(($pos-1)/3) * (($dstHeight-$srcHeight)/2);		
	} else {
		$offsetY = mt_rand(0,$dstHeight-$srcHeight);
		$offsetX = mt_rand(0,$dstWidth-$srcWidth);
	}
	//4、合并图片
	imagecopymerge($dstImg,$srcImg,$offsetX,$offsetY,0,0,$srcWidth,$srcHeight,$pct);
	
	//5、拼接路径名
	//5-1、路径
	$path = rtrim($savePath,'/') . '/';
	//5-2、文件名
	if ($randName) {
		$fileName = uniqid();
	} else {
		$info = pathinfo($dstPath);
		$fileName = $info['filename'];
	}
	//5-3、后缀
	$subfix = ltrim($subfix,'.');
	//5-4、拼接完整路径名
	$pathName = $path . $fileName . '.' . $subfix;
	if ($subfix == 'jpg') {
		$subfix = 'jpeg';
	} 
	$saveImage = 'image' . $subfix;	
	//6、保存文件	
	$saveImage($dstImg,$pathName);
	//7、释放资源
	imagedestroy($dstImg);
	imagedestroy($srcImg);
	
	return realpath($pathName);
}

function anyOpen($file)
{
	$info = getimagesize($file);
	$ext = image_type_to_extension($info[2],false);
	$openFunc = 'imagecreatefrom' . $ext;
	return $openFunc($file);
}
