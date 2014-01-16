<?php /* Smarty version 2.6.26, created on 2011-06-15 09:47:50
         compiled from module/mod_contest_result.tpl */ ?>
<?php if ($this->_tpl_vars['result_list']): ?>

<table>
<?php if (! $this->_tpl_vars['ref']): ?>
<caption>竞赛编号:[<?php echo $this->_tpl_vars['contest_id']; ?>
],用户ID:[<?php echo $this->_tpl_vars['user_id']; ?>
]</caption>
<?php endif; ?>
<tr>
	 <th class="span-5 top_left_radius">试题编号</th>
	 <th class="span-5">状态</th>
	 <th class="span-5 top_right_radius">惩罚值</th>
</tr>

<?php $_from = $this->_tpl_vars['result_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['row']):
?>

<tr>
	 <?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>

	 <?php if ($this->_tpl_vars['value'] == ''): ?>
	 	 <td>-</td>
	 	 <?php continue; ?>
	 <?php endif; ?>
	 <td><?php echo $this->_tpl_vars['value']; ?>
</td>
	 
	 <?php endforeach; endif; unset($_from); ?>
</tr>

<?php endforeach; endif; unset($_from); ?>

</table>
<?php endif; ?>
