{?include file='div/div_html_head_info.tpl'?}

<body>

{?include file='div/div_pre_header.tpl'?}

<div class="container">

{?include file='div/div_header.tpl'?}

{?include file='div/div_nav.tpl'?}

<hr />

<div class="span-3">
<br />
</div>

<!-- 帖子列表 -->
<div id="topic_list" class="span-17">

{? if $topics|@is_array ?}
{?* 传递的参数格式正确,为一个数组 *?}

<p class="post_new_buttom">
	<a href="post_new_topic.php" >发起新问题</a>
</p>

{? foreach key=key item=item from=$topics ?}

<div class="topic">
	
	{?* 赋值处理 *?}
	{? foreach key=key item=item from=$item ?}
	{?* 取出主题中的信息 *?}

	{? if $key == 'topic_no' ?}
		{? assign var=topic_no value=$item ?}
	{? /if ?}

	{? if $key == 'title' ?}
		{? assign var=title value=$item ?}
	{? /if ?}
	
	{? if $key == 'content' ?}
	{?* 需要对内容进行一个摘要处理 *?}
		{? assign var=summary value=$item|truncate:300:"...":true ?}
	{? /if ?}

	{? if $key == 'poster_id' ?}
		{? assign var=poster_id value=$item ?}
	{? /if ?}

	{? if $key == 'problem_no'?}
		{? assign var=problem_no value=$item ?}
	{? /if ?}

	{? if $key == 'post_time' ?}
	 	 {? assign var=post_time value=$item ?}
	{? /if ?}

	{? if $key == 'view_count' ?}
		 {? assign var=view_count value=$item ?}
	{? /if ?}

	{? if $key == 'reply_count' ?}
		 {? assign var=reply_count value=$item ?}
	{? /if ?}
	{? /foreach ?}

	<p class="sub_topic">
	 
	 	<!-- 帖子主题 -->
		<div class="title span-8">
	 		 <a href="./topic_detail.php?topic_no={? $topic_no ?}">{? $title ?}</a>
		</div>

		<!-- 帖子相关信息 -->
		<div class="topic_info">
	 	 	 <span class="username">纹身特湿{? $username ?}</span>
			 发表于 {? $post_time ?} - 
			 浏览次数 {? $view_count ?} ,
			 回复次数 {? $reply_count ?} .
	 	 	 <!-- 相关题目 -->
	 	 	 <a href="?problem_no={? $problem_no ?}" class="button">{? $problem_no ?}</a>
		</div>
	 </p>

</div>

{? /foreach ?}

<div id="pager">{? $links ?}</div>

{? else ?}
{?* 传递函数格式不正确 *?}
	
	No topic yet....

{? /if ?}

</div>

<div class="span-3 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>
