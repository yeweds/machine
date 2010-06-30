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

class MenuAction extends GlobalAction{
	function _initialize()
	{
		parent::_initialize();
		$VERSION=C(SYSVERSION);
		$uid=$this->getUid();
		$username=$this->getName();
		$groupId=$this->getGid();
		if (!$groupId||!$uid) $this->redirect('login','Public');
		//获取用户组ID权限
		$security=D('Usergroup')->where('id='.$groupId)->find();
		if (!$security) $this->error(L('_shuguang_appNotGroupSecurity'));//未获取用户组ID权限，请联系系统管理员
		//dump($security);
		$this->assign('charset',C(TEMPLATE_CHARSET));
		$this->assign('version',$VERSION);
		$this->assign('uid',$uid);
		$this->assign('username',$username);
		$this->assign('security',$security);
		
	}
	public function menu(){
		$action=$_REQUEST['action'];
		$allowaction=array('systemconfig','category','article','product','job','feedback','announce','member','menumanage');
		//if (!in_array($action,$allowaction,true)) $this->error('未知操作');
		switch ($action){
			case 'Systemconfig':$url=__APP__.'/Settings';break;
			case 'Article':$url=__APP__.'/Article';break;
			case 'Product':$url=__APP__.'/Product';break;
			case 'Job':$url=__APP__.'/Job';break;
			case 'Feedback':$url=__APP__.'/Feedback';break;
			case 'Announce':$url=__APP__.'/Announce';break;
			case 'Member':$url=__APP__.'/Member';break;
			case 'Other':$url=__APP__.'/Pages';break;
			case 'Menumanage';$url=__APP__.'/Menumanage';break;
			default:$url=__APP__.'/Index/main';				
		}
		$this->assign('url',$url);
		$this->assign('action',$action);
		$this->display("Public:menu");
	}
	public function topmenu(){
		$this->assign('http',C('SITEURL'));
		$this->display("Public:topmenu");
	}		
} 
?>