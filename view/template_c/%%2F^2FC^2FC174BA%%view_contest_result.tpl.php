<?php /* Smarty version 2.6.26, created on 2011-06-16 12:02:02
         compiled from contest/view_contest_result.tpl */ ?>
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

<div class="span-2">
<br />
</div>

<!--显示竞赛结果-->
<div id="contest_result_list" class="span-19">
<table>
<caption>竞赛结果 | contest ranklist</caption>
	 <tr><th rowspan="2" class="border_bottom">Rank</th></tr>
	 	 
	 <!--试题编号-->
	 <tr>
	 	 <th class="border_bottom">User</th>
	 	 <th class="border_bottom">slove sum</th>
	 	 <th class="border_bottom">penalty sum</th>

	 	 	 	 <?php $_from = $this->_tpl_vars['contest_problem_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['problem']):
?>
	 	 <th class="border_bottom"><?php echo $this->_tpl_vars['problem']['problem_no']; ?>
</th>
	 	 <?php endforeach; endif; unset($_from); ?>
	 </tr>
	 	 <?php $this->assign('_rank', 1); ?>
	 	 	 	 <?php $_from = $this->_tpl_vars['contest_reslut_final']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['rank']):
?>
	 	 <tr>
	 	 <th><?php echo $this->_tpl_vars['_rank']; ?>
</th>
	 	 <th><?php echo $this->_tpl_vars['rank']['user_id']; ?>
</th>
		 <th><?php echo $this->_tpl_vars['rank']['slove_sum']; ?>
</th>
	 	 <th><?php echo $this->_tpl_vars['rank']['penalty_sum']; ?>
</th>
	 	 	 	 	 	 <?php $_from = $this->_tpl_vars['contest_reslut_detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['detail']):
?>
	 	 	 <?php if ($this->_tpl_vars['detail']['user_id'] == $this->_tpl_vars['rank']['user_id']): ?>
	 	 	 	 <?php if ($this->_tpl_vars['detail']['status'] != ''): ?>
	 	 	 	 	 <td><?php echo $this->_tpl_vars['detail']['status']; ?>
(+<?php echo $this->_tpl_vars['detail']['penalty']; ?>
)</td>
	 	 	 	 <?php else: ?>
	 	 	 	 	 <td>-</td>
	 	 	 	 <?php endif; ?>
	 	 	 <?php endif; ?>
	 	 	 <?php endforeach; endif; unset($_from); ?>
	 	 </tr>
		 <?php $this->assign('_rank', $this->_tpl_vars['_rank']+1); ?>
	 	 <?php endforeach; endif; unset($_from); ?>
</table>

</div>

<div class="span-2 last">
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
