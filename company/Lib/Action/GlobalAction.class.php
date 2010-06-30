<?php 
class GlobalAction extends Action  
{
	function _initialize()
	{
		if(C('STATUS')=='2'){
			die(C('STOPD'));
			exit();
		}
		if (S('settings')) {
			$Settings=S('settings');
		}else {
			$Settings=D('Settings')->findall();
			S('settings',$Settings,C('SDATA_TIME'));
		}
		foreach ($Settings AS $key ){
			$this->assign($key['title'],$key['values']);
		}
		$this->wp_menu();
	}
	function verify()
	{
		import('ORG.Util.Image');
		if(isset($_REQUEST['adv']))
		{
			Image::showAdvVerify();
		}
		else
		{
			Image::buildImageVerify();
		}
	}
	function wp_menu(){
		$top_menu = D('Top_menu');
		$list = $top_menu->findAll('', '*', 'sortrank asc');
		$menu = array();
		$pages = D('Pages');
		foreach ($list as $k=>$vl){
			$pids = $pages->query("select id, subject from __TABLE__ where id in (". $vl['pid'] .")");
			if ($pids){
				foreach ($pids as $key=>$pl){
					$pids[$key]['link']='Pages/'.$pl['id'].'.html';
				}
			}
			$menu[$k]['name']= $vl['name'];
			$menu[$k]['module']=$vl['module'];
			$menu[$k]['pids']=$pids;
			($vl['link'])?$menu[$k]['link']= $vl['link']:$menu[$k]['link']='';
		}
		//dump($menu);die();
		$this->assign('top_menu', $menu);
	}
}
?>
