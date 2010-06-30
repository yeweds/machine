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
class FeedbackAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('feedback');
		
	}

	public function index()
	{
		$Feedback=D("Feedback");
		$keyword=$_POST['keyword'];
		$keywords=$_REQUEST['keywords'];
		$uid=intval($_REQUEST['uid']);
		if($keyword){
			$data['content']=array('like','%'.$keyword.'%');
		}elseif ($keywords) {
			$data['content']=array('like','%'.safe_b64decode($keywords).'%');	
		}
		$count=$Feedback->count($data);
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$Feedback->findAll($data,'*','id desc',$p->firstRow.','.$p->listRows);
		if ($keyword) $p->parameter='keywords='.safe_b64encode($keyword);
		$page  = $p->show();
		if($list!==false){
			$this->assign('page',$page);
			$this->assign('list',$list);
			$this->assign('allowbat',$this->allowbat);
		}
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function adds()
	{
        $Feedback=D("Feedback");
        if($Feedback->create()) { 
            if($Feedback->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L('_INSERT_FAIL_')); 
            } 
        }else{ 
            $this->error($Feedback->getError()); 
        } 
 
	}
	public function edit()
	{
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Feedback=D("Feedback");
		$list=$Feedback->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$this->assign('vo',$list);
		$this->display();
	}
	public function edits()
	{
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Feedback=D("Feedback");
		if($Feedback->create()) { 
            if($Feedback->save()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
                $this->error(L('_UPDATE_FAIL_')); 
            } 
        }else{ 
            $this->error($Feedback->getError()); 
        } 
	}
	public function reply()
	{
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Feedback=D("Feedback");
		$list=$Feedback->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$this->assign('vo',$list);
		$this->display();
	}

	public function replysave()
	{
		$data=$_POST;
		$Feedback=D("Feedback");
		$data['replydate']=strtotime($data['replydate']);
		if($Feedback->create()) { 
			$Feedback->ischecked=1;
            if($Feedback->save()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
                $this->error(L('_UPDATE_FAIL_')); 
            } 
        }else{ 
            $this->error($Feedback->getError()); 
        }		
	}
	public function submit(){
		$this->_subAction();
	}
	
}
?>