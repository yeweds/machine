<?php 
class ArticleModel extends Model 
{
	protected $_validate=array(
		array('subject','require','标题必填',0,'','all'),
		array('content','require','内容必填',0,'','all'),
	);	

	protected $_auto	 =	 array(
		array('postdate','time','ADD','function'),
	);
}
?>