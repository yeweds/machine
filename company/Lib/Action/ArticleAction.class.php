<?php 
class ArticleAction extends GlobalAction 
{
	public function index()
	{
		$id=intval($_REQUEST['id']);
		if ($id>0)$mapc['cid']=$id;
		$Article=D("Article");
		$count=$Article->count($mapc);
		import("ORG.Util.Page");
		$listRows=15;
		$p=new page($count,$listRows);
		$list=$Article->findAll($mapc,'*','id desc',$p->firstRow.','.$p->listRows);
		$page=$p->show();
		//分类
		$map['module']=2;//新闻分类
		$Category=D('Category')->order("id asc")->where($map)->findall();
		//title
		$this->assign('titler','公司新闻');
		$this->assign('cate',$Category);
		if ($id){
			$Ctitle=D('Category')->where(array('module'=>2, 'id'=>$id ))->find('', 'title');
		}else{
			$Ctitle=D('Category')->Where($map)->find('', 'title'); 
		}
	   	$this->assign('Ctitle', $Ctitle);
		$this->assign('list',$list);
		$this->assign('page',$page);
		$this->display();
	}
	public function read(){
		$id=intval($_REQUEST['id']);
		$Article=D("Article");
		$list=$Article->find($id);
		if (!$list) $this->error("信息不存在");
		$Article->setINC('hits','id='.$id);
		
		//分类
		$map['module']=2;//新闻分类
		$Category=D('Category')->order("id asc")->where($map)->findall();
		$this->assign('cate',$Category);
		//上一篇
		$front=$Article->where("id<".$id." and cid=".$list['cid'])->order('id desc')->limit('1')->find();
		$f=!$front?'没有了':'<A href="'.__URL__.'/'.$front['id'].'.html'.'">'.$front['subject'].'</A>';
		$this->assign('front',$f);
		//下一篇
		$after=$Article->where("id>".$id." and cid=".$list['cid'])->order('id desc')->limit('1')->find();
		$a=!$after?'没有了':'<A href="'.__URL__.'/'.$after['id'].'.html'.'">'.$after['subject'].'</A>';
		$this->assign('after',$a);
		$this->assign('vo',$list);
		//评论
		$Comment=D('Comment')->limit('5')->findall('tid='.$id);
		$this->assign('commentlist',$Comment);
		$this->display();

	}
	public function commentsave()
	{
		$seccode=trim($_POST['seccode']);
		if(md5($seccode)!=Session::get('verify'))$this->error('验证码错误!!!');
		$Comment=D("Comment");
        if($Comment->create()) { 
        	$Comment->ip=get_client_ip();
            if($Comment->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L(_INSERTFAIL)); 
            } 
        }else{ 
            $this->error($Comment->getError()); 
        } 
	}
}
?>
