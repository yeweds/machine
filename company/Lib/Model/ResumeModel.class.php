<?php 
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