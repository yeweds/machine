<?php
class ContactAction extends GlobalAction {	
	public function index(){		
		$Settings=D('Settings')->findall();
		foreach ($Settings AS $key ){
			$this->assign($key['title'],$key['values']);
			//echo $key['title'].'--'.$key['values'].'<br>';
		}
		//分类
		$map['module']=1;//分类
		$Category=D('Category')->order("id desc")->where($map)->findall();
        $this->assign('cate',$Category);
		$this->display();		
	}
}
?>