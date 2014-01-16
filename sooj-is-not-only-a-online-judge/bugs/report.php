<div class="span-6">
<br />
</div>

<div id="report" class="span-12">
<form action="do_report.php" method="post" enctype="multipart/form-data"> 
<fieldset> 
<legend></legend> 

<h3> 提交新的 Bug </h3>
<hr />

<p>  
	 <label for="reporter">提交者</label><br /> 
         <input type="text" class="title" name="reporter" id="reporter" value=""> 
</p> 

<p> 
	 <label for="browser">Bug 发生时您使用的浏览器</label><br /> 
         <input type="text" class="text" id="browser" name="browser" value=""> 
</p>

<p> 
	 <label for="bug_des">Bug 描述(请着重描述您当时您想期待系统有何反应，以及系统的实际反应)</label><br /> 
         <textarea name="bug_des" id="bug_des" rows="5" cols="25"></textarea> 
</p> 

<p> 
	 <label for="screenshot">错误时系统截图</label><br /> 
         <input type="file" id="screenshot" name="screenshot"> 
</p> 

<hr />

<p> 
	 <input type="submit" value="提交"> 
         <input type="reset" value="重置"> 
</p>

</fieldset> 
</form>
</div>

<div class="span-6 last">
<br />
</div>
