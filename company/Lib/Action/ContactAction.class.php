<?php
class ContactAction extends GlobalAction {	
	public function index(){		
		$Settings=D('Settings')->findall();
		foreach ($Settings AS $key ){
			$this->assign($key['title'],$key['values']);
			//echo $key['title'].'--'.$key['values'].'<br>';
		}
		$this->left_menu();
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
}
?>