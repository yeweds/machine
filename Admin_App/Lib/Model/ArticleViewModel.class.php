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
class ArticleViewModel extends Model{
	protected $viewModel = true;
	protected $viewFields = array(
		'Article'=>array('id','subject','uid','attachthumb','color','istop','isgood','ischecked','username','comefrom','postdate','hits','ischecked','istop','_type'=>'LEFT'),
		'Category'=>array('title','_on'=>'Article.cid=Category.id'),
		);
	//protected $viewCondition = array("Article.cid" => array('eqf',"Category.id"));
	public function getPk() {
		return 'id';
	}
}
?>