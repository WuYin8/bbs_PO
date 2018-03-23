<?php

/**
*
*/
function upload($key,
				$mimes,
				$suffixes,
				$size = 2000000,
				$savePath='upload/face'
				)
{
	if (empty($_FILES[$key])) {
		return false;
	}
	$data = $_FILES[$key];
	//用于返回信息
	$result = ['errno'=>0,'msg'=>'用于记录信息'];

	if ($data['error']) {
		switch ($data['error']) {
			case UPLOAD_ERR_INI_SIZE:	
				$result['msg'] = '超出了配置文件中设定文件大小';
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$result['msg'] = '超出了MAX_FILE_SIZE的大小';
				break;
			case UPLOAD_ERR_PARTIAL:
				$result['msg'] = '只有部分文件被上传';
				break;
			case UPLOAD_ERR_NO_FILE:
				$result['msg'] = '没有文件被上传';
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$result['msg'] = '没有找到临时文件夹';
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$result['msg'] = '文件写入失败';
				break;
		}
		$result['errno'] = $data['error'];
		return $result;
	} else if ($data['size'] > $size) {
		$result['errno'] = 100;
		$result['msg'] = '超出了2M的特定限制';
		return $result;
	}

	if (!in_array($data['type'],$mimes)) {
		$result['errno'] = 101;
		$result['msg'] = '不支持的MIME';
		return $result;
	}
	$info = pathinfo($data['name']);
	$suffix = strtolower($info['extension']);
	if (!in_array($suffix,$suffixes)) {
		$result['errno'] = 102;
		$result['msg'] = '不支持文件后缀';
		return $result;
	}

	if (!is_uploaded_file($data['tmp_name'])) {
		$result['errno'] = 103;
		$result['msg'] = '不是上传文件';
		return $result;
	}
	$savePath = rtrim($savePath,'/').'/';
	$fileName = $savePath . uniqid() . '.' . $suffix;
	if (!move_uploaded_file($data['tmp_name'],$fileName)) {
		$result['errno'] = 104;
		$result['msg'] = '移动文件失败';
		return $result;
	} else {
		$result['errno'] = 200;
		$result['msg'] = $fileName;
		return $result;
	}
}


