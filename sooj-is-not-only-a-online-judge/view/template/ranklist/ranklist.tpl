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

<div id="ranklist" class="span-17">

<table>
	<caption>SOOJ 极客排名</caption>
	<tr>
	<th class="span-1 thead">名次</th>
	<th class="span-3 thead">用户</th>
	<th class="span-2 thead"></th>
	<th class="span-4 thead">签名</th>
	<th class="span-3 thead">最后登录系统时间</th>
	<th class="span-2 thead">Ac 率</th>
	</tr>

	{? foreach item=rank key=key from=$ranks ?}
	<tr>
		 {? foreach item=value key=key from=$rank ?}

	 	 {? if $key == "id" ?}
	 	 	 {? php ?}continue;{? /php ?}
	 	 {? /if ?}
	 	 
	 	 {? if $key == "rank" ?}

	 	 	 {? if $value == '1' or $value == '2' or $value == '3' ?}
	 	 	 	 
	 	 	 	 <td class="rank one">{? $value ?}</td>
	 	 	 	 {? php ?}continue;{? /php ?}
			 {? /if ?}
	 	 {? /if ?}

	 	 {? if $key == 'nick' ?}
	 	 	 	 	 
	 	 	 <td class="nick"><span>{? $value ?}</span><br /></td>
	 	 	 {? php ?}continue;{? /php ?} 
	 	 {? /if ?}

	 	 {? if $key == 'head_img' ?}
	 	 	 	 	 
	 	 	 <td><img src="{? $value|replace:"big":"small" ?}" /></td>
	 	 	 {? php ?}continue;{? /php ?} 
	 	 {? /if ?}

	 	 	 <td>{? $value ?}</td>
	 	 {? /foreach ?}
	</tr>
	{? /foreach ?}

</table>

<div id="pager">	
	{? $links ?}
</div>
</div>

<div class="span-3 last">
<br />
</div>

</div>
</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>


