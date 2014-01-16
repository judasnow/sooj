<?php /* Smarty version 2.6.26, created on 2011-06-18 12:56:35
         compiled from index.tpl */ ?>
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

<div class="span-1">
<br />
</div>

<div id="welcome" class="span-14">
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/mod_welcome.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "module/mod_faq.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<!-- 占位 -->
<div class="span-1">
<br />
</div>

<div class="span-7">

	<!-- 最新的竞赛信息 -->
	<table class="plugins" id="last_contest">
	<caption>最新竞赛信息</caption>
		 <tr>
	 	 	 <th class="span-1 top_left_radius"></th>
	 	 	 <th class="span-7">竞赛名称</th>
	 	 	 <th class="span-2 top_right_radius">状态</th>
	 	 </tr>
	 	 <?php $_from = $this->_tpl_vars['last_contest']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		 <tr>	 
	 	 	 <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	 	 
	 	 	 	 <?php if ($this->_tpl_vars['key'] == 'id'): ?>
	 	 	 	 	 <?php $this->assign('id', $this->_tpl_vars['item']); ?>
	 	 	 	 <?php endif; ?>
	 	 	 	 <?php if ($this->_tpl_vars['key'] == 'title'): ?>
	 	 	 	 	 <td><a href="/sooj/controller/contest/contest_detail.php?id=<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</a></td>
	 	 	 	 	 <?php continue; ?>
	 	 	 	 <?php endif; ?>
	 	 	 	 <?php if ($this->_tpl_vars['key'] == 'status'): ?>
	 	 	 	 	 <?php if ($this->_tpl_vars['item'] == "准备中"): ?>
	 	 	 	 		  <td class="pending"><?php echo $this->_tpl_vars['item']; ?>
</td>
	 	 	 	 	 	  <?php continue; ?>
	 	 	 	 	 <?php endif; ?>
	 	 	 	 <?php endif; ?>
	 	 	 	 <td><?php echo $this->_tpl_vars['item']; ?>
</td>
	 	 	 <?php endforeach; endif; unset($_from); ?>
	 	 </tr>
	 	 <?php endforeach; endif; unset($_from); ?>
	</table>

	<!-- ranklist 的前十 -->
	<table class="plugins" id="rank_list_top_10">
	<caption>用户积分 Top 10</caption>
		 <tr>
	 	 	 <th class="top_left_radius">排名</th>
	 	 	 <th>用户昵称</th>
	 	 	 <th class="top_right_radius">access/submit</th>
	 	 </tr>
	 	 <?php $_from = $this->_tpl_vars['plugins_rank_top_10']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		 <tr>	 
	 	 	 <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
	 	 	 
	 	 	 <?php if ($this->_tpl_vars['key'] == 'user_id' || $this->_tpl_vars['key'] == 'sb_count' || $this->_tpl_vars['key'] == 'ac_count'): ?>
	 	 	 	 <?php continue; ?>
	 	 	 <?php endif; ?>
	 	 	 	 <td><?php echo $this->_tpl_vars['item']; ?>
</td>
	 	 	 <?php endforeach; endif; unset($_from); ?>
	 	 </tr>
	 	 <?php endforeach; endif; unset($_from); ?>
	</table>

	<div class="plugins">
	<p>
	 如何使用本系统
	</p>
	</div>

</div>

<div class="span-1 last">
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
