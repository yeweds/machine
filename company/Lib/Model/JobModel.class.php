<?php 
class JobModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');
	/**/
	protected $_validate=array(
		array('title','require','职位名称必须',0,'','all'),
		array('nums','require','招聘人数必须',0,'','all'),
		array('exdate','require','有效时间必须',0,'','all'),
		array('address','require','工作地点必须',0,'','all'),
		array('tel','require','联系电话必须',0,'','all'),
		array('money','require','工资待遇必须',0,'','all'),
		array('intro','require','招聘要求必须',0,'','all'),
	);	
	
	protected $_auto	 =	 array(
		//array('status','1','ADD'),
	);
}
?>