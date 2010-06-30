<?php 
class LinkModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');	
	protected $_validate=array(
		array('title','require','网站名称必填',0,'','all'),
		array('url','require','链接地址必填',0,'','all'),
	);	
	protected $_auto	 =	 array(
		array('hidden','1','ADD'),
	);			
}
?>