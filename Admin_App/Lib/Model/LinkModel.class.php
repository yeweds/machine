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
class LinkModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');	
	protected $_validate=array(
		array('title','require','网站名称必填',0,'','all'),
		array('url','require','链接地址必填',0,'','all'),
	);	
	protected $_auto	 =	 array(
		array('ischecked','1','ADD'),
		array('title','dhtml','ALL','function'),
		array('url','cvhttp','ALL','function'),
	);			
}
?>