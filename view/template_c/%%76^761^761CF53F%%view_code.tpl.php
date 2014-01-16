<?php /* Smarty version 2.6.26, created on 2011-06-18 02:53:21
         compiled from code/view_code.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'div/div_html_head_info.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<link href="/sooj/view/css/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/sooj/view/js/lib/google-code-prettify/prettify.js"></script>

<body onload="prettyPrint()">

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

<div id="view_code" class="span-17">
<p>
<span class="code_no">代码编号:<?php echo $this->_tpl_vars['code_no']; ?>
</span>
<span class="user">贡献者用户ID:<?php echo $this->_tpl_vars['code_user']; ?>
</span>
<span class="lang">语言:<?php echo $this->_tpl_vars['lang']; ?>
</span>
<span><a href="#">返回</a></span>
</p>

<pre class="prettyprint">
<?php echo $this->_tpl_vars['content']; ?>

</pre>
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

<div id="display_result" class="simple_window" onclick="h();" style="display:none;"></div>
</body>
</html>

