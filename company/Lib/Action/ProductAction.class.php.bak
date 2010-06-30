<?php 
class ProductAction extends GlobalAction 
{
	public function index()
	{
		$id=intval($_REQUEST['id']);
		if ($id>0)$mapc['cid']=$id;
		$Product=D("Product");
		$count=$Product->count($mapc);
		//if($count<=1)$this->error('此类别无产品');
		import("ORG.Util.Page");
		$listRows=16;
		$p=new page($count,$listRows);
		$list=$Product->findAll($mapc,'*','id desc',$p->firstRow.','.$p->listRows);
		//$list=$p->order('pid desc')->limit("$p->firstRow.','.$p->listRows")->findAll();
		$page = $p->show();	
		/**/
		//分类
		$map['module']=1;//分类
		$Category=D('Category')->order("id desc")->where($map)->findall();
		$this->assign('titler','产品中心');
		$this->assign('cate',$Category);
		$this->assign('Product',$Product);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}
	public function read(){
		$id=intval($_REQUEST['id']);
		$Product=D("Product");
		$list=$Product->find($id);
		//dump($list);
		if (!$list) {
			$this->error("产品不存在");
		}
		//分类
		$Product->setINC('hits','id='.$id);
		$map['module']=1;//分类
		$Category=D('Category')->order("id desc")->where($map)->findall();
		$this->assign('cate',$Category);
		$this->assign('vo',$list);
		$this->display();
		
		
	}
	public function order(){
		$id=intval($_GET['id']);
		$Product=D("Product");
		$list=$Product->find($id);
		if (!$list) {
			$this->error("产品不存在");
		}		
		$this->assign('vo',$list);
		$this->display();
		
	}
	public function orders()
	{
		$Order=D("Order");
		if($Order->create()) { 
            if($Order->add()){ 
            	$this->assign('jumpUrl',__URL__);
				$this->success(L('_INSERT_SUCCESS_'));
            }else{ 
                $this->error(L('_INSERT_FAIL_')); 
            } 
        }else{ 
            $this->error($Order->getError()); 
        }		
        dump($id);
		$this->display("index");
	}

	public function insert()
	{
		$admin=D("order");
		$vo=$admin->create();
		$id = $admin->add();
		if($id) { //保存成功
			$this->assign('jumpUrl',__URL__);
            $this->success(L('_INSERT_SUCCESS_'));
        }else { 
            //失败提示
            $this->error(L('_INSERT_FAIL_'));
        }
        
		//$this->display("index");
        
	}
}
?>