<form id="login" action="/sooj/controller/account/do_login.php" method="post"> 

<fieldset> 
<legend>用户登录表单</legend>
	 
	 {?*若登录时有错误信息*?}
	 {?include file='module/mod_form_message.tpl' form_message=$auth_fail_message?}

	 <p> 
	 	 <label for="username">用户名</label><br>
	 	 <input type="text" class="text" id="username" name="username" value="">
	 </p>

	 <p> 
	 	 <label for="password">密码</label><br> 
	 	 <input type="password" class="text" id="password" name="password" value=""> 
	 </p> 

	 <p>
		 <label for="remember_user">30 天不需要登录(非私人电脑慎选!)</label><br />
		 <input type="checkbox" name="remember_user" class=""/>
	 </p>
		
	 {?if $captcha?}

	 <hr />
	 <p>
		 <!-- captcha -->
		 <img src="{?$captcha_img?}"/><br>
		 <label for="captcha_input">请输入上图中的字母(不区分大小写)</label><br />
		 <input type="text" name="captcha_input" class=""/>
	 </p>

	 {?/if?}

	 <p>
	 	 <input type="submit" value="登录"> 
	 	 <input type="reset" value="重设">
	 </p>
	 <hr>
	 <div class="span-5">
	 	 <a href="reg.php">还不是会员?</a>
	 </div>

</fieldset>
</form>
