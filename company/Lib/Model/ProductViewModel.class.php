<?php
class ProductViewModel extends Model{
	protected $viewModel = true;
	protected $masterModel = 'product';
	protected $viewFields = array(
		'product'=>array('id','cid','subject','spec','size','meno','keywords','content','pic','hidden','istop','hits','postdate','engsubject','engspec','engcontent'),
		'category'=>array('title'),
		);
	protected $viewCondition = array("product.cid" => array('eqf',"category.id"));
	public function getPk() {
		return 'id';
	}
}
?>