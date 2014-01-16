<!--题目详细信息-->
<div id="problem_detail">
	<p>
	<h3 class="problem_title">
	 	 <span>No.{?$no?}-[ {?$problem_title?} ]</span>
	</h3>
	</p>
	
	<!--摘要信息-->
	<table>
		 <caption>题目信息摘要 | Problem summary</caption>
	<tr>
		 <th>时间限制(毫秒)</th>
		 <th>内存使用限制(KB)</th>
		 <th>提交次数</th>
		 <th>Ac次数</th>
		 <th>最给力用户</th>
		 <th>题目来源</th>
	</tr>
	<tr>
		 <td>{? $time_limit ?}</td>
		 <td>{? $memory_limit ?}</td>
	 	 <td>	
	 	 {? if $sb_count == ''  ?}
	 	 	 - 
	 	 {? else ?}
	 	 	 {? $sb_count ?} 
	 	 {? /if ?} 
	 	 </td>
		 <td>
	 	 {? if $ac_count == ''  ?}
	 	 	 - 
	 	 {? else ?}
	 	 	 {? $ac_count ?} 
	 	 {? /if ?} 
	 	 </td>			
		 <td>
	 	 {? if $best_user == -1  ?}
	 	 	 - 
	 	 {? else ?}
	 	 	 {? $best_user ?} 
	 	 {? /if ?} 
	 	 </td>
		 <td>{? $source ?}</td>
	</tr>
	</table>
	<fieldset>
	<legend>题目内容</legend>
	<p>
		 {?$content?}
	</p>
	</fieldset>

	<hr />

	<fieldset>
	<legend>输入要求</legend>
	<p>
		 {?$input?}
	</p>
	</fieldset>

	<hr />			

	<fieldset>
	<legend>输出要求</legend>
	<p>
		 {?$output?}
	</p>
	</fieldset>
	
	<hr />

	<fieldset>
	<legend>样例输入(按行)</legend>
	<p>
	<pre>{?$sample_input?}</pre>
	</p>
	</fieldset>

	<hr />

	<fieldset>
	<legend>对应样例输出(按行)</legend>
	<p>
	<pre>{?$sample_output?}</pre>
	</p>
	</fieldset>

	<hr />

	{?if $tip?}
	<fieldset>
	<legend>提示</legend>
	<p>	 
	<pre>{?$tip?}</pre>
	</p>
	</fieldset>
	{?/if?}
	
	{?* 如果$ref变量被设置，则表明本页面在code_submit页面被引用,因此以下内容不显示 *?}
	{?if !$ref?}
	<div class="submit">
		 <a class="button" href="/sooj/controller/code/code_submit.php?problem_no={?$no?}">提交代码</a>
	</div>
	{?/if?}

</div>
