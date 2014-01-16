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

<div class="span-7">
<br />
</div>

<div id="contest_info" class="span-10">
<form action="/sooj/cms/contest_manager/do_add_new_contest" method="post" name="add_new_contest">

<div id="control">
<a class="button" onClick= "document.add_new_contest.submit();return(false);">提交</a>
</div>

<h4>竞赛一般信息</h4>
<p>
	<label for='no'>竞赛名称</label><br />
	<input type='text' value='' name='title' class='title'/>
</p>
<p>
	<label for='no'>开始时间</label><br />
	<input type='text' value='' name='start_time'/>
</p>
<p>
	 <label for='no'>结束时间</label><br />
	 <input type='text' value='' name='end_time'/>
</p>
<p>
	<label for='no'>摘要介绍</label><br />
	<textarea name='summary'></textarea>
</p>

</form>
</div>

<div class="span-7 last">
<br />
</div>

<?php
include( 'mod/footer.tpl.php' );
