{?include file='div/div_html_head_info.tpl'?}

<body>

{?include file='div/div_pre_header.tpl'?}

<div class="container">

{?include file='div/div_header.tpl'?}

{?include file='div/div_nav.tpl'?}

<hr />

<div class="span-1">
<br />
</div>

<div id="post_new_topic" class="span-18">
	<h2>发起一个新问题|Post new topic</h2>

	<form action="do_post_new_topic.php" method="post" name="post_new_topic" onsubmit="on_submit();">

		<p>
			 <label for="topic_title">标题</label><br />
			 <input type="text" name="title" class="title"/>
		</p>

		<p>
			 <label for="tags">标签</label><br />
			 <input type="text" name="problem_no" class="text"/>
		</p>

		{? include file="module/mod_WYSIWYG.tpl"?}

		<p class="submit">
	 		 <input type="submit" value="发帖" />
	 	</p>
	</form>	
</div>

<div id="post_help" class="span-5 last">
<span>发帖注意事项</span><br /><br />
勿发与计算机技术无关的帖子。
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>

