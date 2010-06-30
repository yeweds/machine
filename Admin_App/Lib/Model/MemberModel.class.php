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
class MemberModel extends Model 
{
	protected $autoCreateTimestamps = array('regtime','lastlogintime');	
	protected $_validate=array(
		array('username','require','用户名必填',0,'','all'),
		array('password','require','密码必填',0,'','add'),
		//array('question','require','密码问题必填',0,'','all'),
		//array('answer','require','密码答案必填',0,'','all'),
		//array('email','require','邮箱必填',0,'','all'),
		array('username','','用户已经存在',0,'unique','add'), 
	);



}
?>