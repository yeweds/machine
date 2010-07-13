<?php 
class JobAction extends GlobalAction 
{
	public function index()
	{
		$Job=D("Job");
		$count=$Job->count();
		import("ORG.Util.Page");
		$listRows=5;
		$p=new page($count,$listRows);	
		$list=$Job->findAll('','*','id desc',$p->firstRow.','.$p->listRows);
		//$list=$p->order('pid desc')->limit("$p->firstRow.','.$p->listRows")->findAll();
		$page  = $p->show();		
		$this->assign('titler','人才招聘');	
		$this->assign('list',$list);
		$this->assign('page',$page);
		//分类
		$map['module']=1;//分类
		$Category=D('Category')->order("id desc")->where($map)->findall();
        $this->assign('cate',$Category);
		$this->display();
	}
	public function read(){
		$id=intval($_REQUEST['id']);
		$Job=D("Job");
		$get=$Job->find($id);
		if (!$get) {
			$this->error("招聘信息不存在");
		}
		$this->assign('vo',$get);
		//分类
		$map['module']=1;//分类
		$Category=D('Category')->order("id desc")->where($map)->findall();
        $this->assign('cate',$Category);
		$this->display();		
	}
	public function resume(){
		$id=intval($_REQUEST['id']);
		$Job=D("Job");
		$get=$Job->find($id);
		if (!$get)$this->error("招聘不存在");
		$this->assign('vo',$get);
		$this->left_menu();
		$this->display();
		
	}
	public function resumes()
	{
		$jid=intval($_POST['jid']);
		$Resume=D("Resume");
		if($Resume->create()) { 
            if($Resume->add()){ 
            	$Job=D("Job");
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L('_INSERT_FAIL_')); 
            } 
        }else{ 
            $this->error($Resume->getError()); 
        }
		//分类
		$map['module']=1;//分类
		$Category=D('Category')->order("id desc")->where($map)->findall();
        $this->assign('cate',$Category);
 		$this->display("index");
	}
}
?>