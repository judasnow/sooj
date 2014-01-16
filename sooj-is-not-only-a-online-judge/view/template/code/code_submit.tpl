{?include file='div/div_html_head_info.tpl'?}

<body>

{?include file='div/div_pre_header.tpl'?}

<div class="container">

{?include file='div/div_header.tpl'?}

{?include file='div/div_nav.tpl'?}

<hr />

<div class="span-3">
<br />
</div>

<!--用户通过此模块提交代码-->
<div id="code_submit" class="span-17">

<!--提交代码输入框-->
<form method="post" action="do_code_process.php" name="code" id="code">

<input type="hidden" name="problem_no" value="{?$problem_no?}"/>
<!--当前代码信息-->
<p class="help">
	 {?* 没有题号信息或题号异常 *?}
	 {?if $problem_no?}

	 <span><a href="/sooj/controller/problem/ajax_problem_detail.php?no={?$problem_no?}">查看试题:<span class="helight">{?$problem_no?}</span></a></span> 
	 <span><a href="/sooj/controller/problem/problem_list.php">返回题目列表</a></span> 
	 <!--[if !IE]><!--><span><a href="#" onclick="sync_judge();">提交代码</a></span><!--[endif]-->
	 <!--[if gt IE 6]><span><a href="#" onclick="sync_judge();">提交代码</a></span><![endif]-->
	 <!--[if lte IE 6]><input type="submit" value="提交代码(For IE6)" valiable="none"/><![endif]-->
	 {?else?}

	 <span class="helight">sorry.没有题号信息请返回并重新选择</span> 
	 <span><a href="/sooj/controller/problem/problem_list.php">返回题目列表</a></span>

	 {?/if?}

</p>

{?if $problem_no?}

<!--控制面板可以拖动-->
<p class="control">
	 <!--选择编程语言-->
	 <select name="language">
	 	 <option value="c">C ( gcc version 4.4.5 )</option>
	 	 <!--option value="cpp">C++ ( gcc version 4.4.5 )</option>
	 	 <option value="py">Python2.5.2( coming soon )</option-->
	 </select>
</p>

<!--代码输入区-->
<div id="ol"><textarea cols="2" rows="10" id="li" disabled></textarea></div>
<textarea name="content" cols="60" rows="100" wrap="off" id="c2" onblur="check('2')" onkeyup="keyUp()" onFocus="clearValue('2')" onscroll="G('li').scrollTop = this.scrollTop;" oncontextmenu="return false"  class="grey" id="code_content"></textarea>

{?/if?}

<script language="javascript" type="text/javascript">
String.prototype.trim2 = function()
{
    return this.replace(/(^\s*)|(\s*$)/g, "");
}
function F(objid){
	return document.getElementById(objid).value;
}
function G(objid){
	return document.getElementById(objid);
}

var msgA=["msg1","msg2","msg3","msg4"];
var c=["c1","c2","c3","c4"];
var slen=[50,20000,20000,60];//允许最大字数
var num="";
var isfirst=[0,0,0,0,0,0];
function isEmpty(strVal){
	if( strVal == "" )
		return true;
	else
		return false;
}
function isBlank(testVal){		
    var regVal=/^\s*$/;
    return (regVal.test(testVal))
}
function chLen(strVal){
	strVal=strVal.trim2();
	var cArr = strVal.match(/[^\x00-\xff]/ig);
    return strVal.length + (cArr == null ? 0 : cArr.length);   	
}
function check(i){
	var iValue=F("c"+i);
	var iObj=G("msg"+i);
	var n=(chLen(iValue)>slen[i-1]);
	if((isBlank(iValue)==true)||(isEmpty(iValue)==true)||n==true){		
		iObj.style.display ="block";
	}else{		
		iObj.style.display ="none";
	}
}
function checkAll(){
	for(var i=0;i<msgA.length; i++){
		check(i+1);		
		if(G(msgA[i]).style.display=="none"){
			continue;
		}else{
			alert("填写错误,请查看提示信息！");
			return;
		}
	}
	G("form1").submit();	
}
function clearValue(i){
	G(c[i-1]).style.color="#000";
	keyUp();	
	if(isfirst[i]==0){
		G(c[i-1]).value="";
	}
	isfirst[i]=1;
}
function keyUp(){
	var obj=G("c2");
	var str=obj.value;	
	str=str.replace(/\r/gi,"");
	str=str.split("\n");
	n=str.length;
	line(n);
}
function line(n){
	var lineobj=G("li");
	for(var i=1;i<=n;i++){
		if(document.all){
			num+=i+"\r\n";
		}else{
			num+=i+"\n";
		}
	}
	lineobj.value=num;
	num="";
}
function autoScroll(){
	var nV = 0;
	if(!document.all){
		nV=G("c2").scrollTop;
		G("li").scrollTop=nV;
		setTimeout("autoScroll()",20);
	}	
}
if(!document.all){

	 window.addEventListener("load",autoScroll,false);
}
</script>

<script>

//查看题目详细
var ajax = new Control.Window($(document.body).down('[href=/sooj/controller/problem/ajax_problem_detail.php?no={?$problem_no?}]'),{  
    className: 'simple_window ajax_problem_detail',  
    closeOnClick: 'container',
    offsetLeft: 150
});

//异步提交表单
function sync_judge(){

	 var form = $('code'); 
	 var url='do_code_process.php';

	 new Ajax.Request(url, {

  	 	 method: 'post',
		 parameters: Form.serialize(form) ,
	 	 evalScripts: true ,
	 	 onCreate: function(){
		 	 
	 	 	 $("display_result").update( "<p><img src='/sooj/view/picture/loadinfo.gif' alt='Loading'/></p>" );
	 	 	 $("display_result").show();
	 	 } ,
  	 	 onSuccess: function(transport){
	 	 	 	 
	 	 	 alert( transport.responseText );
	 	 	 res = transport.responseText.evalJSON( true );
	 	 	 
	 	 	 lang = "<fieldset><legend><span>使用语言</span></legend><p>"+res.lang+"</p></fieldset>";
	 	 	 res = "<fieldset><legend><span>系统评测结果</span></legend><p>"+res.res+"</p></fieldset>";
	 	 	 compile_error_info = "<fieldset><legend><span>编译错误明细</span></legend><pre class='error'>"+res.compile_error_info+"</pre></p></fieldset>";
	 	 	 mem_peak = "<fieldset><legend><span>内存峰值</span</legend><p>"+res.mem_peak+"</p>></fieldset>";
	 	 	 run_time = "<fieldset><legend><span>运行时间</span></legend><p>"+res.run_time+"</p></fieldset>";
	 	 	 
	 	 	 $("display_result").update( lang + res + mem_peak + run_time + compile_error_info );
	 	 	 $("display_result").show();
	 	 }
});
}

//异步显示结果
var ajax = new Control.Window($(document.body).down('[href=/sooj/controller/code/ajax_judge_result.php]'),{  
    className: 'simple_window ajax_judge_reslut',
    closeOnClick: 'container',
    offsetLeft: 150
});

function h(){

	 $("display_result").hide();
}

</script>
</form>

</div>

<div class="span-3 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

<div id="display_result" class="simple_window" onclick="h();" style="display:none;"></div>
</body>
</html>


