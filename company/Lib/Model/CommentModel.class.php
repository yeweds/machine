<?php 
class CommentModel extends Model 
{
	protected $_validate=array(
		array('username','require','姓名必填',0,'','all'),
		array('content','require','内容必填',0,'','all'),
	);	
	protected $_auto	 =	 array(
		array('ischecked','1','ADD'),
		array('postdate','time','ADD','function'),
		);		
}
?>