<?php
class ArticleViewModel extends Model{
	protected $viewModel = true;
	protected $masterModel = 'article';
	protected $viewFields = array(
		'article'=>array('id','subject','comefrom','postdate','hits','ischecked','istop'),
		'category'=>array('title'),
		);
	protected $viewCondition = array("article.cid" => array('eqf',"category.id"));
	public function getPk() {
		return 'id';
	}
}
?>