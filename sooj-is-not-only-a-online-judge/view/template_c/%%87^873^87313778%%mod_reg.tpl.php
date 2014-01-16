<?php /* Smarty version 2.6.26, created on 2011-05-13 05:06:52
         compiled from module/mod_reg.tpl */ ?>
<!--注册模块-->
<form id="reg" action="/sooj/controller/account/do_reg.php" method="post"> 
<fieldset> 
<legend>新用户注册</legend>

	 	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'module/mod_form_message.tpl', 'smarty_include_vars' => array('form_message' => $this->_tpl_vars['reg_fail_message'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 
	 <p>
	 	 <label for="username">用户名 (推荐使用email地址)</label><br> 
	 	 <input type="text" class="text" id="username" name="username" value=""><br />
	 	 <span>[a-zA-Z0-9_@]{3,16}</span> 
	 </p>
	 <p>
	 	 <label for="password">密码</label><br> 
	 	 <input type="password" class="text" id="password" name="password" value=""> 
	 </p>
	 <p>
	 	 <label for="nick">昵称(页面显示时使用的名字)</label><br> 
	 	 <input type="text" class="text" id="nick" name="nick" value=""><br />
	 	 <span>[\x00-\xffa-zA-Z0-9_]{3,16}</span>
	 </p>
	 
	 <!--p>
	 	 <input type="checkbox" id="o" name="o" class="checkbox"> 我已经阅读并同意左侧的使用条款
	 </p-->
	 <hr />
	 <p>
	 	 <input type="submit" value="马上注册" />
	 </p>

</fieldset> 
</form>
