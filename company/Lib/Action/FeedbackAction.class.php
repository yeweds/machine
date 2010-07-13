<?php 
class FeedbackAction extends GlobalAction 
{
	public function index()
	{
		$Feedback=D("Feedback");
		$count=$Feedback->count('ischecked=1');
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$Feedback->findAll('ischecked=1','*','id desc',$p->firstRow.','.$p->listRows);
		$page=$p->show();
		//分类
		$map['module']=1;//分类
		$Category=D('Category')->order("id desc")->where($map)->findall();
        $this->assign('cate',$Category);
		$this->assign('titler','留言反馈');
		$this->assign('list',$list);
		$this->assign('page',$page);
		$this->display();
	}
	public function write(){

		$this->display();

	}
	public function writes()
	{
		$seccode=trim($_POST['seccode']);
		if(md5($seccode)!=Session::get('verify'))$this->error('验证码错误!!!');
		$Feedback=D("Feedback");
        if($Feedback->create()) { 
        	
            if($Feedback->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L(_INSERTFAIL)); 
            } 
        }else{ 
            $this->error($Feedback->getError()); 
        } 
	}

}
?>