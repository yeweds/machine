<?php 
class ProductModel extends Model 
{
	protected $autoCreateTimestamps = array('postdate');
	protected $_validate=array(
		array('subject','require','产品名称必填',0,'','all'),
		array('content','require','产品说明必填',0,'','all'),
	);

}
?>