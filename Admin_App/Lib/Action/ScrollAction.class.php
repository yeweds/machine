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
class ScrollAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('scroll');
	}

	public function index()
	{
		$Scroll=D("Scroll");
		$count=$Scroll->count();
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$Scroll->findAll($data,'*','id desc',$p->firstRow.','.$p->listRows);
		$page  = $p->show();
		if($list!==false){	
			$this->assign('page',$page);
			$this->assign('list',$list);
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
		$savefile='';
		$file=$_FILES['img']['name'];
		
		if ($file){
			$uploadfile=$this->_upload('link','',false);
			$savefile=$uploadfile[0]['savename'];
		}

		$Scroll=D("Scroll");
		if($Scroll->create()) { 
			$savefile=""?$Scroll->attachment='':$Scroll->attachment=$savefile;
            if($Scroll->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L('_INSERT_FAIL_'));  
            } 
        }else{ 
            $this->error($Scroll->getError()); 
        } 
	}	
	
	public function edit()
	{
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Scroll=D("Scroll");
		$list=$Scroll->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$this->assign('vo',$list);
		$this->display();
	}
	
	public function edits()
	{
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$attachment=trim($_POST['attachment']);//获取原图片
		$savefile=$attachment;
		$file=$_FILES['img']['name'];
		if ($file){	//如果图片不为空则上传新图片,删除旧图片
			$uploadfile=$this->_upload('link','',false);
			$savefile=$uploadfile[0]['savename'];
			@unlink(C(ATTACHDIR).'/logo/'.$attachment);
		}
		$Scroll=D("Scroll");
		if($Scroll->create()) { 
			$Scroll->attachment=$savefile;
            if($Scroll->save()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
               	$this->error(L('_UPDATE_FAIL_')); 
            } 
        }else{ 
            $this->error($Scroll->getError()); 
        }	       
	}	

	public function submit(){
		$this->_subAction();
	}
	
}
?>