<?php
if (!defined('THINK_PATH')) exit();
$config	=require './config.inc.php';
$database=require './database.inc.php';
return array_merge($config,$database);

?>