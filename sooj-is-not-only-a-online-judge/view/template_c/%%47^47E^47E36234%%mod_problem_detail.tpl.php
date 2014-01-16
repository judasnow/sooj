<?php /* Smarty version 2.6.26, created on 2011-05-28 01:11:11
         compiled from module/mod_problem_detail.tpl */ ?>
<!--题目详细信息-->
<div id="problem_detail">
	<p>
	<h3 class="problem_title">
	 	 <span><?php echo $this->_tpl_vars['no']; ?>
-<?php echo $this->_tpl_vars['problem_title']; ?>
</span>
	</h3>
	</p>
	
	<!--摘要信息-->
	<table>
		 <caption>题目信息摘要 | Problem summary</caption>
	<tr>
		 <th>时间限制(毫秒)</th>
		 <th>内存使用限制(KB)</th>
		 <th>提交次数</th>
		 <th>Ac次数</th>
		 <th>最给力用户</th>
		 <th>题目来源</th>
	</tr>
	<tr>
		 <td><?php echo $this->_tpl_vars['time_limit']; ?>
</td>
		 <td><?php echo $this->_tpl_vars['memory_limit']; ?>
</td>
	 	 <td>	
	 	 <?php if ($this->_tpl_vars['sb_count'] == ''): ?>
	 	 	 - 
	 	 <?php else: ?>
	 	 	 <?php echo $this->_tpl_vars['sb_count']; ?>
 
	 	 <?php endif; ?> 
	 	 </td>
		 <td>
	 	 <?php if ($this->_tpl_vars['ac_count'] == ''): ?>
	 	 	 - 
	 	 <?php else: ?>
	 	 	 <?php echo $this->_tpl_vars['ac_count']; ?>
 
	 	 <?php endif; ?> 
	 	 </td>			
		 <td>
	 	 <?php if ($this->_tpl_vars['best_user'] == -1): ?>
	 	 	 - 
	 	 <?php else: ?>
	 	 	 <?php echo $this->_tpl_vars['best_user']; ?>
 
	 	 <?php endif; ?> 
	 	 </td>
		 <td><?php echo $this->_tpl_vars['source']; ?>
</td>
	</tr>
	</table>
	<fieldset>
	<legend>题目内容</legend>
	<p>
		 <?php echo $this->_tpl_vars['content']; ?>

	</p>
	</fieldset>

	<hr />

	<fieldset>
	<legend>输入要求</legend>
	<p>
		 <?php echo $this->_tpl_vars['input']; ?>

	</p>
	</fieldset>

	<hr />			

	<fieldset>
	<legend>输出要求</legend>
	<p>
		 <?php echo $this->_tpl_vars['output']; ?>

	</p>
	</fieldset>
	
	<hr />

	<fieldset>
	<legend>样例输入(按行)</legend>
	<p>
	<pre><?php echo $this->_tpl_vars['sample_input']; ?>
</pre>
	</p>
	</fieldset>

	<hr />

	<fieldset>
	<legend>对应样例输出(按行)</legend>
	<p>
	<pre><?php echo $this->_tpl_vars['sample_output']; ?>
</pre>
	</p>
	</fieldset>

	<hr />

	<?php if ($this->_tpl_vars['tip']): ?>
	<fieldset>
	<legend>提示</legend>
	<p>	 
	<pre>
		 <?php echo $this->_tpl_vars['tip']; ?>

	</pre>
	</p>
	</fieldset>
	<?php endif; ?>
	
		<?php if (! $this->_tpl_vars['ref']): ?>
	<div class="submit">
		 <a class="button" href="/sooj/controller/code/code_submit.php?problem_no=<?php echo $this->_tpl_vars['no']; ?>
">提交代码</a>
	</div>
	<?php endif; ?>

</div>