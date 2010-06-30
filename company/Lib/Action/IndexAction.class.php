<?php
class IndexAction extends GlobalAction 
{
	
	public function Index(){
		

		$Article=D("Article");
		//公司动态	
		$company_news=$Article->order('id desc')->where('cid=2')->limit('5')->findall();
		//行业动态
		$business_news=$Article->order('id desc')->where('cid=3')->limit('5')->findAll();
		if (S('pic')) {
			$Pic=S('pic');
		}else{
			$Pic=$Article->where("attachment!=''")->order('id desc')->limit('6')->findall();
			S('pic',$Pic,C('SDATA_TIME'));
		}
		//公司简介
		$intro=D('Pages')->where('id=1')->find();
		//企业文化
		$intro2=D('Pages')->where('id=2')->find();
		//服务项目
		$intro3=D('Pages')->where('id=3')->find();
		//成功案例
		$intro4=D('Product')->limit('4')->order('id desc')->findall();
		//服务承诺
		$intro5=D('Pages')->where('id=14')->find();
		//常见问题		
        $intro6=D('Pages')->where('id=15')->find();
		//产品
		//$Product=D('Product')->limit('8')->order('id desc')->findall();
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
		$this->assign('Scroll',$Scroll);
		$this->assign('Announce',$Announce);
		$this->assign('Link',$Link);
		$this->assign('company_news',$company_news);
		$this->assign('business_news',$business_news);
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
