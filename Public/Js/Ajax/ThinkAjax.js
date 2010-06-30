// +----------------------------------------------------------------------+
// | ThinkPHP                                                             |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 liu21st.com All rights reserved.                  |
// +----------------------------------------------------------------------+
// | Licensed under the Apache License, Version 2.0 (the 'License');      |
// | you may not use this file except in compliance with the License.     |
// | You may obtain a copy of the License at                              |
// | http://www.apache.org/licenses/LICENSE-2.0                           |
// | Unless required by applicable law or agreed to in writing, software  |
// | distributed under the License is distributed on an 'AS IS' BASIS,    |
// | WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or      |
// | implied. See the License for the specific language governing         |
// | permissions and limitations under the License.                       |
// +----------------------------------------------------------------------+
// | Author: liu21st <liu21st@gmail.com>                                  |
// +----------------------------------------------------------------------+
// $Id$

// Ajax for ThinkPHP
document.write("<div id='ThinkAjaxResult' class='ThinkAjax' ></div>");
var m = {
	'\b': '\\b',
	'\t': '\\t',
	'\n': '\\n',
	'\f': '\\f',
	'\r': '\\r'
};
var ThinkAjax = {
	method:'POST',			//发送方法
	bComplete:false,			//是否完成
	updateTip:'数据处理中～',	//后台处理中提示信息
	updateEffect:{'opacity': [0.1,0.85]},			//更新效果
	target:'ThinkAjaxResult',	//提示信息对象
	showTip:true,	 // 是否显示提示信息，默认开启
	status:0, //返回状态码
	info:'',	//返回信息
	data:'',	//返回数据
	intval:0,
	debug:false,
	activeRequestCount:0,
	// Ajax连接初始化
	getTransport: function() {
		return Try.these(
		 function() {return new XMLHttpRequest()},
		  function() {return new ActiveXObject('Msxml2.XMLHTTP')},
		  function() {return new ActiveXObject('Microsoft.XMLHTTP')}
		 
		) || false;
	},
	loading:function (target,tips,effect){
		if ($(target))
		{
			//var arrayPageSize = getPageSize();
			var arrayPageScroll = getPageScroll();
			$(target).style.display = 'block';
			$(target).style.top = (arrayPageScroll[1] +  'px');
			$(target).style.right = '0px';
			// 显示正在更新
			if ($('loader'))
			{
				$('loader').style.display = 'none';
			}
			$(target).innerHTML = tips;
			//使用更新效果
			var myEffect = $(target).effects();
			myEffect.custom(effect);
		}
	},

	ajaxResponse:function(request,target,response){
		// 获取ThinkPHP后台返回Ajax信息和数据
		// 此格式为ThinkPHP专用格式
		//alert(request.responseText);
		var str	=	request.responseText;
		str  = str.replace(/([\x00-\x1f\\"])/g, function (a, b) {
                    var c = m[b];
                    if (c) {
                        return c;
                    }else{
						return b;
					}
                     }) ;
		if (this.debug)
		{
			// 调试模式下面输出eval前的字符串
			alert(str);
		}		
		$return =  eval('(' + str + ')');
		this.status = $return.status;
		this.info	 =	 $return.info;
		this.data = $return.data;

		// 处理返回数据
		// 需要在客户端定义ajaxReturn方法
		if (response == undefined)
		{
			try	{(ajaxReturn).apply(this,[this.data,this.status,this.info]);}
			catch (e){}
			 
		}else {
			try	{ (response).apply(this,[this.data,this.status,this.info]);}
			catch (e){}
		}
		if ($(target))
		{
			// 显示提示信息
			if (this.showTip && this.info!= undefined && this.info!='')
			$(target).innerHTML	= this.info;
			// 提示信息停留5秒
			if (this.showTip)
			this.intval = window.setTimeout(function (){
				var myFx = new Fx.Style(target, 'opacity',{duration:1000}).custom(1,0);
				$(target).style.display='none';
				},3000);
		}
	},
	// 发送Ajax请求
	send:function(url,pars,response,target,tips,effect)
	{
		var xmlhttp = this.getTransport();
		if (target == undefined)	target = this.target;
		if (effect == undefined)	effect = this.updateEffect;
		if (tips == undefined) tips = this.updateTip;
		if (this.showTip)
		{
			this.loading(target,tips,effect);
		}
		if (this.intval)
		{
			window.clearTimeout(this.intval);
		}
		this.activeRequestCount++;
		this.bComplete = false;
		try {
			if (this.method == "GET")
			{
				xmlhttp.open(this.method, url+"?"+pars, true);
				pars = "";
			}
			else
			{
				xmlhttp.open(this.method, url, true);
				xmlhttp.setRequestHeader("Method", "POST "+url+" HTTP/1.1");
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			}
			var _self = this;
			xmlhttp.onreadystatechange = function (){
				if (xmlhttp.readyState == 4 ){
					if( xmlhttp.status == 200 && !_self.bComplete)
					{
						_self.bComplete = true;
						_self.activeRequestCount--;
						_self.ajaxResponse(xmlhttp,target,response);
					}
				}
			}
			xmlhttp.send(pars);
		}
		catch(z) { return false; }
	},
	// 发送表单Ajax操作，暂时不支持附件上传
	sendForm:function(formId,url,response,target,tips,effect)
	{
		vars = Form.serialize(formId);
		this.send(url,vars,response,target,tips,effect);
	},
	// 绑定Ajax到HTML元素和事件
	// event 支持根据浏览器的不同 
	// 包括 focus blur mouseover mouseout mousedown mouseup submit click dblclick load change keypress keydown keyup
	bind:function(source,event,url,vars,response,target,tips,effect)
	{
		var _self = this;
	   $(source).addEvent(event,function (){_self.send(url,vars,response,target,tips,effect)});
	},
	// 页面加载完成后执行Ajax操作
	load:function(url,vars,response,target,tips,effect)
	{
		var _self = this;
	   window.addEvent('load',function (){_self.send(url,vars,response,target,tips,effect)});
	},
	// 延时执行Ajax操作
	time:function(url,vars,time,response,target,tips,effect)
	{
		var _self = this;
		myTimer =  window.setTimeout(function (){_self.send(url,vars,response,target,tips,effect)},time);
	},
	// 定制执行Ajax操作
	repeat:function(url,vars,intervals,response,target,tips,effect)
	{
		var _self = this;
		_self.send(url,vars,response,target,effect);
		myTimer = window.setInterval(function (){_self.send(url,vars,response,target,tips,effect)},intervals);
	}
}
