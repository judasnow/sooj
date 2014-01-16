<?php /* Smarty version 2.6.26, created on 2011-06-17 13:48:18
         compiled from discuss/topic_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'is_array', 'discuss/topic_list.tpl', 22, false),array('modifier', 'truncate', 'discuss/topic_list.tpl', 47, false),)), $this); ?>
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

<!-- 帖子列表 -->
<div id="topic_list" class="span-17">

<?php if (is_array($this->_tpl_vars['topics'])): ?>

<p class="post_new_buttom">
	<a href="post_new_topic.php" >发起新问题</a>
</p>

<?php $_from = $this->_tpl_vars['topics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>

<div class="topic">
	
		<?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	
	<?php if ($this->_tpl_vars['key'] == 'topic_no'): ?>
		<?php $this->assign('topic_no', $this->_tpl_vars['item']); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['key'] == 'title'): ?>
		<?php $this->assign('title', $this->_tpl_vars['item']); ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['key'] == 'content'): ?>
			<?php $this->assign('summary', ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 300, "...", true) : smarty_modifier_truncate($_tmp, 300, "...", true))); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['key'] == 'poster_id'): ?>
		<?php $this->assign('poster_id', $this->_tpl_vars['item']); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['key'] == 'problem_no'): ?>
		<?php $this->assign('problem_no', $this->_tpl_vars['item']); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['key'] == 'post_time'): ?>
	 	 <?php $this->assign('post_time', $this->_tpl_vars['item']); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['key'] == 'view_count'): ?>
		 <?php $this->assign('view_count', $this->_tpl_vars['item']); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['key'] == 'reply_count'): ?>
		 <?php $this->assign('reply_count', $this->_tpl_vars['item']); ?>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>

	<p class="sub_topic">
	 
	 	<!-- 帖子主题 -->
		<div class="title span-8">
	 		 <a href="./topic_detail.php?topic_no=<?php echo $this->_tpl_vars['topic_no']; ?>
"><?php echo $this->_tpl_vars['title']; ?>
</a>
		</div>

		<!-- 帖子相关信息 -->
		<div class="topic_info">
	 	 	 <span class="username">纹身特湿<?php echo $this->_tpl_vars['username']; ?>
</span>
			 发表于 <?php echo $this->_tpl_vars['post_time']; ?>
 - 
			 浏览次数 <?php echo $this->_tpl_vars['view_count']; ?>
 ,
			 回复次数 <?php echo $this->_tpl_vars['reply_count']; ?>
 .
	 	 	 <!-- 相关题目 -->
	 	 	 <a href="?problem_no=<?php echo $this->_tpl_vars['problem_no']; ?>
" class="button"><?php echo $this->_tpl_vars['problem_no']; ?>
</a>
		</div>
	 </p>

</div>

<?php endforeach; endif; unset($_from); ?>

<div id="pager"><?php echo $this->_tpl_vars['links']; ?>
</div>

<?php else: ?>
	
	No topic yet....

<?php endif; ?>

</div>

<div class="span-3 last">
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