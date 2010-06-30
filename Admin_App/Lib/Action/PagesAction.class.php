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
class PagesAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('pages');
		
	}
	public function index()
	{
		$page=D("Pages");
		$count=$page->count();
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$page->findAll('','*','id desc',$p->firstRow.','.$p->listRows);
		$page=$p->show();	
		if($list!==false){		
			$this->assign('list',$list);
			$this->assign('page',$page);
			$this->assign('allowbat',$this->allowbat);
		}
		$this->display();
	}

	public function add()
	{
		$this->display();
	}
	public function adds()
	{
		$Pages=D("Pages");
        if($Pages->create()) { 
            if($Pages->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L('_INSERT_FAIL_'));
            } 
        }else{ 
            $this->error($Pages->getError()); 
        } 
	}
	public function edit()
	{
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Pages=D("Pages");
		$list=$Pages->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$this->assign('vo',$list);
		$this->display();
	}
	public function edits()
	{
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Pages=D("Pages");
		if($Pages->create()) { 
            if($Pages->save()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
                $this->error(L('_UPDATE_FAIL_')); 
            } 
        }else{ 
            $this->error($Pages->getError()); 
        } 
	}
	public function submit(){
		$this->_subAction();
	}
}
?>