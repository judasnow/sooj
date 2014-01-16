<?php /* Smarty version 2.6.26, created on 2011-06-18 02:51:55
         compiled from judge_result/judge_result_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'judge_result/judge_result_list.tpl', 55, false),)), $this); ?>
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

<?php if ($this->_tpl_vars['judge_result_list']): ?>
<!--评测结果-->
<div id="judge_result" class="span-17">
<table>
<caption>用户代码评测结果</caption>
<thead>
	 <th class="top_left_radius">Test ID</th>
	 <th>用户</th>
	 <th>题号</th>
	 <th>结果</th>
	 <th class="span-3">内存消耗峰值</th>
	 <th>时间消耗</th>
	 <th>使用编程语言</th>
	 <th>代码文本长度</th>
	 <th class="span-2"></th>
	 <th class="top_right_radius">提交时间</th>
</thead>
<tbody id="result_list_tbody"> 

<?php $_from = $this->_tpl_vars['judge_result_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>

<tr>	
	 <?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>	 
	 <td>
	 	 <?php if ($this->_tpl_vars['key'] == 'user_id'): ?>
	 	 	 <?php $this->assign('user_id', $this->_tpl_vars['value']); ?>
	 	 	 <?php continue; ?> 
	 	 <?php endif; ?>

	 	 <?php if ($this->_tpl_vars['key'] == 'nick'): ?>
	 	 	 <a href="#"><?php echo $this->_tpl_vars['value']; ?>
</a>
	  	 	 <?php continue; ?> 
	 	 <?php endif; ?>

	 	 <?php if ($this->_tpl_vars['key'] == 'result'): ?>
			 <span class="<?php echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
"><?php echo $this->_tpl_vars['value']; ?>
</span>
			 <?php continue; ?> 
	 	 <?php endif; ?>

	 	 <?php if ($this->_tpl_vars['key'] == 'code_no'): ?>
	 	 	 <a href="/sooj/controller/code/view_code.php?code_no=<?php echo $this->_tpl_vars['value']; ?>
">看代码</a>
	  	 	 <?php continue; ?> 
	 	 <?php endif; ?>

	 	 <?php if ($this->_tpl_vars['value'] == ''): ?>
			 -
	 	 <?php else: ?>
	 	 	 <?php echo $this->_tpl_vars['value']; ?>

	 	 <?php endif; ?>
	 
	 </td>
	 <?php endforeach; endif; unset($_from); ?>
</tr>

<?php endforeach; endif; unset($_from); ?>

</tbody> 
</table>

<div id="pager"><?php echo $this->_tpl_vars['links']; ?>
</div>

<?php endif; ?>

<script>

function refresh(){

	 max_no = 0;
	 var url = '/sooj/controller/judge_result/refresh.php?max_no='+max_no
	 new Ajax.PeriodicalUpdater( 'result_list_tbody' , url, { 
	 
	 	 frequency:2, 
	 	 method: 'get',
	 	 insertion:'top',
	 	 decay:2,

	 	 onSuccess: function(transport){
	 	 	 //取最近5个结果，如果返回没有在此结果之内，便
	 	 	 //认为是有效的
	 	 	 transport = '';
	 	 	 alert( 'set null ok' );

	 	 },
	 	 onCreate: function(){
	 	 	 
	 	 },
		 onComplete: function(){
		 	  max_no = res.childElements()[0].childElements()[0].innerHTML;
	 	 	  var url = '/sooj/controller/judge_result/refresh.php?max_no='+max_no;
		 }
	 });
}

//refresh();
res = $('result_list_tbody')
max_no = res.childElements()[0].childElements()[0].innerHTML;
</script>

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
