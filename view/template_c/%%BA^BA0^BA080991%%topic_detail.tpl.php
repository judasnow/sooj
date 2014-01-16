<?php /* Smarty version 2.6.26, created on 2011-06-17 14:28:42
         compiled from discuss/topic_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'discuss/topic_detail.tpl', 30, false),)), $this); ?>
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

<!-- 帖子详细内容 -->
<div id="topic_detail" class="span-17">
	
	<!-- 帖子标题 -->
	<div class="topic_title"><?php echo $this->_tpl_vars['topic_title']; ?>
</div>
	
	<!-- 帖子详细内容 -->
	<div class="topic">

	 	 <!-- 帖子信息统计 -->
		 <div class="topic_info">
			发表于 <?php echo ((is_array($_tmp=$this->_tpl_vars['post_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y.%m.%d %H.%M.%S") : smarty_modifier_date_format($_tmp, "%Y.%m.%d %H.%M.%S")); ?>
 -
			浏览次数 <?php echo $this->_tpl_vars['view_count']; ?>

		 </div>

		 <!-- 帖子内容 -->
		 <div class="topic_content">

						<?php if ($this->_tpl_vars['content'] == ''): ?>
				content is empty ?! what`s wrong ... 
			<?php else: ?>
	 
				<?php echo $this->_tpl_vars['content']; ?>

	 	 
			<?php endif; ?>
		
		</div>
	 	 
	 	<div class="bottom">
	 	 	 
	 	 	 <div class="votes span-4">
	 	 	  	 
	 	 	 </div>
			 <!-- 发帖人信息 -->
	 		 <div class="poster_info span-4">
	 	 	 	 <div class="by">By</div>
				 <div class="user_head_img"><img src="/sooj/view/picture/user_head_img/small_<?php echo $this->_tpl_vars['poster_id']; ?>
.jpg" /></div>
				 <div class="user_info"><span><?php echo $this->_tpl_vars['poster_nick']; ?>
</span></div>
	 		 </div>
	 	</div>
	</div>

	<!-- replys -->
	<div class="reply_title"><?php echo $this->_tpl_vars['reply_count']; ?>
 回复</div>
	
	<?php if ($this->_tpl_vars['reply_count'] > 0 && $this->_tpl_vars['replys']): ?>
		<?php $_from = $this->_tpl_vars['replys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		
		<div class="reply">
	
		<?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
			<?php if ($this->_tpl_vars['key'] == 'content'): ?>
				<?php $this->assign('content', $this->_tpl_vars['item']); ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['key'] == 'replyer_id'): ?>
				<?php $this->assign('replyer_id', $this->_tpl_vars['item']); ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['key'] == 'replyer_nick'): ?>
				<?php $this->assign('replyer_nick', $this->_tpl_vars['item']); ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['key'] == 'reply_time'): ?>
				<?php $this->assign('reply_time', $this->_tpl_vars['item']); ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

			<div class="reply_info">
				 回复于 <?php echo ((is_array($_tmp=$this->_tpl_vars['reply_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y.%m.%d %H.%M.%S") : smarty_modifier_date_format($_tmp, "%Y.%m.%d %H.%M.%S")); ?>

			</div>
	
			<div class="reply_content">
						<?php if ($this->_tpl_vars['content'] == ''): ?>
				content is empty ?! what`s wrong ... 
			<?php else: ?>
				<?php echo $this->_tpl_vars['content']; ?>

			<?php endif; ?>
	 	 	
	 		<div class="bottom">
	 	 	 	 <div class="votes span-4">
	 	 	 	 </div>
	 	 	 	 <!-- 回复人信息 -->
	 		 	 <div class="poster_info span-4">
	 	 	 	 	 <div class="by">By</div>
				 	 <div class="user_head_img">
	 	 	 	 	 	 <img src="/sooj/view/picture/user_head_img/small_<?php echo $this->_tpl_vars['replyer_id']; ?>
.jpg" />
	 	 	 	 	 </div>
				 	 <div class="user_info"><span><?php echo $this->_tpl_vars['replyer_nick']; ?>
</span></div>
	 		 	 </div>
	 		 </div>
			 
	 	</div>	
		</div>

	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	
	<form method="post" action="do_reply.php" name="reply" id="reply_form" onsubmit="on_submit();">
	<input type="hidden" name="topic_no" value="<?php echo $this->_tpl_vars['topic_no']; ?>
" />
	<div id="post_you_answer">
		<div class="title">你的回应</div>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/mod_WYSIWYG.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
		<div class="submit"><input type="submit" value="发表回复"/></div> 
	</div>
	</form>

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