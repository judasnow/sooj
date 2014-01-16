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

<div id="welcome" class="span-13">
	 {? include file="module/mod_welcome.tpl" ?}
	 {? include file="module/mod_faq.tpl" ?}
</div>

<div class="span-7">
	<!-- ranklist 的前十 -->
	<table class="plugins" id="rank_list_top_10">
	<caption>用户积分 Top 10</caption>
		 <tr>
	 	 	 <th>排名</th>
	 	 	 <th>用户昵称</th>
	 	 	 <th>access/submit</th>
	 	 </tr>
	 	 {? foreach from=$plugins_rank_top_10 key=key item=item ?}
		 <tr>	 
	 	 	 {? foreach from=$item key=key item=item ?}

	 	 	 {? if $key == "user_id" ?}
	 	 	 	 {?php?}continue;{?/php?}
	 	 	 {? /if ?}
	 	 	 	 <td>{? $item ?}</td>
	 	 	 {? /foreach ?}
	 	 </tr>
	 	 {? /foreach ?}
	</table>

	<!-- 最新的竞赛信息 -->
	<table class="plugins" id="last_contest">
	<caption>最新的竞赛信息</caption>
		 <tr>
	 	 	 <th class="span-1"></th>
	 	 	 <th class="span-7">竞赛名称</th>
	 	 	 <th class="span-2">状态</th>
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
	 	 	 	 <td>{? $item ?}</td>
	 	 	 {? /foreach ?}
	 	 </tr>
	 	 {? /foreach ?}
	</table>

</div>

<div class="span-2 last">
	 <br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>

