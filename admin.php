<?php 
define('THINK_PATH', './ThinkPHP');
define('APP_NAME', 'Admin_App');
define('APP_PATH', './Admin_App');
require(THINK_PATH."/ThinkPHP.php");
$App = new App(); 
$App->run();
?>