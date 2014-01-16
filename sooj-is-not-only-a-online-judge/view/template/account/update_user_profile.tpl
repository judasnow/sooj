{?include file='div/div_html_head_info.tpl'?}

<body>

{?include file='div/div_pre_header.tpl'?}

<div class="container">


{?include file='div/div_header.tpl'?}

{?include file='div/div_nav.tpl'?}

<hr />

<div class="span-4 last">
<br />
</div>

<div class="span-15 account">

{?include file='module/mod_update_user_profile_nav.tpl'?}

<!--更新用户信息模块-->
<form id="reg" action="/sooj/controller/account/do_update_user_profile.php" method="post">
	 	 
	 {?*若更新时有错误信息*?}
	 {?include file='module/mod_form_message.tpl' form_message=$update_fail_message?}

	 <p>
	 	 <label for="nick">昵称</label>
	 	 <input type="text" class="text" id="nick" name="nick" value="{?$nick?}">
	 </p>

	 <p>
	 	 <label for="motto">签名</label>
	 	 <input type="text" class="text" id="motto" name="motto" value="{?$motto?}"> 
	 </p>

	 <p>
	 	 <hr />
	 	 <label for="head_url">当前头像</label><br />
		 <img src="{?$head_img?}"  style="margin:15px;"/>
	 </p>

	 <p>
	 	 <input type="submit" value="提交更改" />
	 </p> 

</form>
</div>

<div class="span-4 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>




