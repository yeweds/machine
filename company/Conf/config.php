<?php
if (!defined('THINK_PATH')) exit();
$config	=	require 'config.inc.php';
$database	=	require 'database.inc.php';
$array	= array(
	
);


/*
return array(
	'DEBUG_MODE'=>true,
	'DEFAULT_MODULE'=>'index',
	'DB_FIELDS_CACHE'=>false,
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'localhost',
	'DB_NAME'=>'shuguang',
	'DB_USER'=>'root',
	'DB_PWD'=>'root',
	'DB_PORT'=>'3306',
	'DB_PREFIX'=>'shuguang_',
	'URL_MODEL'=>1,
	'LINKFOLDER'=>'Public/Uploads/logo/',
	'PRODUCTFOLDER'=>'Public/Uploads/product/',
	'ARTICLEFOLDER'=>'Public/Uploads/',
	'UPLOADSIZE'=>1024*1024,
	'ALLOWUPLOADEXT'=>'jpg,gif,png',	
	//'HTML_CACHE_ON'=>false,
	//'TMPL_CACHE_ON'			=>	false,
);
*/
return array_merge($config,$array,$database);
?>