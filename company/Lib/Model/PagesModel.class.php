<?php 
class PagesModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');
	/**/
	// 自动验证设置
	protected $_validate	 =	 array(
		array('subject','require','标题必须',0,'','all'),
		array('content','require','内容必须',0,'','all'),
	
	);

}
?>