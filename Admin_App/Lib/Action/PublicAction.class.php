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
class PublicAction extends Action{
	private $sid;
	private $groupid;
	function _initialize()
	{
		$this->sid=Session::get(C('USER_AUTH_KEY'));
		$this->groupid=Session::get('groupid');
	}

	public function login()
	{
		//if(!isset($this->sid) || $groupid!=1 || $groupid!=2)
		if(!isset($this->sid) || $this->groupid=='')
		{
			$this->display();
		}else{
			$this->redirect('index','Index');
		}
	}	
	public function checkLogin()
	{
		$Member=D('Member');
		$username=trim(dhtml($_POST['username']));
		$password=trim(dhtml($_POST['password']));
		$seccode=trim($_POST['seccode']);
		if($username=='')
		{
			$this->error('用户名不能为空!!!');
		}elseif($password==''){
			$this->error('密码不能为空!!!');
		}elseif(md5($seccode)!=Session::get('verify')){
			$this->error('验证码错误!!!');
		}
		$map=array();
		$map["username"]=$username;
		$user=$Member->find($map);
		if(false===$user)
		{
			$this->error('用户名不存在!!!');
		}else{
			if($user['password']!=md5($password))$this->error('密码错误!!!');
			if($user['ischecked']!=1)$this->error('用户被锁定');
			if($user['groupid']==2)$this->error('用户组被限制登录系统，请联系管理员');
				Session::set(C('USER_AUTH_KEY'),$user['id']);
				Session::set('username',$user['username']);
				Session::set('groupid',$user['groupid']);
				$this->redirect('index','Index');

		}
	}


	/*
	 +----------------------------------------------------------
     * 验证码显示
     +----------------------------------------------------------
     * @access public 
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     * @throws FcsException
     +----------------------------------------------------------
	*/
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

	public function authorizationstop() 
	{
		$this->display();
	}
	public function logout() 
    {

        if(isset($this->sid)) {
			Session::destroy();
            $this->assign("message",'登出成功!!!');
            $this->assign("jumpUrl",__URL__.'/login/');
        }else {
            $this->assign('error', '已经登出！');
        }
        $this->forward();
    }
}
?>