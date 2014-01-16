<?php
include( 'mod/html_header_info.tpl.php' );
?>

<?php
include( 'mod/header.php' );
?>

<div class="container">

<form action="/sooj/cms/problem_manager/do_add_new_problem" method="post" name="modify_problem">
<div id="control">
<a class="button" onClick= "document.modify_problem.submit();return(false);">提交</a>
</div>
<div id="problem_info" class="span-10">
<h4>题目一般信息</h4>
<p>
	<label for='no'>题目编号</label><br />
	<input type='text' name="no"/>
</p>
<p>
	<label for='no'>题目标题</label><br />
	<input type='text' name='title' class='title'/>
</p>
<p>
	<label for='no'>题目内容</label><br />
	<textarea name='content'></textarea>
</p>
<p>
	<label for='no'>题目输入描述</label><br />
	<textarea name='input'></textarea>
</p>
<p>
	<label for='no'>题目输出描述</label><br />
	<textarea name='output'></textarea>
</p>
<p>
	<label for='no'>样例题目输入</label><br />
	<textarea name='sample_input'></textarea>
</p>
<p>
	<label for='no'>样例题目输出</label><br />
	<textarea name='sample_output'></textarea>
</p>
<p>
	<label for='no'>解题提示</label><br />
	<textarea name='tip'></textarea>
</p>
<p>
	<label for='no'>题目来源信息</label>
	<input name='source' type='text'  />
</p>
<p>
	<label for='time_limit'>题目时间限制</label>
	<input name='time_limit' type='text' />
</p>
<p>
	<label for='memory_limit'>题目内存限制</label>
	<input name='memory_limit' type='text' />
</p>

</div>

<div id="problem_test_case_info" class="span-8">
<h4>测试用例信息</h4>
<span>最少一例,最多三例</span><br />

<p>
<label for='test_case_input0'>input : 0</label><br />
<textarea name='test_case_input0' ></textarea><br />

<label for='test_case_output0'>output: 0</label><br />
<textarea name='test_case_output0' ></textarea><br />
</p>

<p>
<label for='test_case_input1'>input : 1</label><br />
<textarea name='test_case_input1' ></textarea><br />

<label for='test_case_output1'>output: 1</label><br />
<textarea name='test_case_output1' ></textarea><br />
</p>

<p>
<label for='test_case_input2'>input : 2</label><br />
<textarea name='test_case_input2' ></textarea><br />

<label for='test_case_output2'>output: 2</label><br />
<textarea name='test_case_output2' ></textarea><br />
</p>

</div>

</form>
</div>

<?php
include( 'mod/footer.tpl.php' );
