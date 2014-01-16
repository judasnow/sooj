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

<table>

<!-- 显示所有论坛帖子 -->
<caption>帖子列表</caption>
<thead> 
<tr>
	 <th >No.</th>
	 <th >标签</th>
	 <th class="span-3">标题</th>
	 <th class="span-2">发帖人</th>
	 <th class="span-2">浏览次数</th>
 	 <th class="span-2">回复次数</th>
	 <th >发帖时间</th>
	 <th >热度</th>
	 <th >状态</th>
	 <th class="span-3">操作</th>
</tr>
</thead>

<?php
if( !empty( $this->topic_lists ) ){

	 $topic_lists = $this->topic_lists;
	 foreach( $topic_lists as $index => $topic_info ){

		 echo '<tr>';
		 foreach( $topic_info as $key => $value ){

			 if( $key == 'content' || $key == 'poster_id' ){
			 
			 	 continue;
			 }
			 echo "<td>$value</td>";
		 }
		 echo '<td><a href="/sooj/cms/discuss_manager/do_del_topic/no/' . $topic_info['topic_no'] . '" >删除</a>';
		 echo '<a href="/sooj/cms/discuss_manager/topic_replys/topic_no/' . $topic_info['topic_no'] . '" >回复管理</a></td>';
	 	 echo '</tr>';
	 }	
}
?>

</table>
</div>

<?php
include ( 'mod/footer.tpl.php' );


