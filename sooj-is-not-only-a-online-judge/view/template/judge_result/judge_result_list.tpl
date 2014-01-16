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

{? if $judge_result_list ?}
<!--评测结果-->
<div id="judge_result" class="span-17">
<style>
#judge_result{}
#judge_result table{
	 border-collapse:collapse;
}
#judge_result th{ 
	 background:#51a1bc;
	 color:#fff;
	 font-weight:bold;
	 border-bottom:1px solid #e9e9e9;
}
#judge_result caption{
	 text-align:left;
	 background:#fff;
	 color:#dedede;
}
#judge_result td{
	 background:#fff;
 	 border-bottom:1px dotted #c0c0c0;
	 text-align:center;
}
#judge_result .ac{
	 font-weight:bold;
	 color:#0d0;
}
#judge_result .ce{
	 font-weight:bold;
	 color:#f33;
}
#judge_result .ve{
	 font-weight:bold;
	 color:#f99;
}
.top_left_radius{
	 border-top-left-radius:3px;
}
.top_right_radius{
	 border-top-right-radius:3px;
}
#judge_result a{
	 color:#069;
	 text-decoration:none;
}
#judge_result a:hover{
	 color:#f30;
	 text-decoration:none;
}
</style>
<table>
<caption>用户代码评测结果</caption>
<thead>
	 <th class="top_left_radius">Test ID</th>
	 <th>用户</th>
	 <th>题号</th>
	 <th>结果</th>
	 <th>内存消耗峰值</th>
	 <th>时间消耗</th>
	 <th>使用编程语言</th>
	 <th>代码文本长度</th>
	 <th class="top_right_radius">提交时间</th>
</thead>
<tbody id="result_list_tbody"> 

{? foreach item=row from=$judge_result_list ?}

<tr>	
	 {? foreach key=key item=value from=$row ?}	 
	 <td>
	 	 {? if $key == 'user_id' ?}
	 	 	 {? assign var=user_id value=$value ?}
	 	 	 {? php ?}continue;{? /php ?} 
	 	 {? /if ?}

	 	 {? if $key == 'nick' ?}
	 	 	 <a href="#">{? $value ?}</a>
	  	 	 {? php ?}continue;{? /php ?} 
	 	 {? /if ?}

	 	 {? if $key == 'result' ?}
			 <span class="{? $value|lower ?}">{? $value ?}</span>
			 {? php ?}continue;{? /php ?} 
	 	 {? /if ?}

	 	 {? if $value == '' ?}
			 -
	 	 {? else ?}
	 	 	 {? $value ?}
	 	 {? /if ?}
	 
	 </td>
	 {? /foreach ?}
</tr>

{?/foreach?}

</tbody> 
</table>

{?/if?}

<script>

function refresh(){

	 max_no = 0;
	 var url = '/sooj/controller/judge_result/refresh.php?max_no='+max_no
	 new Ajax.PeriodicalUpdater( 'result_list_tbody' , url, { 
	 
	 	 frequency:2, 
	 	 method: 'get',
	 	 insertion:'top',
	 	 decay:2,

	 	 onSuccess: function(transport){
	 	 	 //取最近5个结果，如果返回没有在此结果之内，便
	 	 	 //认为是有效的
	 	 	 transport = '';
	 	 	 alert( 'set null ok' );

	 	 },
	 	 onCreate: function(){
	 	 	 
	 	 },
		 onComplete: function(){
		 	  max_no = res.childElements()[0].childElements()[0].innerHTML;
	 	 	  var url = '/sooj/controller/judge_result/refresh.php?max_no='+max_no;
		 }
	 });
}

//refresh();
res = $('result_list_tbody')
max_no = res.childElements()[0].childElements()[0].innerHTML;
</script>

</div>

<div class="span-3 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>

