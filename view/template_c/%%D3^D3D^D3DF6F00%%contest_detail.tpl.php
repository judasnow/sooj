<?php /* Smarty version 2.6.26, created on 2011-06-18 03:18:54
         compiled from contest/contest_detail.tpl */ ?>
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

<div id="contest_detail" class="span-17">
<!--详细信息-->
<h2><?php echo $this->_tpl_vars['contest_title']; ?>
</h2>
<hr />

<!-- 简要介绍 -->
<div id="summary">
<span><a href="#" onclick="Effect.toggle( 'summary_content' , 'BLIND' ); return false;">详细介绍</a></span>

<div id="summary_content">
<pre>
<?php echo $this->_tpl_vars['summary']; ?>

</pre>
</div>
</div>

<p>
<span>开始时间 :</span><span class="start_time"><?php echo $this->_tpl_vars['start_time']; ?>
</span><br />
<span>结束时间 :</span><span class="end_time"><?php echo $this->_tpl_vars['end_time']; ?>
</span><br />
<span>当前系统时间 :</span><span><?php echo date("Y-m-d H:i:s",time()+8*60*60); ?></span><br/>

<span class="status">
	 <?php if ($this->_tpl_vars['status'] == 'ended'): ?>
	 	 已经结束，试题已经开放提交.
	 	 <span class="oper">
	 	 	 <a href="#">查看结果</a>
	 	 </p>
	 <?php endif; ?>
	 <?php if ($this->_tpl_vars['status'] == 'pending'): ?>
	 	 正在准备中.
	 	 <span class="oper">
	 	 	 <?php if ($this->_tpl_vars['is_user_reg']): ?>
	 	 	 <b>你已经参加了这个比赛,
	 	 	 报名号为(作为比赛认证凭证):<span class="auth_code"><?php echo $this->_tpl_vars['auth_code']; ?>
</span>
	 	 	 </b>
			 <a href="/sooj/controller/contest/do_undo_reg_contest.php">退出这次比赛</a>
	 	 	 <?php else: ?>
	 	 	 	 <a href="/sooj/controller/contest/do_reg_contest.php">参加这次比赛</a>
	 	 	 <?php endif; ?>
	 	 </span>
	 <?php endif; ?>
	 <?php if ($this->_tpl_vars['status'] == 'in_process'): ?>
	 
	 正在进行.

	 <?php if ($this->_tpl_vars['problem_list']): ?>

	 <!--竞赛题目列表-->
	 <table>
	 <caption>竞赛题目列表</caption>
	 	 <tr>
	 	 	 <th class="span-2"></th>
			 <th class="span-2">题号</th>
			 <th class="span-6">标题</th>
		 </tr>

		 <?php $_from = $this->_tpl_vars['problem_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>

		 <tr>	 
			 <?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
			 <?php if ($this->_tpl_vars['key'] == 'sorter'): ?>
				 <td>Problme :<?php echo $this->_tpl_vars['value']; ?>
</td>
				 <?php continue; ?>
			 <?php endif; ?>

			 <?php if ($this->_tpl_vars['key'] == 'problem_no'): ?>
				 <?php $this->assign('problem_no', $this->_tpl_vars['value']); ?>
			 <?php endif; ?>
			 
			 <?php if ($this->_tpl_vars['key'] == 'title'): ?>
				 <td><a href="/sooj/controller/problem/problem_detail.php?no=<?php echo $this->_tpl_vars['problem_no']; ?>
"><?php echo $this->_tpl_vars['value']; ?>
</a></td>
				 <?php continue; ?>
			 <?php endif; ?>

			 <td><?php echo $this->_tpl_vars['value']; ?>
</td>
			 
			 <?php endforeach; endif; unset($_from); ?>
		 </tr>

		 <?php endforeach; endif; unset($_from); ?>
		 
	 </table>
	 
	 <?php endif; ?>

<?php endif; ?>
</span>
</p>

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