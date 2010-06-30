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
		$this->left_menu();
		$this->assign('titler','留言反馈');
		$this->assign('list',$list);
		$this->assign('page',$page);
		$this->display();
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