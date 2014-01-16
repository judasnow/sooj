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

<div id="contest_manager" class="span-22">
<?php
if( @$this->message_no == 1 ){
	echo '<div class="success">添加竞赛成功</div>';
}
if( @$this->message_no == -1 ){
	echo '<div class="error">添加新竞赛失败</div>';
}
?>
<p>
<a href="/sooj/cms/contest_manager/add_new_contest/" >添加新竞赛</a>
</p>
<table>

<!--显示所有竞赛-->
<caption>所有竞赛列表</caption>
<thead> 
<tr>
	 <th >竞赛编号</th>
	 <th >竞赛名称</th>
	 <th >当前状态</th>
	 <th >开始时间</th>
	 <th >结束时间</th>
	 <th>管理</th>
</tr>
</thead>

<?php
if( !empty( $this->contest_lists ) ){
	 $rows = $this->contest_lists;
	 foreach( $rows as $index => $contest_list ){
		 echo '<tr>';
		 foreach( $contest_list as $key => $value ){
			 if( $key == 'summary' ){
			 
			 	 continue;
			 }
			 echo "<td>$value</td>";
		 }
		 echo '<td><a href="/sooj/cms/contest_manager/do_del_contest/id/' . $contest_list['id'] . '" >删除</a>';
		 echo '<a href="/sooj/cms/contest_manager/modify_contest/id/' . $contest_list['id'] . '" >修改</a></td>';
	 	 echo '</tr>';
	 }	
}
?>

</table>
</div>

<?php
include ( 'mod/footer.tpl.php' );

