<?php /* Smarty version 2.6.26, created on 2011-06-06 10:30:54
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

<!--竞赛详细信息，题目列表-->
<style>
#contest_detail{}
#contest_detail h2{ 
	 text-align:center;
	 color:#444;
}
#contest_detail table{}
#contest_detail caption{ 
	 background:#fff;
	 color:#999;
}
#contest_detail th{
	 font-weight:100;
	 color:#333;
}
#contest_detail td{
	 text-align:center;
}
.center{
	 text-align:center;
}
.start_time{
	 color:#32a81e;
	 font-weight:bold;
}
.end_time{
	 color:#f99;
	 font-weight:bold;
}
#contest_detail span{
	 margin:2px;
	 font-size:110%;
}
#contest_detail p{
	 background:#e0f2f8;
	 padding:15px;
	 color:#333;
	 border-radius:3px;
}
#contest_detail .status{
	 background:#c2e6f2;
	 color:#333;
	 padding:8px;
	 margin-top:10px;
	 border-radius:5px;
	 display:block;
	 border:1px solid #666;
}

#summary{}
#summary_content pre{
padding:5px;
background:#eee;
color:#444;
border-radius:5px;
}
#summary a{
	 color:#069;
	 padding:2px;
	 border-radius:5px;
	 text-decoration:none;
}
</style>
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

<span class="status">已经结束，试题已经开放提交</span>
</p>

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