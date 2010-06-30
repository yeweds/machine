<?php 
class AnnounceModel extends Model 
{
	protected $_validate=array(
		array('title','require','标题必填',0,'','all'),
		array('content','require','内容必填',0,'','all'),
	);	
	protected $_auto	 =	 array(
		//array('status','1','ADD'),
		array('postdate','time','ADD','function'),
		);		
}
?>