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

<!--竞赛信息列表-->
<div id="contest_list" class="span-17">

{?if $contest_list ?}

<table>
<caption>竞赛信息</caption>
<tr>
	 <th class="span-8 top_left_radius">名称</th>
	 <th class="span-2">状态</th>
	 <th class="span-5">开始时间</th>
	 <th class="span-5 top_right_radius">结束时间</th>
</tr>

{?foreach item=row key=key from=$contest_list?}

<tr>
	 {?foreach item=value key=key from=$row?}
	 {?if $key == 'id'?}
	 	 {?assign var='id' value=$value?}
	 	 {?php?}continue;{?/php?}
	 {?/if?}
	 
	 {?*链接到竞赛详细信息页面*?}
	 {?if $key == 'title'?}

	 <td><a href="/sooj/controller/contest/contest_detail.php?id={?$id?}">{?$value?}</a></td>
	 
	 {?php?}continue;{?/php?}
	 {?/if?}

	 {?*不同的状态有不同的颜色区分之*?}
	 {?if $key == 'status'?}
	 
	 {?* 比赛已经处于结束状态，需显示查看结果的链接 *?}
	
	 <td class="{?$value?}">
	 	 {?$value?}
	 	 {? if $value == 'ended' ?}
	 	 <span><a href="/sooj/controller/contest/view_contest_result.php?contest_id={?$id?}">结果</a></span>
	 	 {? /if ?}
	 </td>	

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
