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
class DatabaseAction extends GlobalAction{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('database');
	}
	
	public function index()
	{
		$module=new model();
		$list=$module->query("show table status");
		$this->assign("list",$list);
	  	$this->display();
	}
	public function optimize(){
		@set_time_limit(0);
		$act=$_POST['action'];
		$db=$_POST['id'];
		$db = implode(',',$db);
		//dump($db);
		$module=new model();
		if ($act=='repair')
		{
			$d=$module->query("REPAIR TABLE $db");
		}
		if ($act=='optimize')
		{
			$d1=$module->query("OPTIMIZE TABLE $db");
		}
		//dump($d);
		//dump($d1);
		$this->assign('d',$d);
		$this->assign('d1',$d1);
		$this->display();
	}
	public function exesql(){
		$this->display();
	}
	public function executesql()
	{
		$db=new model();
	    $sql=$_POST['sql'];
	    $sql = stripslashes($sql);
		$this->assign('sql',$sql); 
		$l=$db->query($sql);
	        if ($l!==false) {
	         	 $type=1;
	        }else {
	        	 $type=0;
	        }
	   $this->assign('type',$type);
	   $this->display("exesql");
	}

	public function update(){

	}
	public  function cache(){
	
		
	}
}
?>