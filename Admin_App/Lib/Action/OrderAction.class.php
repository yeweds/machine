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
class OrderAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('product');	
	}

	public function index()
	{
		$Order=D("Order");
		$keyword=$_POST['username'];
		$keywords=$_REQUEST['keywords'];
		$pcode=intval($_REQUEST['pcode']);
		if($keyword){
			$data['username']=array('like','%'.$keyword.'%');
		}elseif ($keywords) {
			$data['username']=array('like','%'.safe_b64decode($keywords).'%');	
		}
		if ($pcode!='')$data['pcode']=$pcode; 
		$count=$Order->count($data);
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$Order->findAll($data,'*','id desc',$p->firstRow.','.$p->listRows);
		if ($keyword) $p->parameter='keywords='.safe_b64encode($keyword).'/pcode/'.$pcode;
		$page  = $p->show();
		if($list!==false){
			$this->assign('page',$page);
			$this->assign('list',$list);
			$this->assign('allowbat',$this->allowbat);
		}
		$this->display();
	}

	public function show()
	{
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Order=D("Order");
		$list=$Order->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$this->assign('vo',$list);
		$this->display();
	}
	public function update(){
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Order=D("Order");
		if($Order->create()) { 
            if($Order->save()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
                $this->error(L('_UPDATE_FAIL_')); 
            } 
        }else{ 
            $this->error($Order->getError()); 
        } 
	}
	public function submit(){
		$this->_subAction();
	}
	
}
?>