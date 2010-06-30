<?php 
class PagesAction extends GlobalAction 
{
	public function read()
	{
		$id=intval($_REQUEST['id']);
		$Pages=D("Pages");
		$list=$Pages->find($id);
		$this->assign('vo',$list);
		if($id){$this->left_menu($id);}
		$this->display();
	}
	public function about()
	{
		$Pages=D("Pages");
		$condition['id']=17;
		$list=$Pages->find($condition);
		$this->assign('vo',$list);
		$this->display();
	}
	public function left_menu($id)
	{
		$top_menu = D('Top_menu');
		$tp = $top_menu->where("pid like '%".$id."%' ")->findAll('','id, name,pid');
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