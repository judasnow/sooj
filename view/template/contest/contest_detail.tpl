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

<span class="status">
	 {?if $status == 'ended'?}
	 	 已经结束，试题已经开放提交.
	 	 <span class="oper">
	 	 	 <a href="#">查看结果</a>
	 	 </p>
	 {?/if?}
	 {?if $status == 'pending'?}
	 	 正在准备中.
	 	 <span class="oper">
	 	 	 {? if $is_user_reg ?}
	 	 	 <b>你已经参加了这个比赛,
	 	 	 报名号为(作为比赛认证凭证):<span class="auth_code">{? $auth_code ?}</span>
	 	 	 </b>
			 <a href="/sooj/controller/contest/do_undo_reg_contest.php">退出这次比赛</a>
	 	 	 {? else ?}
	 	 	 	 <a href="/sooj/controller/contest/do_reg_contest.php">参加这次比赛</a>
	 	 	 {? /if ?}
	 	 </span>
	 {?/if?}
	 {?if $status == 'in_process' ?}
	 
	 正在进行.

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

{?/if?}
</span>
</p>

</div>

<div class="span-3 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>
