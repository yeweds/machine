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
class OrderModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');
	protected $_validate=array(
		array('numb','require','数量必填,面议请填0',0,'','all'),
		array('username','require','姓名必填',0,'','all'),
		array('address','require','地址必填',0,'','all'),
		array('tel','require','电话必填',0,'','all'),
	);	

}
?>