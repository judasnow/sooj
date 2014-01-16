<?php /* Smarty version 2.6.26, created on 2011-05-27 12:12:01
         compiled from ranklist/ranklist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'ranklist/ranklist.tpl', 57, false),)), $this); ?>
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

<div class="span-3">
<br />
</div>

<div id="ranklist" class="span-17">

<table>
	<caption>SOOJ 极客排名</caption>
	<tr>
	<th class="span-1 thead">名次</th>
	<th class="span-3 thead">用户</th>
	<th class="span-2 thead"></th>
	<th class="span-4 thead">签名</th>
	<th class="span-3 thead">最后登录系统时间</th>
	<th class="span-2 thead">Ac 率</th>
	</tr>

	<?php $_from = $this->_tpl_vars['ranks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['rank']):
?>
	<tr>
		 <?php $_from = $this->_tpl_vars['rank']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>

	 	 <?php if ($this->_tpl_vars['key'] == 'id'): ?>
	 	 	 <?php continue; ?>
	 	 <?php endif; ?>
	 	 
	 	 <?php if ($this->_tpl_vars['key'] == 'rank'): ?>

	 	 	 <?php if ($this->_tpl_vars['value'] == '1' || $this->_tpl_vars['value'] == '2' || $this->_tpl_vars['value'] == '3'): ?>
	 	 	 	 
	 	 	 	 <td class="rank one"><?php echo $this->_tpl_vars['value']; ?>
</td>
	 	 	 	 <?php continue; ?>
			 <?php endif; ?>
	 	 <?php endif; ?>

	 	 <?php if ($this->_tpl_vars['key'] == 'nick'): ?>
	 	 	 	 	 
	 	 	 <td class="nick"><span><?php echo $this->_tpl_vars['value']; ?>
</span><br /></td>
	 	 	 <?php continue; ?> 
	 	 <?php endif; ?>

	 	 <?php if ($this->_tpl_vars['key'] == 'head_img'): ?>
	 	 	 	 	 
	 	 	 <td><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('replace', true, $_tmp, 'big', 'small') : smarty_modifier_replace($_tmp, 'big', 'small')); ?>
" /></td>
	 	 	 <?php continue; ?> 
	 	 <?php endif; ?>

	 	 	 <td><?php echo $this->_tpl_vars['value']; ?>
</td>
	 	 <?php endforeach; endif; unset($_from); ?>
	</tr>
	<?php endforeach; endif; unset($_from); ?>

</table>

<div id="pager">	
	<?php echo $this->_tpl_vars['links']; ?>

</div>
</div>

<div class="span-3 last">
<br />
</div>

</div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'div/div_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</body>
</html>

