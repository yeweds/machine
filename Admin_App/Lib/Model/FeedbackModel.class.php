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
class FeedbackModel extends Model 
{
	/**/
	protected $_validate=array(
		array('type','require','类型必填',0,'','all'),
		array('username','require','姓名必填',0,'','all'),
		array('content','require','留言内容必填',0,'','all'),
	);	
	
	protected $_auto	 =	 array(
		array('ischecked','0','ADD'),
		array('postdate','time','ADD','function'),
		array('replydate','time','ALL','function'),
	);	
}
?>