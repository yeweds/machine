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
class UsergroupAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('usergroup');
	}
	public function index()
	{
		$Usergroup=D("Usergroup");
		$list=$Usergroup->findAll($data,'*','id desc','');
		if($list!==false){
			$this->assign('list',$list);
		}
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function adds()
	{
		$Usergroup=D("Usergroup");
        if($Usergroup->create()) { 
            if($Usergroup->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L(_INSERT_FAIL_)); 
            } 
        }else{ 
            $this->error($Usergroup->getError()); 
        } 
	}
	public function edit()
	{
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		if (in_array($id,array(1,2),true))$this->error('内置用户组不可编辑');
		$Usergroup=D("Usergroup");
		$list=$Usergroup->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$this->assign('vo',$list);
		$this->display();
	}	
	public function edits()
	{
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		if (in_array($id,array(1,2),true))$this->error('内置用户组不可编辑');
		$Usergroup=D("Usergroup");
		if($Usergroup->create()) { 
            if($Usergroup->save()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
                $this->error(L(_UPDATE_FAIL_)); 
            } 
        }else{ 
            $this->error($Usergroup->getError()); 
        } 
	}
	public function submit(){
		//防止删除默认用户组1,2,3
		$id=$_REQUEST['id'];
		if (in_array($id,array(1,2,3))) $this->error('默认用户组不允许删除');//默认用户组不允许删除
		//删除组之前将属于此组用户更新到"禁止访问"组，防止用户用户属于非法用户组
		$U=D('Member')->execute("UPDATE __TABLE__ SET groupid=2 where groupid=".$id);	
		if($U===false) $this->error(L('_OPERATION_FAIL_'));
		//更新成功后删除指定数据
		$this->_subAction();
	}		
}
?>