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

<h5>更新你的登录密码</h5>

<!--更新用户密码模块-->
<form action="/sooj/controller/account/do_update_user_password.php" method="post" enctype="multipart/form-data">
	 
	 {?*更改用户密码时的反馈信息*?}
	 {?if $update_user_password_message?}
	 <p>
	 <span class="update_message">{?$update_user_password_message?}</span>
	 </p>
	 {?/if?}

	 <p> 
	 <label for="head_url">当前密码</label><br />
	 <input type="password" name="old_password" id="old_password" />
	 </p>

	 <p>
	 <label for="head_url">新密码</label><br />
	 <input type="password" name="new_password" id="new_password" />
	 </p>

	 <p>
	 <label for="head_url">重新输入新密码</label><br />
	 <input type="password" name="new_password_check" id="new_password_check" />
	 </p>

	 <p>
	 <input type="submit" value="确认更新密码" />
	 </p>

</form>

</div>

<div class="span-4">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>
