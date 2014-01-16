<?php /* Smarty version 2.6.26, created on 2011-05-13 10:12:15
         compiled from account/update_user_profile.tpl */ ?>
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

<!--更新用户信息模块-->
<form id="reg" action="/sooj/controller/account/do_update_user_profile.php" method="post">
	 	 
	 	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'module/mod_form_message.tpl', 'smarty_include_vars' => array('form_message' => $this->_tpl_vars['update_fail_message'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	 <p>
	 	 <label for="nick">昵称</label>
	 	 <input type="text" class="text" id="nick" name="nick" value="<?php echo $this->_tpl_vars['nick']; ?>
">
	 </p>

	 <p>
	 	 <label for="motto">签名</label>
	 	 <input type="text" class="text" id="motto" name="motto" value="<?php echo $this->_tpl_vars['motto']; ?>
"> 
	 </p>

	 <p>
	 	 <hr />
	 	 <label for="head_url">当前头像</label><br />
		 <img src="<?php echo $this->_tpl_vars['head_img']; ?>
"  style="margin:15px;"/>
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

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'div/div_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</body>
</html>



