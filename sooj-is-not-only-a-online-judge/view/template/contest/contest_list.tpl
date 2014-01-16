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
<style>
#contest_list{}
#contest_list table{
	 border-collapse:collapse;
	 padding:2px;
}
#contest_list caption{
	 background:#fff;
	 color:#969696;
}
#contest_list th{
	 background:#c2e1f3;
	 font-weight:100;
	 color:#333;
}
#contest_list td{
	 text-align:center;
	 background:#fff;
	 color:#666;
	 border-bottom:1px dotted #d0d0d0;
}
#contest_list td a{
	 text-decoration:none;
}
#contest_list .pending{
	 color:#693;
}
#contest_list .ended{
	 color:#f00;
}
.top_left_radius{
	 border-top-left-radius:3px;
}
.top_right_radius{
	 border-top-right-radius:3px;
}
</style>
<div id="contest_list" class="span-17">

{?if $contest_list ?}

<table>
<caption>竞赛信息</caption>
<tr>
	 <th class="span-8 top_left_radius">名称</th>
	 <th class="span-2">状态</th>
	 <th class="span-5">开始时间</th>
	 <th class="span-5">结束时间</th>
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
	 	 
	 <td class="{?$value?}">{?$value?}</td>	

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
