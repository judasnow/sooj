<?php /* Smarty version 2.6.26, created on 2011-05-11 08:09:58
         compiled from div/div_pre_header.tpl */ ?>
<!--页顶元素-->
<div id="pre_header">
	 <?php if ($this->_tpl_vars['nick']): ?>

 	 <span class="normal">欢迎 <a href="/sooj/controller/account/update_user_profile.php" class="username"><?php echo $this->_tpl_vars['nick']; ?>
</a></span>
	 <span class="separator">|<span>
	 <span ><a href="/sooj/controller/account/do_logout.php">退出登录</a></span>

	 <?php else: ?>

	 <span><a href="/sooj/controller/account/reg.php">注册</a></span>
	 <span class="separator">|<span>
 	 <span><a href="/sooj/controller/account/login.php">登录</a></span>

	 <?php endif; ?>
</div>