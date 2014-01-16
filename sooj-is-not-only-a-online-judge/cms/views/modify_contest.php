<?php
include( 'mod/html_header_info.tpl.php' );
?>

<?php
include( 'mod/header.php' );
?>

<div class="container">
<?php
if( @$this->message_no == 1 ){
	echo '<div class="success">更新成功</div>';
}
if( @$this->message_no == -1 ){
	echo '<div class="error">更新失败</div>';
}
?>


<div id="contest_info" class="span-10">
<form action="/sooj/cms/contest_manager/do_modify_contest" method="post" name="modify_contest">
<h4>竞赛一般信息</h4>
<?php
//显示contest表中相关竞赛的信息
@$contest_info = $this->contest_info;
if( empty( $contest_info ) ){

	echo "还没有可用竞赛";
	include ( 'mod/footer.tpl.php' );
	die;
}else{
@$contest_id = $contest_info['id'];
foreach( $contest_info as $key => $value ){

	switch( $key ){
	
	case 'id':
		echo "<p>
			<label for='no'>竞赛编号</label><br />
			<input type='text' value='$value' disabled='true'/>
			<input type='hidden' value='$value' name='id'/>
			</p>";
		break;
	case 'title':
		echo "<p>
			<label for='no'>竞赛名称</label><br />
			<input type='text' value='$value' name='title' class='title'/>
			</p>";
		break;
	case 'status':
		echo "<p>
			<label for='no'>竞赛状态</label><br />
			<span>$value</span>
			<select name='status'>
			<option>准备中</option>
			<option>进行中</option>
			<option>已结束</option>
			</select>
			</p>";
		break;
	case 'start_time':
		echo "<p>
			<label for='no'>开时间</label><br />
			<input type='text' value='$value' name='start_time'/>
			</p>";
		break;
	case 'end_time':
		echo "<p>
			<label for='no'>结束时间</label><br />
			 <input type='text' value='$value' name='end_time'/>
			</p>";
		break;
	case 'summary':
		echo "<p>
			<label for='no'>摘要介绍</label><br />
			<textarea name='summary'>$value</textarea>
			</p>";
		break;
	
	}
}
?>
<div id="control">
<a class="button" onClick= "document.modify_contest.submit();return(false);">提交修改</a>
</div>
<?php 
}
?>
</form>
</div>



<div id="contest_problems" class="span-5" >
<h4>竞赛试题信息</h4>

<?php
//显示竞赛包含题目
@$contest_problem_infos = $this->contest_problem_infos;
if( empty( $contest_problem_infos ) ){

	 echo "<p><span>还没有添加试题</span></p>";
}else{
foreach( $contest_problem_infos as $index => $problem_info ){
	
	 echo "<p>";

	 foreach( $problem_info as $key => $value ){
		 //替换key名称为中文描述
		 if( $key == 'title' ){
		 
		 	 $key = '题目名称'; 
		 }
		 if( $key == 'problem_no' ){
		 
			 $key = '题号';
			 $problem_no = $value;
		 }
		 if( $key == 'sorter' ){
		 
		 	 $key = '题目在竞赛内标号(英文字母)'; 
		 } 
		 echo "<label for='$key'>$key</label><br />";
		 if( $key == '题目名称' ){
		 
			 echo "<input name='$key' value='$value' disabled='true' type='text'/><br />";
			 continue;
		 }
		 echo "<input name='$key' value='$value' type='text'/><br />";
		
	 }
	 echo "<a href='/sooj/cms/contest_manager/do_del_problem_from_contest/problem_no/$problem_no/contest_id/$contest_id'>删除</a><br />";
	 echo "</p>";
}
}
?>

</table>
<hr />

<form action="/sooj/cms/contest_manager/do_add_new_problem" method="post" name="do_add_new_problem">
<p>
<span>添加一个新题目</span>
<label>题号</label><br />
<input type="text" name="new_problem_no"/><br />
<input name="contest_id" type="hidden" value="<?php echo $contest_id ?>"/>
<a href="/sooj/cms/contest_manager/do_add_new_problem" class="button2" onclick= "document.do_add_new_problem.submit();return(false);">提交</a>
</p>
</form>

</div>

</form>
</div>

<?php
include( 'mod/footer.tpl.php' );
