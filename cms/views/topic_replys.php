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

<div id="discuss_manager" class="span-22">

<?php
if( @$this->message_no == 1 ){
	echo '<div class="success">添加竞赛成功</div>';
}
if( @$this->message_no == -1 ){
	echo '<div class="error">添加新竞赛失败</div>';
}
?>

<table>

<!-- 显示所有论坛帖子 -->
<caption>帖子回复列表</caption>
<thead> 
<tr>
	 <th class="span-10">内容</th>
	 <th class="span-2">回复人</th>
	 <th class="span-3">回复时间</th>
	 <th >有用</th>
	 <th >没用</th>
	 <th >状态</th>
	 <th >操作</th>
</tr>
</thead>

<?php
if( is_array( $this->topic_replys ) ){

	$topic_replys = $this->topic_replys;

	foreach( $topic_replys as $index => $reply_info ){

		 echo '<tr>';
		 foreach( $reply_info as $key => $value ){

			 if( $key == 'reply_no' || $key == 'topic_no' || $key == 'replyer_id' ){
			 
			 	 continue;
			 }
			 echo "<td>$value</td>";
		 }
		 echo '<td><a href="/sooj/cms/discuss_manager/do_del_reply/topic_no/'.$reply_info['topic_no'].'/reply_no/' . $reply_info['reply_no'] . '" >删除</a>';
	 	 echo '</tr>';
	 }	
}else{

echo $this->topic_replys;
}
?>

</table>
</div>

<?php
include ( 'mod/footer.tpl.php' );


