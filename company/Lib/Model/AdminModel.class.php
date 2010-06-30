<?php 
class AdminModel extends Model 
{
	protected $_validate=array(
		array('username','require','用户名必填',0,'','all'),
		array('password','require','密码必填',0,'','add'),
		array('username','','用户已经存在',0,'unique','add'), 
	);	
	protected $_auto	 =	 array(
		array('postdate','time','ADD','function'),
	);	
}
?>