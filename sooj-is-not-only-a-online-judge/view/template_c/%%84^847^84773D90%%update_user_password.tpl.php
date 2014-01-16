<?php /* Smarty version 2.6.26, created on 2011-05-13 10:13:06
         compiled from account/update_user_password.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'div/div_html_head_info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<body>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'div/div_pre_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="container">


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'div/div_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'div/div_nav.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<hr />

<div class="span-4 last">
<br />
</div>

<div class="span-15 account">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'module/mod_update_user_profile_nav.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h5>更新你的登录密码</h5>

<!--更新用户密码模块-->
<form action="/sooj/controller/account/do_update_user_password.php" method="post" enctype="multipart/form-data">
	 
	 	 <?php if ($this->_tpl_vars['update_user_password_message']): ?>
	 <p>
	 <span class="update_message"><?php echo $this->_tpl_vars['update_user_password_message']; ?>
</span>
	 </p>
	 <?php endif; ?>

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

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'div/div_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</body>
</html>