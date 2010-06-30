<?php
/*
　* @$Id
　* @
　* @Ver: 1.0
　* @Create: 2008-09-01 8:10
　* @Modify: 
　* @Author: shuguang http://www.shuguang.asia(web@shuguang.asia)
　* @Copyright (C) 2008 shuguang.asia. All Rights Reserved.
　* @License SHUGUANG CMS is free software and use is subject to license terms
　*/
class GlobalAction extends Action{
	private $groupId;
	private $userId;
	private $userName;
	function _initialize()
	{
		//初始化时获取用户ID和用户组ID
		$this->groupId=intval(Session::get('groupid'));
		$this->userId=intval(Session::get(C('USER_AUTH_KEY')));
		$this->userName=Session::get('username');
		//dump($this->groupId);
		/*
		限制允许进入后台的用户组,默认禁用此功能
		$allowAdmin=array(1,2);
		if(!isset($_SESSION[C('USER_AUTH_KEY')]) || !in_array($this->groupId,$allowAdmin,true) )
		*/
		if($this->userId==false ||$this->groupId==false )
		{
			$this->redirect('login','Public');
		}
	}
	/*
		获取用户ID
	*/
	Protected function getUid(){
		//$uid=intval($_SESSION[C('USER_AUTH_KEY')]);
		return $this->userId;
	}
	/*
		获取用户组ID
	*/
	Protected function getGid(){
		//$gid=intval($_SESSION['groupid']);
		return $this->groupId;
	}
	/*
		获取用户名
	*/
	Protected function getName(){
		//$gid=intval($_SESSION['groupid']);
		return $this->userName;
	}
	/*
		检查用户组权限
		@$module 可指定参数
	*/
	Protected function _checkSecurity($module='system'){
		$groupId=$this->getGid();//可直接设置为$this->groupId
			if (!$groupId) $this->error('用户组非法');//用户组非法
		//获取用户组ID权限
		$security=D('Usergroup')->where('id='.$groupId)->find();
			if (!$security) {
				$this->assign('jumpUrl',__APP__.'/Index/Public/login');
				//$this->error('未获取用户组ID权限，请联系系统管理员');
				
				//$this->success(L('未获取用户组ID权限，请联系系统管理员'));
			}
		switch ($module){
			case 'system':$result=intval($security['allowsystem']);break;
			case 'link':$result=intval($security['allowlink']);break;
			case 'scroll':$result=intval($security['allowscroll']);break;
			case 'database':$result=intval($security['allowdatabase']);break;
			case 'category':$result=intval($security['allowcategory']);break;
			case 'pages':$result=intval($security['allowpages']);break;
			case 'article':$result=intval($security['allowarticle']);break;
			case 'product':$result=intval($security['allowproduct']);break;
			case 'job':$result=intval($security['allowjob']);break;
			case 'feedback':$result=intval($security['allowfeedback']);break;
			case 'announce':$result=intval($security['allowannounce']);break;
			case 'member':$result=intval($security['allowmember']);break;
			case 'menumanage';$result=intval($security['allowmenumanage']);break;
			case 'usergroup':$result=intval($security['allowgroup']);break;
			case 'bat':$result=intval($security['allowbat']);break;
			default:$this->error('未知模块，无法检查权限');break;//未知操作
		}
		$this->allowbat=intval($security['allowbat']);//允许批处理
		$allowAdmin=1;
		if($result!==$allowAdmin)
		{
			$this->redirect('authorizationstop','Public');
		}
		
	}
	/*
		@ 模块 1产品 2新闻
		@ 栏目ID
		@ 检测操作 allowadd/allowedit/allowedit
	
	*/
	protected function _checkCategory($module,$cid,$action){
		$map['module']=$module;
		$map['id']=$cid;
		$groupId=$this->groupId;
			if ($groupId!=1){//非超级管理组则检测权限
				$security=D('Category')->find($map);
				$result=$security[$action];
				if ($result!="") {//栏目权限非空，则检测权限
					if(!in_array($groupId,array($result))){
							return false;
						}else{
							return true;
					}
				}else {
					return true;
				}
			}else {
				return true;
			}
	}
	
	/*
		@ 公共操作
		@ 删除/锁定/推荐/置顶/审核/移动
		@ $dbclass 指定操作数据库默认为 $this->name		
	*/
	public function _subAction($dbclass="")
	{
		$getid=$_REQUEST['id'];
		if (!$getid) $this->error('未选择记录') ;
		$getids=implode(',',$getid);
		//如果GETID为数组则需要判断是否有批量操作权限
		if (is_array($getid)) {
			$security=D('Usergroup')->find('id='.$this->groupId);
				if (!$security) $this->error('未获取用户组ID权限，请联系系统管理员');//未获取用户组ID权限，请联系系统管理员
				$allowbat=intval($security['allowbat']);
					if($allowbat!==1)$this->error('当前用户没有批量操作权限');//当前用户没有批量操作权限
		}
		$id = is_array($getid)?$getids:$getid;
		$act =$_REQUEST['act'];
		$category =$_REQUEST['category'];
		//过滤操作类型
		if (!$act) $this->error('操作类型必须选择');//操作类型必须选择
		$allowact=array('good','ugood','top','utop','ischecked','uischecked','remove','delete');
		if (!in_array($act,$allowact))$this->error('未知操作');//未知操作
		if (!$id) $this->error('ID丢失');
		$dbname=$dbclass==""?$this->name:$dbclass;
		$Category=D($dbname);
		switch ($act){
			case 'good':$Result=D($dbname)->execute('UPDATE __TABLE__ SET `isgood`=1 WHERE `id` IN ('.$id.')');$say='推荐成功';break;//推荐
			case 'ugood':$Result=D($dbname)->execute('UPDATE __TABLE__ SET `isgood`=0 WHERE `id` IN ('.$id.')');$say='取消推荐成功';break;//取消推荐
			case 'top':$Result=D($dbname)->execute('UPDATE __TABLE__ SET `istop`=1 WHERE `id` IN ('.$id.')');$say='置顶成功';break;//置顶
			case 'utop':$Result=D($dbname)->execute('UPDATE __TABLE__ SET `istop`=0 WHERE `id` IN ('.$id.')');$say='取消置顶成功';break;//取消置顶
			case 'ischecked':$Result=D($dbname)->execute('UPDATE __TABLE__ SET `ischecked`=0 WHERE `id` IN ('.$id.')');$say='审核成功';;break;//审核
			case 'uischecked':$Result=D($dbname)->execute('UPDATE __TABLE__ SET `ischecked`=1 WHERE `id` IN ('.$id.')');$say='取消审核成功';;break;//取消审核
			case 'remove':$Result=D($dbname)->execute('UPDATE __TABLE__ SET `cid`='.$category.' WHERE `id` IN ('.$id.')');$say='移动成功';;break;//移动
			case 'delete':$Result=D($dbname)->execute('DELETE FROM __TABLE__ where `id` IN ('.$id.')');$say='删除成功';;break;//删除
			default:$this->error(L('_OPERATION_WRONG_'));break;//未知操作类型
		}		
		if($Result===false){
			$this->error(L('_OPERATION_FAIL_'));
		}else{
			$this->assign('jumpUrl',__URL__/$dbname);
	        $this->success($say);
		}
		//$this->display('index');
		
	}
	/*
	@公共上传
	@模块
	@路径
	@是否生成缩略图
	*/
	public function _upload($module,$path,$thumb,$width,$height){
		$module=$module=""?'file':$module;//未知模块将存入file文件夹
		switch($module) {
            case 'article':$path=C(ATTACHDIR).'/article/'.$path.'/';break;
            case 'product':$path=C(ATTACHDIR).'/product/'.$path.'/';break;
            case 'link': $path=C(ATTACHDIR).'/logo/'.$path.'/';break;
            default:$path=C(ATTACHDIR).'/file/'.$path.'/';
        }
		if (!is_dir($path))	@mk_dir($path);    
		import("ORG.Net.UploadFile");
        $upload = new UploadFile();
		$upload->maxSize=C(ATTACHSIZE);
		$upload->allowExts=explode(',',strtolower(C(ATTACHEXT)));
		$upload->savePath=$path;
		$upload->saveRule='uniqid';
		isset($thumb)?$upload->thumb=$thumb:$upload->thumb=C(ATTACH);
		isset($width)?$upload->thumbMaxWidth=$width:$upload->thumbMaxWidth=C(THUMBMAXWIDTH);
		isset($height)?$upload->thumbMaxHeight=$height:$upload->thumbMaxHeight=C(THUMBMAXHEIGHT);
		$upload->thumbSuffix =C(THUMBSUFFIX); 
		//$upload->thumbMaxWidth =C(THUMBMAXWIDTH); 
		//$upload->thumbMaxHeight =C(THUMBMAXHEIGHT); 
        if(!$upload->upload()){
            //捕获上传异常
            return $this->error($upload->getErrorMsg());
        }else{
			//上传成功
			return $upload->getUploadFileInfo();
    	}
	}
	
}
?>