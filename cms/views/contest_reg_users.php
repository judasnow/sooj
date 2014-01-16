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

<p>
<a href="/sooj/cms/contest_manager/generate_excel/id/<?php echo $this->contest_id; ?>" >生成报名表为Excel文件</a>
</p>
<table>

<!--显示所有竞赛-->
<caption>
竞赛
<b>
<?php echo $this->contest_id?>
</b>
所有报名的用户表 
</caption>
<thead> 
<tr>
	 <th >用户编号</th>
	 <th >用户auth_code</th>
	 <th >登记时间</th>
	 <th>管理</th>
</tr>
</thead>

<?php
if( !empty( $this->reg_users ) ){
	 $rows = $this->reg_users;
	 foreach( $rows as $index => $user ){
		 echo '<tr>';
		 foreach( $user as $key => $value ){
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


