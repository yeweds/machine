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
		$this->left_menu();
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
		$this->left_menu();
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
        $this->left_menu();
 		$this->display("index");
	}
	public function left_menu()
	{
		$top_menu = D('Top_menu');
		$tp = $top_menu->where("name='服务项目'")->findAll('','id, name,pid');
		$menu = array();
		$Pages = D('Pages');
		$ps = $Pages->where("id in (".$tp[0]['pid'].")")->findAll();
		for ($i=0;$i<count($ps);$i++){
			$menu[$i]['subject']=$ps[$i]['subject'];
			$menu[$i]['link']='Pages/'.$ps[$i]['id'].'.html';
		}
		$this->assign('cate_name', $tp[0]['name']);
		$this->assign('left_menu', $menu);
	}

}
?>