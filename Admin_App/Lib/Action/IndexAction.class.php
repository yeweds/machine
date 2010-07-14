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

class IndexAction extends GlobalAction{
	public function main(){
		$Article=D('Article');
		$Member=D('Member');
		$Job=D('Job');
		$Feedback=D('Feedback');
		$ArticleC=$Article->count();
		$MemberC=$Member->count();
		$JobC=$Job->count();
		$FeedbackC=$Feedback->count();
		$this->assign(array('ArticleC'=>$ArticleC,
					'MemberC'=>$MemberC,
					'JobC'=>$JobC,
					'FeedbackC'=>$FeedbackC
		));
		//获取系统信息
		$config=new model();
		$array=array();
		$serverinfo = PHP_OS.' / PHP v'.PHP_VERSION;
		$serverinfo .= @ini_get('safe_mode') ? ' Safe Mode' : NULL;
		$dbversion = $config->query("SELECT VERSION()");
		$fileupload = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : '<font color="red">不支持上传</font>';
		$dbsize = 0;
		$tablepre = C('DB_PREFIX');
		$query = $tables = $config->query("SHOW TABLE STATUS LIKE '$tablepre%'");
		//dump($query);
		foreach($tables as $table) {
			$dbsize += $table['Data_length'] + $table['Index_length'];
		}
		$dbsize = $dbsize ? RealSize($dbsize) : '未知大小';
		$dbversion = $config->query("SELECT VERSION()");
		$magic_quote_gpc = get_magic_quotes_gpc() ? 'On' : 'Off';
		
		$array['serverinfo']=$serverinfo;
		$array['dbversion']=$dbversion;
		$array['fileupload']=$fileupload;
		$array['dbsize']=$dbsize;
		$array['dbversion']=$dbversion[0]['VERSION()'];
		$array['magic_quote_gpc']=$magic_quote_gpc;
		$this->assign($array);
		$this->display("Public:main");
	}	
	public function modify(){
		$id=intval($_REQUEST["id"]);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Member=D("Member")->find($id);
		if (!$Member) $this->error(L('_SELECT_NOT_EXIST_'));
		$this->assign('vo',$Member);
		$this->display();
		
		
	}
	public function modifys()
	{
		$password=$_POST['password'];
		$opassword=$_POST['opassword'];
		$id=intval($_POST['id']);
		if (!$id) $this->error(L('_SELECT_NOT_EXIST_'));
		$Member=D("Member");
		if($Member->create()) { 
			if($password!=''){
				$Member->password=md5($password);
			}else{
				$Member->password=$opassword;
			}
            if($Member->save()){ 
            	$this->assign('jumpUrl',__URL__/modify);
				$this->success(L('_UPDATE_SUCCESS_'));
            }else{ 
                $this->error(L(_UPDATE_FAIL_)); 
            } 
        }else{ 
            $this->error($Member->getError()); 
        } 
	}
	public function clear(){
		$temp = array(
			0 => './company/Temp',
		    1 => './company/Cache',
			//2 => './Application/Runtime/Logs',
			2 => './Admin_App/Temp/',
			3 => './Admin_App/Cache/'
		    );
		foreach ($temp as $v) {
			$this->delDir($v);
        }
		$this->success('已清空所有缓存！');
	}

	private function delDir($directory,$subdir=true)
	{
		if (is_dir($directory) == false)
		{
			return false;
		}
		$handle = opendir($directory);
		import("ORG.Io.Dir");
		while (($file = readdir($handle)) !== false)
		{
			if ($file != "." && $file != "..")
			{
			is_dir("$directory/$file")?
				Dir::delDir("$directory/$file"):
				unlink("$directory/$file");
			}
		}
		if (readdir($handle) == false)
		{
			closedir($handle);
			rmdir($directory);
		}
	}	
} 
?>