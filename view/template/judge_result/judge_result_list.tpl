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
<table>
<caption>用户代码评测结果</caption>
<thead>
	 <th class="top_left_radius">Test ID</th>
	 <th>用户</th>
	 <th>题号</th>
	 <th>结果</th>
	 <th class="span-3">内存消耗峰值</th>
	 <th>时间消耗</th>
	 <th>使用编程语言</th>
	 <th>代码文本长度</th>
	 <th class="span-2"></th>
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

	 	 {? if $key == 'code_no' ?}
	 	 	 <a href="/sooj/controller/code/view_code.php?code_no={? $value ?}">看代码</a>
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

<div id="pager">{? $links ?}</div>

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

