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
class JobAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('job');
	}

	public function index()
	{
		$Job=D("Job");
		$keyword=$_POST['keyword'];
		$keywords=$_REQUEST['keywords'];
		if($keyword){
			$data['title']=array('like','%'.$keyword.'%');
		}elseif ($keywords) {
			$data['title']=array('like','%'.safe_b64decode($keywords).'%');	
		}
		$count=$Job->count($data);
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);		
		$list=$Job->limit($p->firstRow.','.$p->listRows)->order("id desc")->findAll($data);
		if ($keyword) $p->parameter='keywords='.safe_b64encode($keyword);
		$page  = $p->show();
		if($list!==false){
			$this->assign('list',$list);
			$this->assign('page',$page);
			$this->assign('allowbat',$this->allowbat);
		}
		$this->display();
	}
	public function adds()
	{
		$Job=D("Job");
		$exdate=trim($_POST['exdate']);
		//if (!is_numeric($exdate)) {
		//	$this->error("有效期限只能为数字"); 
		//}
		$Job->exdate=(int)($_POST['exdate']);
		if($Job->create()) { 
            if($Job->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L('_INSERT_FAIL_')); 
            } 
        }else{ 
            $this->error($Job->getError()); 
        } 
	}

	public function edit()
	{
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Job=D("Job");
		$list=$Job->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$this->assign('vo',$list);
		$this->display();
	}

	public function edits()
	{
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Job=D("Job");
		$exdate=trim($_POST['exdate']);
		if (!is_numeric($exdate)) {
			$this->error("有效期限只能为数字"); 
		}
		$Job->exdate=(int)($_POST['exdate']);
		if($Job->create()) { 
            if($Job->save()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
               	$this->error(L('_UPDATE_FAIL_')); 
            } 
        }else{ 
            $this->error($Job->getError()); 
        } 
	}
	public function Resume()
	{
		$id=$_GET['id'];
		$Resume=D("Resume");
		$keyword=$_GET['keyword'];
		if($id!='')
		$data['jid']=$id;
		if($keyword!='')
		$data['username']=array('like','%'.$keyword.'%');
		$count=$Resume->count($data);
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);		
		$page  = $p->show();
		$list=$Resume->limit($p->firstRow.','.$p->listRows)->order("id desc")->findAll($data);
		if($list!==false)
			$this->assign('list',$list);
			$this->assign('page',$page);
		$this->display();
	}
	public function show()
	{
		$id=intval($_GET['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Resume=D("Resume");
		$list=$Resume->find($id);
		$Job=D("Job");
		$j=$Job->find($$list->id);
		
		//dump($list);
		$this->assign('j',$j);
		$this->assign('vo',$list);
		$this->display();
	}	
	public function submit(){
		$this->_subAction();
	}
	public function resumedel(){
		$this->_subAction('Resume');
	}

}
?>