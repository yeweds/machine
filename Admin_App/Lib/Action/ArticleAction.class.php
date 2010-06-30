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
class ArticleAction extends GlobalAction 
{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('article');
	}
	
	public function index()
	{
		$keyword=$_POST['keyword'];
		$keywords=$_REQUEST['keywords'];
		$uid=intval($_REQUEST['uid']);
		if($keyword){
			$data['subject']=array('like','%'.$keyword.'%');
		}elseif ($keywords) {
			$data['subject']=array('like','%'.safe_b64decode($keywords).'%');	
		}
		if ($uid!='') $data['uid']=$uid; 
		$Article=D("ArticleView");
		$count=$Article->count($data);
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$Article->findAll($data,'*','id desc',$p->firstRow.','.$p->listRows);
		//if ($keyword)$parameter='keywords='.safe_b64encode($keyword);
		if ($keyword) $p->parameter='keywords='.safe_b64encode($keyword);
		$page=$p->show();
		$map['module']=2;//新闻分类
		$Category=D('Category')->order("id desc")->where($map)->findall();
		$this->assign('cate',$Category);
		if ($list!==false) {
			$this->assign('page',$page);
			$this->assign('list',$list);
			$this->assign('count',$count);
			$this->assign('allowbat',$this->allowbat);
		}
		$this->display();
	}

	public function add()
	{
		$cid=$_REQUEST['catelist'];
		if(!$cid) $this->error('类别必须选择');//类别必须选择
		$allowadd=$this->_checkCategory(2,$cid,'allowadd');
		if($allowadd==false)$this->error('您无权限在当前类别发布新闻');//您无权限在当前类别发布新闻

		$uid=$this->getUid();
		/*读取用户*/ 
		$User=D("Member")->find($uid);
		if(!$User) $this->error('用户非法');//用户非法
		$this->assign('user',$User);
			//读取分类
			$map['module']=2;
			$Category=D('Category')->order("id desc")->where($map)->findall();
		$this->assign('cate',$Category);		
		$this->assign('cid',$cid);	
		$this->assign('Articlecate',$list);
		$this->display();
	}

	public function adds()
	{
		$cid=$_REQUEST['cid'];
		//检测权限
		$allowadd=$this->_checkCategory(2,$cid,'allowadd');
		if($allowadd==false)$this->error('您无权限新增');//您无权限在当前类别发布新闻
		$file=$_FILES['attachment']['name'];
		$savefile=$path=$savethumb='';
		$Article=D("Article");
		if($Article->create()) { 
			if ($file){
				$path=date('Ym');
				$uploadfile=$this->_upload('article',$path);
				$savefile=$uploadfile[0]['savename'];
				$savethumb=explode('.',$savefile);
				$savethumb=$savethumb[0].C(THUMBSUFFIX).'.'.$savethumb[1];
			}
			$Article->attachpath=$path;
			$Article->attachment=$savefile;
			$Article->attachthumb=$savethumb;
			if($Article->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L('_INSERT_FAIL_')); 
            } 
        }else{ 
            $this->error($Article->getError()); 
        } 
        
	}

	public function edit()
	{
		$id=intval($_REQUEST["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Article=D("Article");
		$list=$Article->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		//权限检查
		$cid=$list['cid'];
		$allowedit=$this->_checkCategory(2,$cid,'allowedit');
		if($allowedit==false)$this->error('您无权限编辑');//您无权限修改此新闻
			//读取分类
			$map['module']=2;
			$Category=D('Category')->order("id desc")->where($map)->findall();
			
		$this->assign('cate',$Category);
		$this->assign('vo',$list);
		$this->display();
	}

	public function edits()
	{
		$id=intval($_REQUEST['id']);
		$S=D('Article')->find($id);
		if (!$id||!$S) $this->error(L('_SELECT_NOT_EXIST_'));//检测编辑的内容是否存在
		$cid=intval($_REQUEST['cid']);
		$allowedit=$this->_checkCategory(2,$cid,'allowedit');
		if($allowedit==false)$this->error('您无权限编辑');//权限检查/您无权限修改此新闻
		$file=$_FILES['attachment']['name'];
		$attachment=$_POST['attachment'];
		$attachpath=$_POST['attachpath'];
		$attachthumb=$_POST['attachthumb'];
		$oldattachment=C(ATTACHDIR).'/article/'.$attachpath.'/'.$attachment;
		$oldattachthumb=C(ATTACHDIR).'/article/'.$attachpath.'/'.$attachthumb;
		$Article=D("Article");
		if($Article->create()){
			if ($file){
				if ($attachpath=="") $attachpath=date('Ym');
				$uploadfile=$this->_upload('article',$attachpath);
				$savefile=$uploadfile[0]['savename'];
				$savethumb=explode('.',$savefile);
				$savethumb=$savethumb[0].C(THUMBSUFFIX).'.'.$savethumb[1];
				@unlink($oldattachment);
				@unlink($oldattachthumb);
				$Article->attachpath=$attachpath;
				$Article->attachment=$savefile;
				$Article->attachthumb=$savethumb;
			}
            if($Article->save()){ 
	            	$this->assign('jumpUrl',__URL__);
					$this->success(L('_UPDATE_SUCCESS_'));
	            }else{ 
	                $this->error(L('_UPDATE_FAIL_')); 
	         }  
        }else{ 
            $this->error($Article->getError()); 
        } 
	}
	public function category(){
		$this->_checkSecurity('category');
		$Category=D("Category");
		$map['module']=2;
		$list=$Category->findAll($map,'*','id desc','');
		import('ORG.Util.Tree');
		if ($list!==false) {
			$this->assign('page',$page);
			$this->assign('list',$list);
		}
		$this->display();
		
	}
	public function categoryadd()
	{
		$this->_checkSecurity('category');
		$map['module']=2;
		$Category=D('Category')->order("id desc")->where($map)->findall();
		import('ORG.Util.Tree');	
		//用户组
		$Group=D('Usergroup')->where('ID NOT IN (1,2)')->order("id asc")->findall();
		if (!$Group) $this->error('用户组丢失，请检查');//用户组丢失，请检查
		$this->assign('html',$html);
		$this->assign('group',$Group);
		$this->display();
	}

	public function categoryadds()
	{	
		$this->_checkSecurity('category');
		$allowadd = $_POST['allowadd']==""?'':implode(',',$_POST['allowadd']);
		$allowedit =$_POST['allowedit']==""?'': implode(',',$_POST['allowedit']);
		$allowdel = $_POST['allowdel']==""?'':implode(',',$_POST['allowdel']);
		$Category=D("Category");
		if($Category->create()) { 
			$Category->allowadd=$allowadd;
			$Category->allowedit=$allowedit;
			$Category->allowdel=$allowdel;
			$Category->allowbat=$allowbat;
            if($Category->add()){ 
            	$this->assign('jumpUrl',__APP__.'/Article/category');
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L('_INSERT_FAIL_')); 
            } 
        }else{ 
            $this->error($Category->getError()); 
        } 
        
	}
	public function categoryedit()
	{
		$this->_checkSecurity('category');
		$id=intval($_GET["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Category=D("Category");
		$list=$Category->find($id);
		if (!$list) $this->error(L('_SELECT_NOT_EXIST_'));
		$parentId=$list['parentid'];//父ID
		$map['module']=2;
		$Category=D('Category')->order("id desc")->where($map)->findall();
		foreach($Category as $catid => $category)
		{
			$Categorys[$category['id']] = array('id'=>$category['id'],'parentid'=>$category['parentid'],'title'=>$category['title']);
		}
		import('ORG.Util.Tree');	
		$tree=new tree($Categorys);
		$str="<option value=\$id \$selected>\$spacer\$title</option>";
		$html.=$tree->get_tree(0,$str,$parentId);
		//用户组
		$Group=D('Usergroup')->where('ID NOT IN (1,2)')->order("id asc")->findall();
		if (!$Group) $this->error('用户组丢失，请检查');//用户组丢失，请检查
		$this->assign('group',$Group);
		$this->assign('html',$html);
		$this->assign('list',$list);
		$this->display();
	}
	public function categoryedits()
	{		
		$this->_checkSecurity('category');
		$allowadd = $_POST['allowadd']==""?'':implode(',',$_POST['allowadd']);
		$allowedit =$_POST['allowedit']==""?'': implode(',',$_POST['allowedit']);
		$allowdel = $_POST['allowdel']==""?'':implode(',',$_POST['allowdel']);
		$id=intval($_POST['id']);
		$parentid=intval($_POST['parentid']);
		$Category=D("Category");
		$Check=$Category->find();
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		//防止上级类别成为子类别
		if($parentid==$id){
			$parentid=0;
		}
		if($Category->create()) { 
			$Category->allowadd=$allowadd;
			$Category->allowedit=$allowedit;
			$Category->allowdel=$allowdel;
			$Category->allowbat=$allowbat;
			$Category->parentid=$parentid;
            if($Category->save()){ 
            	$this->assign('jumpUrl',__APP__.'/Article/category');
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
                $this->error(L('_UPDATE_FAIL_')); 
            } 
        }else{ 
            $this->error($Category->getError()); 
        } 
	}
	
	public function comment()
	{
		//$p->parameter='keyword=';
		$action=$_GET['action'];
		$keyword=$_POST['keyword'];
		$keywords=$_REQUEST['keywords'];
		if($keyword){
			$data['subject']=array('like','%'.$keyword.'%');
		}elseif ($keywords) {
			$data['subject']=array('like','%'.safe_b64decode($keywords).'%');	
		}
		$uid=intval($_GET['uid']);
		if ($uid!='')$data['uid']=$uid; 
		$Comment=D("CommentView");
		$count=$Comment->count($data);
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list	=$Comment->findAll($data,'*','comment.id desc',$p->firstRow.','.$p->listRows);
		if ($keyword) $p->parameter='keywords='.safe_b64encode($keyword);
		$page=$p->show();
		$this->assign('page',$page);
		$this->assign('list',$list);
		$this->display();
	}
	public function submit(){
		$act=$_REQUEST['act'];
		$id=$_REQUEST['id'];
		if($act=='delete'&&!is_array($id)){//单个删除时才检测栏目的删除权限
			$this->_checkSecurity('category');
			$S=D('Article')->find($id);
			if (!$id||!$S) $this->error(L('_SELECT_NOT_EXIST_'));//检测删除的内容是否存在
			$cid=$S['cid'];
			$allowedit=$this->_checkCategory(2,$cid,'allowdel');
			if($allowedit==false)$this->error('您无权限删除');//权限检查/您无权限删除此新闻
		}
		$this->_subAction();
	}
	public function categorysubmit(){
		$this->_subAction('Category');
	}	
	public function commentsubmit(){
		$this->_subAction('Comment');
	}
}
?>