<?php
class IndexAction extends GlobalAction 
{
	
	public function Index(){
		

		$Article=D("Article");
		//新闻动态	
		$news=$Article->order('id desc')->limit('5')->findall();
		if (S('pic')) {
			$Pic=S('pic');
		}else{
			$Pic=$Article->where("attachment!=''")->order('id desc')->limit('6')->findall();
			S('pic',$Pic,C('SDATA_TIME'));
		}
		//公司简介
		$intro=D('Pages')->where('id=1')->find();
		//产品
		$Product=D('Product')->limit('9')->order('hits desc')->findall();
		//链接
		if (S('link')) {
			$Link=S('link');
		}else{
			$Link=D('Link')->findall();
			S('link',$Link,C('SDATA_TIME'));
		}
		//公告
		$Announce=D('Announce')->order('id desc')->limit('8')->findall();
		//幻灯
		$Scroll=D('Scroll')->limit('5')->order('orders desc')->findall();
		//分类
		$map['module']=1;//分类
		$Category=D('Category')->order("id desc")->where($map)->findall();
        $this->assign('cate',$Category);     
		$this->assign('Scroll',$Scroll);
		$this->assign('Announce',$Announce);
		$this->assign('Link',$Link);
		$this->assign('news',$news);
		$this->assign('pic',$Pic);		
		$this->assign('Product',$Product);	
		$this->assign('intro',$intro);
		$this->assign('intro2',$intro2);
		$this->assign('intro3',$intro3);
		$this->assign('intro4',$intro4);
		$this->assign('intro5',$intro5);	
        $this->assign('intro6',$intro6);	
		//dump($intro4);
		$this->display();
	}	
		
		
}


?>
