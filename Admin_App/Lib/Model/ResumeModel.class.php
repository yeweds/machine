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
class ResumeModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');
	/**/
	protected $_validate=array(
		array('username','require','姓名必填',0,'','all'),
		array('age','require','年龄必填',0,'','all'),
		array('degree','require','学历必填',0,'','all'),
		array('zhuanye','require','专业必填',0,'','all'),
		array('school','require','毕业学校必填',0,'','all'),
		array('gradyear','require','毕业时间必填',0,'','all'),
		array('tel','require','电话必填',0,'','all'),
	);	
	
}
?>