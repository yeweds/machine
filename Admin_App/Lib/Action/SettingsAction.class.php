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

class SettingsAction extends GlobalAction{
	function _initialize()
	{
		parent::_initialize();
		$this->_checkSecurity('system');
	}
	public function index()
	{	
		$list=D("Settings")->findall();
		foreach ($list AS $key ){
			//$set[$title['title']]=stripslashes($title['values']);
			$this->assign($key['title'],$key['values']);
		}
		$this->display();
	}
	public function update(){
		$Settings=D("Settings");
		$data=$_POST;
		//填充为空的项目		
		if($data["sitename"]=='')$data["sitename"]='shuguang cms' ;
		if($data["siteurl"]=='')$data["siteurl"]='http://www.shuguang.asia' ;
		if($data["attach"]=='')$data["attach"]='true' ;
		if($data["attachdir"]=='')$data["attachdir"]='Attachments' ;
		if($data["attachsize"]=='')$data["attachsize"]=1048576 ;
		if($data["attachext"]=='')$data["attachext"]='jpg,gif,png' ;
		if($data["thumbmaxwidth"]=='')$data["thumbmaxwidth"]=200 ;
		if($data["thumbmaxheight"]=='')$data["thumbmaxheight"]=300 ;
		if($data["thumbsuffix"]=='')$data["thumbsuffix"]='_thumb' ;
		if($data["seotitle"]=='')$data["seotitle"]='shuguang cms' ;
		if($data["seokeywords"]=='')$data["seokeywords"]='shuguang,cms' ;
		if($data["postcode"]=='')$data["postcode"]='' ;
		/**/
		//更新配置数据
        foreach($data AS $key => $value) {
            $s=$Settings->query("REPLACE INTO __TABLE__ VALUES ('$key', '$value');");
        }
        $list=$Settings->findall();   
        $content = "<?php\r\n//SHUGUANG CMS 核心配置文件\r\nif (!defined('THINK_PATH')) exit();\r\nreturn array(\r\n";
        //获取数组
		foreach ($list AS $title){
			$key=strtoupper($title['title']);
			$value=$title['values'];
			if(strtolower($value)=="true" || strtolower($value)=="false" || is_numeric($value)){
				if ($key=='FAX'){
					$content .= "\t'$key'=>'$value',\r\n";
				}else{
					$content .= "\t'$key'=>$value, \r\n";
				}
			}else{
				$content .= "\t'$key'=>'$value',\r\n";
			}
		}
		$content .= ");\r\n?>";
		//写入配置文件
	        $file='./config.inc.php';
      	    $r=@chmod($file,0777);
			$hand=file_put_contents($file,$content);
			if (!$hand) $this->error($file.'配置文件写入失败');
		$this->assign('jumpUrl',__URL__);
       	$this->success(L('_UPDATE_SUCCESS_'));
		
	}

}
?>