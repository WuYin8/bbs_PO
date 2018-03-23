<?php
include './config/common.php';
//这个常量现在能用吗？
include DOC_ROOT. 'helper/template.php';
include DOC_ROOT. 'config/home.php';
include DOC_ROOT. 'config/database.php';
include DOC_ROOT . 'helper/image.php';

include DOC_ROOT . 'helper/verify.php';

include DOC_ROOT . 'helper/upload.php';
include DOC_ROOT . 'helper/mysql.php';
include DOC_ROOT . 'helper/detailUse.php';

//连接数据库
$link = dbConnect(DB_HOST,DB_USER,DB_PWD,DB_NAME,DB_CHARSET);
if (!$link) {
	exit('数据库连接失败');
}