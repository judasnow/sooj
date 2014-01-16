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

<div id="problem_list" class="span-17">

{?if $spec_info ?}
<p id="spec_info"> 
<span>你已经失去竞赛状态，如需恢复，需要重新进入竞赛页面</span>
</p>
{?/if?}

<!--搜索题目-->
<div id="problem_search">
<form action="#" method="post">
	<label for="search_cond">搜索题目:</label>
	<input type="text" name="search_cond" class="search_text"/>
	
	<label for="search_option">按</label>
	<select name="search_option">
		 <option value="no">题号</option>
		 <option value="source">题目来源</option>
	</select>
	<input type="submit" value="search" />
</form>
</div>

{?* 大于30个结果才会使用置顶的导航栏 *?}
{?if $problem_num >= 15?}
<div class="pager">
{?$links?}
</div>
{?/if?}
	
{?if $problems ?}
<table>
<!--显示题目总数-->
{?if $problem_sum?}
<caption>题目总数:{?$problem_sum?}</caption>
{?/if?}

<thead> 
<tr>
	 <th class="span-1 top_left_radius">题号</th>
	 <th class="span-6">标题</th>
	 <th class="span-4">最给力</th>
	 <th class="span-2">提交次数</th>
	 <th class="span-2">AC次数</th>
	 <th class="span-2 top_right_radius">正确率(%)</th>
</tr>
</thead>

{?foreach key=key item=problem from=$problems?}
<tr>
	 {?foreach key=key item=value from=$problem?}

	 	 <td class="border-left">
	 	 
	 	 {?* 生成链接 *?}
	 	 {?if $key == "no"?}
	 	 	 {?assign var="no" value=$value?}
	 	 {?/if?}
	 	 {?if $key == "title"?}
	 	 	 <a href="/sooj/controller/problem/problem_detail.php?no={?$no?}">{?$value?}</a>
	 	 {?else?}
	 	 	 {?$value?}
	 	 {?/if?}

	 	 </td>

	 {?/foreach?}
</tr>
{?/foreach?}
</table>

<!--分页-->
<div id="pager">
{?$links?}
</div>

{?else?}
	 <p>没有合适的题目</p>
{?/if?}



<div class="span-3 last">
<br />
</div>

</div>
</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>

