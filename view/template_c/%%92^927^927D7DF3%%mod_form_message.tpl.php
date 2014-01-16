<?php /* Smarty version 2.6.26, created on 2011-06-18 02:52:07
         compiled from module/mod_form_message.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'module/mod_form_message.tpl', 4, false),)), $this); ?>

<?php if (is_array($this->_tpl_vars['form_message'])): ?>
	<?php $this->assign('has_message', true); ?>
<?php else: ?>
	<?php $this->assign('has_message', false); ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['has_message']): ?>
<?php $_from = $this->_tpl_vars['form_message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	 <?php $this->assign($this->_tpl_vars['key'], $this->_tpl_vars['item']); ?>
<?php endforeach; endif; unset($_from); ?>

<div class="<?php echo $this->_tpl_vars['type']; ?>
"> 
 	 <?php echo $this->_tpl_vars['content']; ?>

</div>

<?php endif; ?>