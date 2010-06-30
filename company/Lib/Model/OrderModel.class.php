<?php 
class OrderModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');
	protected $_validate=array(
		array('numb','require','数量必填,面议请填0',0,'','all'),
		array('username','require','姓名必填',0,'','all'),
		array('address','require','地址必填',0,'','all'),
		array('tel','require','电话必填',0,'','all'),
	);	

}
?>