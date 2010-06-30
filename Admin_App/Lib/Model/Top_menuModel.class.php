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
class Top_menuModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');
	/**/
	// 自动验证设置
	protected $_validate	 =	 array(
		array('name','require','标题必须',0,'','all'),
		array('module','require','类型必须',0,'','all'),
		array('pid', 'require', '文章数组必须',0,'','all'),
		array('link', 'require', '不是必须的',0,'','all'),	
	);
	protected $_auto	 =	 array(
		array('name','dhtml','ALL','function'),
	);	
}
?>