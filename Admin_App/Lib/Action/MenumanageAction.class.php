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
class MenumanageAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('menumanage');
		
	}
	public function index()
	{
		$page=D("Top_menu");
		$count=$page->count();
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$page->findAll('','*','sortrank asc',$p->firstRow.','.$p->listRows);
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

		$Pages=D('Pages');
		$list=$Pages->findAll('','id,subject');
		$moduletype = array(1=>'产品',2=>'新闻',3=>'单页面',4=>"招聘",5=>"留言");
		$this->assign('pages', $list);
		$this->assign('moduletype', $moduletype);
		$this->display();
	}
	public function adds()
	{
		$Tmenu=D("Top_menu");
		$data['name']=$_POST['cname'];
		$data['module']=$_POST['module'];
		$data['sortrank']=$_POST['sortrank'];
		$data['pid']=implode(',', $_POST['pid']);
		switch((int)$_POST['module']){
			case 1:
				$data['link']='Product.html';
				break;
			case 2:
				$data['link']='Article.html';
				break;
			case 4:
				$data['link']='Job.html';
				break;
			case 5:
				$data['link']='Feedback.html';
				break;
			default:
				if ((int)$_POST['module']==3 && count($_POST['pid'])==1){
					$data['link']='Pages/'.$data['pid'].'.html';
				}else{
					$data['link']='';
				}
		}
		if($Tmenu->create()) { 
            if($Tmenu->add($data)){ 
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
		$Top_menu=D("Top_menu");
		$list=$Top_menu->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));		
		$listid = explode(',',$list['pid']);
		$Pages=D('Pages');
		$pageslist=$Pages->findAll('','id,subject');
		foreach ($pageslist as $k=>$val){
			$pageslist[$k]['checked']=0;
			foreach ($listid as $vv){
				if($val['id']==$vv){
					$pageslist[$k]['checked']=1;
				}
			}
		}
		$moduletype = array(1=>'产品',2=>'新闻',3=>'单页面',4=>"招聘",5=>"留言");
		$this->assign('pages', $pageslist);
		$this->assign('moduletype', $moduletype);
		$this->assign('vo',$list);
		$this->display();
	}
	public function edits()
	{
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$where=array('id'=>$id);
		$Top_menu=D("Top_menu")->where($where);
		$data['name']=$_POST['name'];
		$data['module']=$_POST['module'];
		$data['sortrank']=$_POST['sortrank'];
		if ($_POST['module']=='3'){
			$data['pid']=implode(',', $_POST['pid']);
		}else{
			$data['pid']='';
		}
		
		switch((int)$_POST['module']){
			case 1:
				$data['link']='Product.html';
				break;
			case 2:
				$data['link']='Article.html';
				break;
			case 4:
				$data['link']='Job.html';
				break;
			case 5:
				$data['link']='Feedback.html';
				break;
			default:
				if ((int)$_POST['module']==3 && count($_POST['pid'])==1){
					$data['link']='Pages/'.$data['pid'].'.html';
				}else{
					$data['link']='';
				}
		}
		if ($_POST['edit_on']){			
			$data['link']=$_POST['link'];
		}
		if($Top_menu->create()) { 
            if($Top_menu->where('id='.$id)->data($data)->save()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
                $this->error(L('_UPDATE_FAIL_')); 
            } 
        }else{ 
            $this->error($Pages->getError()); 
        } 
	}
	public function delete(){
		$getid=$_REQUEST['id'];
		if (!getid) $this->error(L('_SELECT_NOT_EXIST_'));
		$getids=implode(',',$getid);
		$id = is_array($getid)?$getids:$getid;
		if ($_REQUEST['selectall']){
			$Result=D('Top_menu')->execute('TRUNCATE table  __TABLE__ ');$say='删除成功';//删除						
		}else{
			$Result=D('Top_menu')->execute('DELETE FROM __TABLE__ where `id` IN ('.$id.')');$say='删除成功';//删除
		}
		if($Result===false){
			$this->assign('jumpUrl',__URL__/Menumanage/index);
			$this->error(L('_OPERATION_FAIL_'));
		}else{
			$this->assign('jumpUrl',__URL__/Menumanage/index);
			$this->success($say);
		}
	}
}
?>
