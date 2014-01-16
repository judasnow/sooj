<?php /* Smarty version 2.6.26, created on 2011-05-11 10:22:05
         compiled from response/response.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'response/response.tpl', 22, false),)), $this); ?>
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

<div class="span-7">
<br />
</div>

<div class="span-10">
	 <br />
	 <br />
	 <?php if (is_array($this->_tpl_vars['response_message'])): ?>
	 <?php $_from = $this->_tpl_vars['response_message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>	 
	 	 <?php $this->assign($this->_tpl_vars['key'], $this->_tpl_vars['item']); ?>
	 <?php endforeach; endif; unset($_from); ?>

	 <p>
	 <div class="<?php echo $this->_tpl_vars['type']; ?>
">
	 	<strong><?php echo $this->_tpl_vars['nick']; ?>
</strong> - <?php echo $this->_tpl_vars['content']; ?>
 - <a href="<?php echo $this->_tpl_vars['url']; ?>
"><?php echo $this->_tpl_vars['url_des']; ?>
</a>
	 </div>
	 </p>
	 <?php endif; ?>
	 <br />
	 <br />
</div>

<div class="span-7">
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