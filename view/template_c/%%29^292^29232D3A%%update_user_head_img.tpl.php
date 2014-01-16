<?php /* Smarty version 2.6.26, created on 2011-06-18 10:06:18
         compiled from account/update_user_head_img.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'account/update_user_head_img.tpl', 34, false),)), $this); ?>
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
<form action="/sooj/controller/account/do_update_user_head_img.php" method="post" enctype="multipart/form-data">
 
	 	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'module/mod_form_message.tpl', 'smarty_include_vars' => array('form_message' => $this->_tpl_vars['update_head_img_fail_message'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	 	 <label for="head_url">当前头像</label><br />

	 	 <hr />
		 <img src="<?php echo $this->_tpl_vars['head_img']; ?>
" style="margin:10px;"/>
		 <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['head_img'])) ? $this->_run_mod_handler('replace', true, $_tmp, 'big', 'small') : smarty_modifier_replace($_tmp, 'big', 'small')); ?>
" style="margin:10px;"/>
	 	 <hr />

	 	 <p>
	 	 <span>你可以上传JPG、JPEG、GIF、PNG或BMP文件.</span><br />
	 	 <label for="head_img">文件名:</label>
	 	 <input type="file" name="head_img" id="head_img" />
	 	 </p>

	 	 <p>
	 	 <input type="submit" value="马上更新头像" />
		 </p>

                 <p>
                 <?php if (! $this->_tpl_vars['gravatar_url']): ?>
	 	 您还可以使用<a href="http://en.gravatar.com/"> gravater </a>来设置头像,一劳永逸.
	 	 <?php else: ?>
	 	 您的email地址对应的 gravater 头像
	 	 <p><img src="<?php echo $this->_tpl_vars['gravatar_url']; ?>
" /></p>
	 	 <?php endif; ?> 
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