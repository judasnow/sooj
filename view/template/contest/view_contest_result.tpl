{?include file='div/div_html_head_info.tpl'?}

<body>

{?include file='div/div_pre_header.tpl'?}

<div class="container">

{?include file='div/div_header.tpl'?}

{?include file='div/div_nav.tpl'?}

<hr />

<div class="span-2">
<br />
</div>

<!--显示竞赛结果-->
<div id="contest_result_list" class="span-19">
<table>
<caption>竞赛结果 | contest ranklist</caption>
	 <tr><th rowspan="2" class="border_bottom">Rank</th></tr>
	 	 
	 <!--试题编号-->
	 <tr>
	 	 <th class="border_bottom">User</th>
	 	 <th class="border_bottom">slove sum</th>
	 	 <th class="border_bottom">penalty sum</th>

	 	 {?* 循环显示题目列表 *?}
	 	 {?foreach item=problem key=key from=$contest_problem_list?}
	 	 <th class="border_bottom">{?$problem.problem_no?}</th>
	 	 {?/foreach?}
	 </tr>
	 	 {?assign var="_rank" value=1?}
	 	 {?* 循环显示排名 *?}
	 	 {?foreach item=rank key=key from=$contest_reslut_final?}
	 	 <tr>
	 	 <th>{? $_rank ?}</th>
	 	 <th>{?$rank.user_id?}</th>
		 <th>{?$rank.slove_sum?}</th>
	 	 <th>{?$rank.penalty_sum?}</th>
	 	 	 {?* 循环显示具体的信息 *?}
	 	 	 {?foreach item=detail key=key from=$contest_reslut_detail?}
	 	 	 {?if $detail.user_id == $rank.user_id ?}
	 	 	 	 {?if $detail.status != '' ?}
	 	 	 	 	 <td>{?$detail.status?}(+{?$detail.penalty?})</td>
	 	 	 	 {?else?}
	 	 	 	 	 <td>-</td>
	 	 	 	 {?/if?}
	 	 	 {?/if?}
	 	 	 {?/foreach?}
	 	 </tr>
		 {?assign var="_rank" value=$_rank+1?}
	 	 {?/foreach?}
</table>

</div>

<div class="span-2 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>

