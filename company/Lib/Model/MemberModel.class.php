<?php 
class MemberModel extends Model 
{
	protected $autoCreateTimestamps = array('regtime','lastlogintime');	
	protected $_validate=array(
		array('username','require','用户名必填',0,'','all'),
		array('password','require','密码必填',0,'','add'),
		array('question','require','密码问题必填',0,'','all'),
		array('answer','require','密码答案必填',0,'','all'),
		array('email','require','邮箱必填',0,'','all'),
		array('username','','用户已经存在',0,'unique','add'), 
	);



}
?>