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

<!--竞赛详细信息，题目列表-->
<style>
#contest_detail{}
#contest_detail h2{ 
	 text-align:center;
	 color:#444;
}
#contest_detail table{}
#contest_detail caption{ 
	 background:#fff;
	 color:#999;
}
#contest_detail th{
	 font-weight:100;
	 color:#333;
}
#contest_detail td{
	 text-align:center;
}
.center{
	 text-align:center;
}
.start_time{
	 color:#32a81e;
	 font-weight:bold;
}
.end_time{
	 color:#f99;
	 font-weight:bold;
}
#contest_detail span{
	 margin:2px;
	 font-size:110%;
}
#contest_detail p{
	 background:#e0f2f8;
	 padding:15px;
	 color:#333;
	 border-radius:3px;
}
#contest_detail .status{
	 background:#c2e6f2;
	 color:#333;
	 padding:8px;
	 margin-top:10px;
	 border-radius:5px;
	 display:block;
	 border:1px solid #666;
}

#summary{}
#summary_content pre{
padding:5px;
background:#eee;
color:#444;
border-radius:5px;
}
#summary a{
	 color:#069;
	 padding:2px;
	 border-radius:5px;
	 text-decoration:none;
}
</style>
<div id="contest_detail" class="span-17">
<!--详细信息-->
<h2>{? $contest_title ?}</h2>
<hr />

<!-- 简要介绍 -->
<div id="summary">
<span><a href="#" onclick="Effect.toggle( 'summary_content' , 'BLIND' ); return false;">详细介绍</a></span>

<div id="summary_content">
<pre>
{? $summary ?}
</pre>
</div>
</div>

<p>
<span>开始时间 :</span><span class="start_time">{?$start_time?}</span><br />
<span>结束时间 :</span><span class="end_time">{?$end_time?}</span><br />
<span>当前系统时间 :</span><span>{?php?}echo date("Y-m-d H:i:s",time()+8*60*60);{?/php?}</span><br/>

<span class="status">已经结束，试题已经开放提交</span>
</p>

{?if $problem_list?}

<!--竞赛题目列表-->
<table>
<caption>竞赛题目列表</caption>
	 <tr>
	 	 <th class="span-2"></th>
	 	 <th class="span-2">题号</th>
	 	 <th class="span-6">标题</th>
	 </tr>

	 {?foreach item=row key=key from=$problem_list?}

	 <tr>	 
	 	 {?foreach from=$row item=value key=key?}
	 	 {?if $key == 'sorter'?}
	 	 	 <td>Problme :{?$value?}</td>
	 	 	 {?php?}continue;{?/php?}
	 	 {?/if?}

	 	 {?if $key == 'problem_no'?}
	 	 	 {?assign var='problem_no' value=$value?}
	 	 {?/if?}
	 	 
	 	 {?if $key == 'title'?}
	 	 	 <td><a href="/sooj/controller/problem/problem_detail.php?no={?$problem_no?}">{?$value?}</a></td>
	 	 	 {?php?}continue;{?/php?}
	 	 {?/if?}

	 	 <td>{?$value?}</td>
	 	 
	 	 {?/foreach?}
	 </tr>

	 {?/foreach?}
	 
</table>

{?/if?}

</div>

<div class="span-3 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>
