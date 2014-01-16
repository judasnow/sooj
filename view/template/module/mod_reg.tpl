<!--注册模块-->
<form id="reg" action="/sooj/controller/account/do_reg.php" method="post"> 
<fieldset> 
<legend>新用户注册</legend>

	 {?*显示注册错误信息*?}
	 {? include file='module/mod_form_message.tpl' form_message=$reg_fail_message?}
	 
	 <p>
	 	 <label for="username">用户名 (推荐使用email地址)</label><br> 
	 	 <input type="text" class="text" id="username" name="username" value=""><br />
	 	 <span>用户名可以是数字,字母,下划线,`@`.(3到16个字符)</span> 
	 </p>
	 <p>
	 	 <label for="password">密码</label><br> 
	 	 <input type="password" class="text" id="password" name="password" value=""> 
	 </p>
	 <p>
	 	 <label for="nick">昵称(页面显示时使用的名字)</label><br> 
	 	 <input type="text" class="text" id="nick" name="nick" value=""><br />
	 	 <span>昵称可以是汉字,数字,字母,下划线.(亦3到16个字符)</span>
	 </p>
	 
	 <!--p>
	 	 <input type="checkbox" id="o" name="o" class="checkbox"> 我已经阅读并同意左侧的使用条款
	 </p-->
	 <hr />
	 <p>
	 	 <input type="submit" value="马上注册" />
	 </p>

</fieldset> 
</form>

