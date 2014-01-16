<?php /* Smarty version 2.6.26, created on 2011-05-13 10:12:15
         compiled from module/mod_update_user_profile_nav.tpl */ ?>
<div id="update_user_profile_nav">
	 <ul>
	 <li><a href="update_user_profile.php"  <?php if ($this->_tpl_vars['sub_active'] == 'update_user_profile'): ?>class="active"<?php endif; ?>>基本信息</a></li>
	 <li><a href="update_user_head_img.php" <?php if ($this->_tpl_vars['sub_active'] == 'update_user_head_img'): ?>class="active"<?php endif; ?>>头像</a></li>
	 <li><a href="update_user_password.php" <?php if ($this->_tpl_vars['sub_active'] == 'update_user_password'): ?>class="active"<?php endif; ?>>帐号密码</a></li>
	 </ul>
</div>