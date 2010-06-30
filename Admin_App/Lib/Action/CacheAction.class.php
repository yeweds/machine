<?php
/*
　* @$Id
　* @
　* @Ver: 1.0
　* @Create: 2008-09-01 8:10
　* @Modify: 
　* @Author: shuguang http://www.shuguang.asia(web@shuguang.asia)
　* @Copyright (C) 2008 shuguang.asia. All Rights Reserved.
　* @License SHUGUANG CMS is free software and use is subject to license terms
　*/

class CacheAction extends GlobalAction{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('system');
		
	}
	
	public function index()
	{	
		$this->assign("cache",array(
			"Admin_App(后台)"=>array("模版缓存(Cache)"=>"./Admin_App/Cache","数据缓存目录(Temp)"=>"./Admin_App/Temp","日志目录(Logs)"=>"./Admin_App/Logs","数据目录(Data)"=>"./Admin_App/Data"),
			"Shuguang_App(前台)"=>array("模版缓存(Cache)"=>"./Shuguang_App/Cache","数据缓存目录(Temp)"=>"./Shuguang_App/Temp","日志目录(Logs)"=>"./Shuguang_App/Logs","数据目录(Data)"=>"./Shuguang_App/Data"),
			));
		$this->display();
	}
	public function submit(){
		$dirs = $_POST['id'];
		//dump($dirs);
		foreach($dirs as $value)
			{
				clearCache($type=0,$path=$value);
				$say.= "清理缓存文件夹成功! ".$value."</br>";
			}
			$this->success($say);
		
		
	}
	public  function cache(){
		
		
		
	}
}
?>