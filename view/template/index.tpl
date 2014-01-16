{?include file='div/div_html_head_info.tpl'?}

<body>

{?include file='div/div_pre_header.tpl'?}

<div class="container">

{?include file='div/div_header.tpl'?}

{?include file='div/div_nav.tpl'?}

<hr />

<div class="span-1">
<br />
</div>

<div id="welcome" class="span-14">
	 {? include file="module/mod_welcome.tpl" ?}
	 {? include file="module/mod_faq.tpl" ?}
</div>

<!-- 占位 -->
<div class="span-1">
<br />
</div>

<div class="span-7">

	<!-- 最新的竞赛信息 -->
	<table class="plugins" id="last_contest">
	<caption>最新竞赛信息</caption>
		 <tr>
	 	 	 <th class="span-1 top_left_radius"></th>
	 	 	 <th class="span-7">竞赛名称</th>
	 	 	 <th class="span-2 top_right_radius">状态</th>
	 	 </tr>
	 	 {? foreach from=$last_contest key=key item=item ?}
		 <tr>	 
	 	 	 {? foreach from=$item key=key item=item ?}
	 	 
	 	 	 	 {? if $key == 'id' ?}
	 	 	 	 	 {? assign var=id value=$item ?}
	 	 	 	 {? /if ?}
	 	 	 	 {? if $key == 'title' ?}
	 	 	 	 	 <td><a href="/sooj/controller/contest/contest_detail.php?id={? $id ?}">{? $item ?}</a></td>
	 	 	 	 	 {? php ?}continue;{? /php ?}
	 	 	 	 {? /if ?}
	 	 	 	 {? if $key == 'status' ?}
	 	 	 	 	 {? if $item == "准备中" ?}
	 	 	 	 		  <td class="pending">{? $item ?}</td>
	 	 	 	 	 	  {? php ?}continue;{? /php ?}
	 	 	 	 	 {? /if ?}
	 	 	 	 {? /if ?}
	 	 	 	 <td>{? $item ?}</td>
	 	 	 {? /foreach ?}
	 	 </tr>
	 	 {? /foreach ?}
	</table>

	<!-- ranklist 的前十 -->
	<table class="plugins" id="rank_list_top_10">
	<caption>用户积分 Top 10</caption>
		 <tr>
	 	 	 <th class="top_left_radius">排名</th>
	 	 	 <th>用户昵称</th>
	 	 	 <th class="top_right_radius">access/submit</th>
	 	 </tr>
	 	 {? foreach from=$plugins_rank_top_10 key=key item=item ?}
		 <tr>	 
	 	 	 {? foreach from=$item key=key item=item ?}
	 	 	 
	 	 	 {? if $key == "user_id" or $key == "sb_count" or $key == "ac_count" ?}
	 	 	 	 {?php?}continue;{?/php?}
	 	 	 {? /if ?}
	 	 	 	 <td>{? $item ?}</td>
	 	 	 {? /foreach ?}
	 	 </tr>
	 	 {? /foreach ?}
	</table>

	<div class="plugins">
	<p>
	 如何使用本系统
	</p>
	</div>

</div>

<div class="span-1 last">
	 <br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>

