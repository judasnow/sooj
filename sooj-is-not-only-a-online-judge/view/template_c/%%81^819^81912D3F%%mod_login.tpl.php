<?php /* Smarty version 2.6.26, created on 2011-05-11 13:29:52
         compiled from module/mod_login.tpl */ ?>
<form id="login" action="/sooj/controller/account/do_login.php" method="post"> 

<fieldset> 
<legend>用户登录表单</legend>
	 
	 	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'module/mod_form_message.tpl', 'smarty_include_vars' => array('form_message' => $this->_tpl_vars['auth_fail_message'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

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
		
	 <?php if ($this->_tpl_vars['captcha']): ?>

	 <hr />
	 <p>
		 <!-- captcha -->
		 <img src="<?php echo $this->_tpl_vars['captcha_img']; ?>
"/><br>
		 <label for="captcha_input">请输入上图中的字母(不区分大小写)</label><br />
		 <input type="text" name="captcha_input" class=""/>
	 </p>

	 <?php endif; ?>

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