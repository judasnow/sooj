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

<table>

<!--显示所有竞赛-->
<caption>
竞赛
<b>
<?php echo $this->contest_id?>
</b>
结果 
</caption>
<thead> 
<tr>
	 <th >用户编号</th>
	 <th >试题编号</th>
	 <th >状态</th>
	 <th >惩罚值</th>
	 <th >代码</th>
</tr>
</thead>

<?php
if( !empty( $this->contest_result_list ) ){
	 $rows = $this->contest_result_list;
	 foreach( $rows as $index => $row ){
		 echo '<tr>';
		 foreach( $row as $key => $value ){
			 if( $key == 'contest_id' ){
			 
			 	 continue;
			 }
			 echo "<td>$value</td>";
		 }
		 echo '</tr>';
	 }	
}
?>

</table>
</div>

<?php
include ( 'mod/footer.tpl.php' );


