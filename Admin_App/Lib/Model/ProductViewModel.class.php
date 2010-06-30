<?php
/*
　* @$Id
　* @
　* @Ver: 1.0
　* @Create: 2008-09-01 8:10
　* @Modify: 
　* @Author: shuguang http://www.shuguang.asia(web@shuguang.asia)
　* @Copyright (C) 2008 shuguang.asia. All Rights Reserved.
　* @License SHUGUANG CMS is free software and use is subject to license terms
　*/
class ProductViewModel extends Model{
	protected $viewModel = true;
	protected $masterModel = 'Product';
	protected $viewFields = array(
		'Product'=>array('id','cid','color','attachthumb','subject','spec','size','meno','keywords','content','ischecked','isgood','istop','hits','postdate','_type'=>'LEFT'),
		'Category'=>array('title','_on'=>'Product.cid=Category.id'),
		);
	//protected $viewCondition = array("Product.cid" => array('eqf',"Category.id"));
	public function getPk() {
		return 'id';
	}
}
?>