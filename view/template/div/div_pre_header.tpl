<!--页顶元素-->
<div id="pre_header">
	 {?if $nick?}

 	 <span class="normal">欢迎 <a href="/sooj/controller/account/update_user_profile.php" class="username">{?$nick?}</a></span>
	 <span class="separator">|<span>
	 <span ><a href="/sooj/controller/account/do_logout.php">退出登录</a></span>

	 {?else?}

	 <span><a href="/sooj/controller/account/reg.php">注册</a></span>
	 <span class="separator">|<span>
 	 <span><a href="/sooj/controller/account/login.php">登录</a></span>

	 {?/if?}
</div>
