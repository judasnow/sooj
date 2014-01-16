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
<form action="/sooj/cms/problem_manager/do_modify_problem" method="post" name="modify_problem">
<div id="control">
<a class="button" onClick= "document.modify_problem.submit();return(false);">提交修改</a>
</div>
<div id="problem_info" class="span-10">
<h4>题目一般信息</h4>
<?php
//显示problem表中相关题目的信息
$problem_info = $this->problem_info;
foreach( $problem_info as $key => $value ){

	switch( $key ){
	
	case 'no':
		echo "<p>
			<label for='no'>题目编号</label><br />
			<input type='text' value='$value' disabled='true'/>
			<input type='hidden' value='$value' name='no'/>
			</p>";
		break;
	case 'status':
		echo "<p>
			<label for='status'>状态</label><br />
			<span>$value</span>
			<select name='status'>
				 <option value='open'>open</option>
				 <option value='close'>close</option>
			</select>
			</p>";
		break;
	case 'title':
		echo "<p>
			<label for='no'>题目标题</label><br />
			<input type='text' value='$value' name='title' class='title'/>
			</p>";
		break;
	case 'content':
		echo "<p>
			<label for='no'>题目内容</label><br />
			<textarea name='content'>$value</textarea>
			</p>";
		break;
	case 'input':
		echo "<p>
			<label for='no'>题目输入描述</label><br />
			<textarea name='input'>$value</textarea>
			</p>";
		break;
	case 'output':
		echo "<p>
			<label for='no'>题目输出描述</label><br />
			<textarea name='output'>$value</textarea>
			</p>";
		break;
	case 'sample_input':
		echo "<p>
			<label for='no'>样例题目输入</label><br />
			<textarea name='sample_input'>$value</textarea>
			</p>";
		break;
	case 'sample_output':
		echo "<p>
			<label for='no'>样例题目输出</label><br />
			<textarea name='sample_output'>$value</textarea>
			</p>";
		break;
	case 'tip':
		echo "<p>
			<label for='no'>解题提示</label><br />
			<textarea name='tip'>$value</textarea>
			</p>";
		break;
	case 'source':
		echo "<p>
			<label for='no'>题目来源信息</label>
			<input name='source' type='text' value='$value' />
			</p>";
		break;
	case 'time_limit':
		echo "<p>
			<label for='time_limit'>题目时间限制</label>
			<input name='time_limit' type='text' value='$value' />
			</p>";
		break;
	case 'memory_limit':
		echo "<p>
			<label for='memory_limit'>题目内存限制</label>
			<input name='memory_limit' type='text' value='$value' />
			</p>";
		break;
	case 'best_user':
		echo "<p>
			<label for='best_user'>最佳解提供者</label>
			<input name='best_user' type='text' value='$value' disabled='true'/>
			<input name='best_user' type='hidden' value='$value'/>
			</p>";
		break;
	
	}
}
?>
</div>

<div id="problem_test_case_info" class="span-8">
<h4>测试用例信息</h4>
<span>最少一例,最多三例</span><br />
<?php
//显示problem表中相关题目的信息
$problem_test_case_infos = $this->problem_test_case_infos;
$index = 0;
foreach( $problem_test_case_infos as $index => $problem_test_case_info ){
	echo "<p>";
	foreach( $problem_test_case_info as $key => $value ){
	 	 
		if( $key == 'case_no' ){
		
			 $case_no = $value;
			 continue;
		}

		if( $key == 'problem_no' ){
		
			 continue;
		}

		echo "<label for='test_case_$key$case_no'>$key : $case_no</label><br />";
		echo "<textarea name='test_case_$key$case_no' cols='2'>$value</textarea><br />";
	}
	$index++;
	echo "</p>";
}

//保证显示仅有的三个测试用例
while( $index < 3 ){
 	 
	 echo "<p>";
	 echo "<label for='test_case_input$index'>input : $index</label><br />";
	 echo "<textarea name='test_case_input$index'></textarea><br />";
	 echo "</p>";
	 echo "<p>";
	 echo "<label for='test_case_output$index'>output: $index</label><br />";
	 echo "<textarea name='test_case_output$index'></textarea><br />";
	 echo "</p>";
	 $index++;
}
?>
</div>

<div id="problem_detail_info" class="span-5 last">
<h4>题目统计信息</h4>
<?php
//显示 problem_detail 表中相关题目的统计信息
$problem_detail_info = $this->problem_detail_info;
$result_info_map = array(
'sb_count'=>'被提交次数',	
'ac_count'=>'提交正确次数',
'wa_count'=>'结果错误次数',
'tle_count'=>'超时次数',
'mel_count'=>'内存超出限制次数',
're_count'=>'运行时错误次数',
'ole_count'=>'输出格式等错误次数',
'ce_count'=>'编译错误次数',
'se_count'=>'系统错误次数',
've_count'=>'评测系统错误次数',
'pe_count'=>'输出格式错误次数'
);
foreach( $problem_detail_info as $key => $value ){
	 	
	if( $key == 'problem_no' ){
		
		continue;
	}

	echo "<label for='$key'>$result_info_map[$key]</label><br />";
	echo "<input name='$key' type='text' value='$value' /><br />";
	}
?>
</form>
</div>

<?php
include( 'mod/footer.tpl.php' );
