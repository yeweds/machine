<?php 
class AnnounceAction extends GlobalAction 
{
	public function index()
	{
		$id=intval($_REQUEST['id']);
		$Announce=D("Announce");
		$count=$Announce->count();
		//if($count<=1)$this->error('此类别无产品');
		import("ORG.Util.Page");
		$listRows=16;
		$p=new page($count,$listRows);
		$list=$Announce->findAll($mapc,'*','id desc',$p->firstRow.','.$p->listRows);
		//$list=$p->order('pid desc')->limit("$p->firstRow.','.$p->listRows")->findAll();
		$page = $p->show();	
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}
	public function read(){
		$id=intval($_REQUEST['id']);
		$Announce=D("Announce");
		$Announces=$Announce->find($id);
		//dump($list);
		if (!$Announces) $this->error("公告不存在");
		$list=$Announce->findAll();
		
		$this->assign('list',$list);
		$this->assign('vo',$Announces);
		$this->display();

	}

}
?>