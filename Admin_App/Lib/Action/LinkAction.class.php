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
class LinkAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('link');
	}

	public function index()
	{
		$Link=D("Link");
		$keyword=$_POST['keyword'];
		$keywords=$_REQUEST['keywords'];
		if($keyword){
			$data['title']=array('like','%'.$keyword.'%');
		}elseif ($keywords) {
			$data['title']=array('like','%'.safe_b64decode($keywords).'%');	
		}
		$count=$Link->count($data);
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$Link->findAll($data,'*','id desc',$p->firstRow.','.$p->listRows);
		if ($keyword) $p->parameter='keywords='.safe_b64encode($keyword);
		$page  = $p->show();
		if($list!==false){
			$this->assign('page',$page);
			$this->assign('keyword',$keyword);
			$this->assign('list',$list);
			$this->assign("linkfolder",__ROOT__.'/'.C(ATTACHDIR).'/logo');
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
		$url=$_REQUEST['url'];
		$file=$_FILES['img']['name'];
		if ($file){
			$uploadfile=$this->_upload('link','',false);
			$savefile=$uploadfile[0]['savename'];
		}
		$Link=D("Link");
		if($Link->create()) { 
			//$Link->url=substr($url,0,7)=="http://"?$url:'http://'.$url;
			$savefile=""?$Link->logo='':$Link->logo=$savefile;
            if($Link->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L('_INSERT_FAIL_'));  
            } 
        }else{ 
            $this->error($Link->getError()); 
        } 
	}	
	
	public function edit()
	{
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Link=D("Link");
		$list=$Link->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$this->assign('vo',$list);
		$this->display();
	}
	
	public function edits()
	{
		$url=$_REQUEST['url'];
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$logo=trim($_POST['logo']);//获取原图片
		$dellogo=intval($_POST['dellogo']);//是否转化为文字链接
		$savefile=$logo;
		$file=$_FILES['img']['name'];
		if ($file){	//如果图片不为空则上传新图片,删除旧图片
			$uploadfile=$this->_upload('link','',false);
			$savefile=$uploadfile[0]['savename'];
			@unlink(C(ATTACHDIR).'/logo/'.$logo);
		}
		$Link=D("Link");
		if($Link->create()) { 
			$Link->logo=$savefile;
			//转换成文字图片将删除源图片
				if ($dellogo==1) {
					@unlink(C(ATTACHDIR).'/logo/'.$logo);
					$Link->logo='';
				}
			//$Link->url=substr($url,0,7)=="http://"?$url:'http://'.$url;
            if($Link->save()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
               	$this->error(L('_UPDATE_FAIL_')); 
            } 
        }else{ 
            $this->error($Link->getError()); 
        }	       
	}	

	public function submit(){
		$this->_subAction();
	}
	
}
?>