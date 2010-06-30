<?php 
class FeedbackModel extends Model 
{
	/**/
	protected $_validate=array(
		array('type','require','类型必填',0,'','all'),
		array('username','require','姓名必填',0,'','all'),
		array('content','require','留言内容必填',0,'','all'),
	);	
	
	protected $_auto	 =	 array(
		array('visible','0','ADD'),
		array('postdate','time','ADD','function'),
		array('replydate','time','ALL','function'),
	);	
	function dhtml($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtml($val);
		}
	} else {
		$string = str_replace(array('"', '\'', '<', '>', "\t", "\r", '{', '}'), array('&quot;', '&#39;', '&lt;', '&gt;', '&nbsp;&nbsp;', '', '&#123;', '&#125;'), $string);
	}
	return $string;
}
}
?>