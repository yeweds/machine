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
class MemberViewModel extends Model{
	protected $viewModel = true;
	//protected $masterModel = 'Member';
	protected $viewFields = array(
		'Member'=>array('id'=>'memberid','username','groupid','regtime','ischecked','realname','_type'=>'LEFT'),
		'Usergroup'=>array('id'=>'usergroupid','grouptitle','_on'=>'Member.groupid=Usergroup.id'),
		);
	//protected $viewCondition = array("Member.groupid" => array('eqf',"Usergroup.id"));
	
}
?>