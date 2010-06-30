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
class CommentViewModel extends Model{
	protected $viewModel = true;
	protected $masterModel = 'Comment';	
	protected $viewFields = array(
		'Comment'=>array('id'=>'commentid','tid','ip','username'=>'commentuser','ischecked'=>'commentischecked','postdate'=>'commentpostdate'),
		'Article'=>array('id','subject','uid','attachthumb','color','istop','isgood','ischecked','username','comefrom','postdate','hits','ischecked','istop'),
		'Category'=>array('title'),
		);
	protected $viewCondition = array(
	"Comment.tid" => array('eqf',"Article.id"),
	"Article.id" => array('eqf',"Category.id"),
	);
	public function getPk() {
		return 'id';
	}
}
?>