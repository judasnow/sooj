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

<div id="user_manager" class="span-22">
<?php
if( @$this->message_no == 1 ){
	echo '<div class="success">添加试题成功</div>';
}
if( @$this->message_no == -1 ){
	echo '<div class="error">添加试题失败</div>';
}
?>

<table>

<!--显示全部用户-->
<thead> 
<tr>
	 <th >用户ID</th>
	 <th >用户名</th>
	 <th >最后登录时间</th>
	 <th >最后登录IP</th>
	 <th >管理</th>
</tr>
</thead>

<?php
if( !empty( $this->users ) ){
	 $users = $this->users;
	 foreach( $users as $index => $user ){
		 echo '<tr>';
		 foreach( $user as $key => $value ){
			 
			 if( $key == 'password' ){
			 
			 	 continue;
			 };
			 echo "<td>$value</td>";
		 }
		 echo '<td><a href="/sooj/cms/user_manager/do_del_user/id/' . $user['id'] . '" >删除</a>';
	 	 echo '</tr>';
	 }	
}
?>

</table>
</div>
</div>

<?php
include( 'mod/footer.tpl.php' );


