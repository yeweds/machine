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
class AnnounceModel extends Model 
{
	protected $_validate=array(
		array('title','require','标题必填',0,'','all'),
		array('content','require','内容必填',0,'','all'),
	);	
	protected $_auto	 =	 array(
		array('subject','dhtml','ALL','function'),
		array('postdate','time','ADD','function'),
		array('link','cvhttp','ALL','function'),
		);		
}
?>