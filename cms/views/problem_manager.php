<?php
include( 'mod/html_header_info.tpl.php' );
?>

<?php
include( 'mod/header.php' );
?>

<div class="container">

<div id="left" class="span-1">
<br />
</div>

<div id="right" class="span-1">
<br />
</div>

<div id="problem_manager" class="span-22">
<?php
if( @$this->message_no == 1 ){
	echo '<div class="success">添加试题成功</div>';
}
if( @$this->message_no == -1 ){
	echo '<div class="error">添加试题失败</div>';
}
?>
<p>
<span><a href="/sooj/cms/problem_manager/add_new_problem">添加新题目</a></span>
</p>
<table>

<!--显示题目总数-->
<caption>题目总数</caption>
<thead> 
<tr>
	 <th >题号</th>
	 <th >标题</th>
	 <th >最给力</th>
	 <th >提交次数</th>
	 <th >AC次数</th>
	 <th >状态</th>
	 <th >正确率(%)</th>
	 <th >管理</th>
</tr>
</thead>

<?php
if( !empty( $this->problem_list ) ){
	 $rows = $this->problem_list;
	 foreach( $rows as $index => $problem_info ){
		 echo '<tr>';
		 foreach( $problem_info as $key => $value ){
	 	 	 
			 echo "<td>$value</td>";
		 }
		 echo '<td><a href="/sooj/cms/problem_manager/do_del_problem/no/' . $problem_info['no'] . '" >删除</a>';
		 echo '<a href="/sooj/cms/problem_manager/modify_problem/no/' . $problem_info['no'] . '" >修改</a></td>';
	 	 echo '</tr>';
	 }	
}
?>

</table>
</div>
</div>

<?php
include( 'mod/footer.tpl.php' );

