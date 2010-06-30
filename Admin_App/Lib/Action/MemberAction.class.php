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
class MemberAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('member');
	}
	public function index()
	{
		//$Member=D("Member");
		$Member=D("MemberView");
		$keyword=$_POST['keyword'];
		$keywords=$_REQUEST['keywords'];
		if($keyword){
			$data['username']=array('like','%'.$keyword.'%');
		}elseif ($keywords) {
			$data['username']=array('like','%'.safe_b64decode($keywords).'%');	
		}
		$count=$Member->count($data);
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$Member->findAll($data,'*','Member.id desc',$p->firstRow.','.$p->listRows);
		if ($keyword) $p->parameter='keywords='.safe_b64encode($keyword);
		$page= $p->show();
		if($list!==false){
			$this->assign('page',$page);
			$this->assign('list',$list);
			$this->assign('allowbat',$this->allowbat);
		}
		$this->display();
	}
	public function add(){
		$Group=D('Usergroup')->order("id desc")->findall();
		if (!$Group) $this->error('用户组丢失，请检查');//用户组丢失，请检查
		$this->assign('group',$Group);
		$this->display();
	}
	public function adds()
	{
		$data=$_POST;
		$Member=D("Member");
        if($Member->create()) { 
        	$Member->password=md5($data['password']);
            if($Member->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L(_INSERT_FAIL_)); 
            } 
        }else{ 
            $this->error($Member->getError()); 
        } 
	}
	public function edit()
	{
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Member=D("Member");
		$list=$Member->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$Group=D('Usergroup')->order("id")->findall();
		if (!$Group) $this->error('用户组丢失，请检查');//用户组丢失，请检查
		$this->assign('group',$Group);
		$this->assign('list',$list);
		$this->display();
	}	
	public function edits()
	{
		$password=$_POST['password'];
		$opassword=$_POST['opassword'];
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Member=D("Member");
		if($Member->create()) { 
			if($password!=''){
				$Member->password=md5($password);
			}else{
				$Member->password=$opassword;
			}
				if($id==1) {
					//防止修改默认用户所发属组导致不能登录
					$Member->groupid=1;
					$Member->ischecked=1;
				}
		            if($Member->save()){ 
		            	$this->assign('jumpUrl',__URL__);
						$this->success(L('_UPDATE_SUCCESS_'));
		            }else{ 
		                $this->error(L(_UPDATE_FAIL_)); 
		            } 
        }else{ 
            $this->error($Member->getError()); 
        } 
	}
	public function submit(){
		$this->_subAction();
	}
}
?>