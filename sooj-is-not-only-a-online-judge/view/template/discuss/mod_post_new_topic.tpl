<div id="post_new_topic">
	<h2>Post a new topic</h2>

	<form action="do_post_new_topic.php" method="post" name="post_new_topic" onsubmit="on_submit();">

		<div class="row">
		<label for="topic_title">Title</label>
		<input type="text" name="title" class="title"/>
		</div>

		<div class="row">
		<!--前期只实现了problem_no后期目标是tags-->
		<label for="tags">Tags</label>
		<input type="text" name="problem_no" value="problem no" class="tags"/>
		</div>

		{? include file="mod_WYSIWYG.tpl"?}

		<div class="submit"><input type="submit" value="Post It." /></div>
	</form>	
</div>

<div id="post_help">
How to Ask<br />
Is your question about programming?
We prefer questions that can be answered, not just discussed.
Provide details. Write clearly and simply.
</div>
