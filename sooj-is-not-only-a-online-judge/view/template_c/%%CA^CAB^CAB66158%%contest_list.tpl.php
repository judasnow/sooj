<?php /* Smarty version 2.6.26, created on 2011-06-06 10:32:44
         compiled from contest/contest_list.tpl */ ?>
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

<!--竞赛信息列表-->
<style>
#contest_list{}
#contest_list table{
	 border-collapse:collapse;
	 padding:2px;
}
#contest_list caption{
	 background:#fff;
	 color:#969696;
}
#contest_list th{
	 background:#c2e1f3;
	 font-weight:100;
	 color:#333;
}
#contest_list td{
	 text-align:center;
	 background:#fff;
	 color:#666;
	 border-bottom:1px dotted #d0d0d0;
}
#contest_list td a{
	 text-decoration:none;
}
#contest_list .pending{
	 color:#693;
}
#contest_list .ended{
	 color:#f00;
}
.top_left_radius{
	 border-top-left-radius:3px;
}
.top_right_radius{
	 border-top-right-radius:3px;
}
</style>
<div id="contest_list" class="span-17">

<?php if ($this->_tpl_vars['contest_list']): ?>

<table>
<caption>竞赛信息</caption>
<tr>
	 <th class="span-8 top_left_radius">名称</th>
	 <th class="span-2">状态</th>
	 <th class="span-5">开始时间</th>
	 <th class="span-5">结束时间</th>
</tr>

<?php $_from = $this->_tpl_vars['contest_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>

<tr>
	 <?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	 <?php if ($this->_tpl_vars['key'] == 'id'): ?>
	 	 <?php $this->assign('id', $this->_tpl_vars['value']); ?>
	 	 <?php continue; ?>
	 <?php endif; ?>
	 
	 	 <?php if ($this->_tpl_vars['key'] == 'title'): ?>

	 <td><a href="/sooj/controller/contest/contest_detail.php?id=<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</a></td>
	 
	 <?php continue; ?>
	 <?php endif; ?>

	 	 <?php if ($this->_tpl_vars['key'] == 'status'): ?>
	 	 
	 <td class="<?php echo $this->_tpl_vars['value']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</td>	

	 <?php continue; ?>
	 <?php endif; ?>

	 <td><?php echo $this->_tpl_vars['value']; ?>
</td>
	 
	 <?php endforeach; endif; unset($_from); ?>
</tr>

<?php endforeach; endif; unset($_from); ?>

</table>
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