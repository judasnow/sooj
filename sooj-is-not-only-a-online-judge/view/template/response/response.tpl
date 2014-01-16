{?include file='div/div_html_head_info.tpl'?}

<body>

{?include file='div/div_pre_header.tpl'?}

<div class="container">

{?include file='div/div_header.tpl'?}

{?include file='div/div_nav.tpl'?}

<hr />

<div class="span-7">
<br />
</div>

<div class="span-10">
	 <br />
	 <br />
	 {?if $response_message|@is_array?}
	 {?foreach key=key item=item from=$response_message?}	 
	 	 {?assign var=$key value=$item?}
	 {?/foreach?}

	 <p>
	 <div class="{?$type?}">
	 	<strong>{?$nick?}</strong> - {?$content?} - <a href="{?$url?}">{?$url_des?}</a>
	 </div>
	 </p>
	 {?/if?}
	 <br />
	 <br />
</div>

<div class="span-7">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>
