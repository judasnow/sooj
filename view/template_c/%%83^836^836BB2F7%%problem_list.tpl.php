<?php /* Smarty version 2.6.26, created on 2011-06-18 04:24:14
         compiled from problem/problem_list.tpl */ ?>
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

<div id="problem_list" class="span-17">

<?php if ($this->_tpl_vars['spec_info']): ?>
<p id="spec_info"> 
<span>你已经失去竞赛状态，如需恢复，需要重新进入竞赛页面</span>
</p>
<?php endif; ?>

<!--搜索题目-->
<div id="problem_search">
<form action="#" method="post">
	<label for="search_cond">搜索题目:</label>
	<input type="text" name="search_cond" class="search_text"/>
	
	<label for="search_option">按</label>
	<select name="search_option">
		 <option value="no">题号</option>
		 <option value="source">题目来源</option>
	</select>
	<input type="submit" value="search" />
</form>
</div>

<?php if ($this->_tpl_vars['problem_num'] >= 15): ?>
<div class="pager">
<?php echo $this->_tpl_vars['links']; ?>

</div>
<?php endif; ?>
	
<?php if ($this->_tpl_vars['problems']): ?>
<table>
<!--显示题目总数-->
<?php if ($this->_tpl_vars['problem_sum']): ?>
<caption>题目总数:<?php echo $this->_tpl_vars['problem_sum']; ?>
</caption>
<?php endif; ?>

<thead> 
<tr>
	 <th class="span-1 top_left_radius">题号</th>
	 <th class="span-6">标题</th>
	 <th class="span-4">最给力</th>
	 <th class="span-2">提交次数</th>
	 <th class="span-2">AC次数</th>
	 <th class="span-2 top_right_radius">正确率(%)</th>
</tr>
</thead>

<?php $_from = $this->_tpl_vars['problems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['problem']):
?>
<tr>
	 <?php $_from = $this->_tpl_vars['problem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>

	 	 <td class="border-left">
	 	 
	 	 	 	 <?php if ($this->_tpl_vars['key'] == 'no'): ?>
	 	 	 <?php $this->assign('no', $this->_tpl_vars['value']); ?>
	 	 <?php endif; ?>
	 	 <?php if ($this->_tpl_vars['key'] == 'title'): ?>
	 	 	 <a href="/sooj/controller/problem/problem_detail.php?no=<?php echo $this->_tpl_vars['no']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</a>
	 	 <?php else: ?>
	 	 	 <?php echo $this->_tpl_vars['value']; ?>

	 	 <?php endif; ?>

	 	 </td>

	 <?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<!--分页-->
<div id="pager">
<?php echo $this->_tpl_vars['links']; ?>

</div>

<?php else: ?>
	 <p>没有合适的题目</p>
<?php endif; ?>



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
