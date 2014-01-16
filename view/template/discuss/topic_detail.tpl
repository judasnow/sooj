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

<!-- 帖子详细内容 -->
<div id="topic_detail" class="span-17">
	
	<!-- 帖子标题 -->
	<div class="topic_title">{? $topic_title ?}</div>
	
	<!-- 帖子详细内容 -->
	<div class="topic">

	 	 <!-- 帖子信息统计 -->
		 <div class="topic_info">
			发表于 {? $post_time|date_format:"%Y.%m.%d %H.%M.%S" ?} -
			浏览次数 {? $view_count ?}
		 </div>

		 <!-- 帖子内容 -->
		 <div class="topic_content">

			{?* 主题内容不允许为空,为空时为异常情况,但不能因此破坏用户界面 *?}
			{? if $content == '' ?}
				content is empty ?! what`s wrong ... 
			{? else ?}
	 
				{? $content ?}
	 	 
			{? /if ?}
		
		</div>
	 	 
	 	<div class="bottom">
	 	 	 
	 	 	 <div class="votes span-4">
	 	 	  	 
	 	 	 </div>
			 <!-- 发帖人信息 -->
	 		 <div class="poster_info span-4">
	 	 	 	 <div class="by">By</div>
				 <div class="user_head_img"><img src="/sooj/view/picture/user_head_img/small_{? $poster_id ?}.jpg" /></div>
				 <div class="user_info"><span>{? $poster_nick ?}</span></div>
	 		 </div>
	 	</div>
	</div>

	<!-- replys -->
	<div class="reply_title">{? $reply_count ?} 回复</div>
	
	{? if $reply_count > 0 && $replys ?}
	{?* 回复数为0时,不显示该部分 *?}
	{? foreach key=key item=item from=$replys ?}
		
		<div class="reply">
	
		{? foreach key=key item=item from=$item ?}
			{? if $key == 'content' ?}
				{? assign var=content value=$item ?}
			{? /if ?}
			{? if $key == 'replyer_id' ?}
				{? assign var=replyer_id value=$item ?}
			{? /if ?}
			{? if $key == 'replyer_nick' ?}
				{? assign var=replyer_nick value=$item ?}
			{? /if ?}
			{? if $key == 'reply_time' ?}
				{? assign var=reply_time value=$item ?}
			{? /if ?}
		{? /foreach ?}

			<div class="reply_info">
				 回复于 {? $reply_time|date_format:"%Y.%m.%d %H.%M.%S" ?}
			</div>
	
			<div class="reply_content">
			{?* 回复内容不允许为空,为空时为异常情况,但不能因此破坏用户界面 *?}
			{? if $content == '' ?}
				content is empty ?! what`s wrong ... 
			{? else ?}
				{? $content ?}
			{? /if ?}
	 	 	
	 		<div class="bottom">
	 	 	 	 <div class="votes span-4">
	 	 	 	 </div>
	 	 	 	 <!-- 回复人信息 -->
	 		 	 <div class="poster_info span-4">
	 	 	 	 	 <div class="by">By</div>
				 	 <div class="user_head_img">
	 	 	 	 	 	 <img src="/sooj/view/picture/user_head_img/small_{? $replyer_id ?}.jpg" />
	 	 	 	 	 </div>
				 	 <div class="user_info"><span>{? $replyer_nick ?}</span></div>
	 		 	 </div>
	 		 </div>
			 
	 	</div>	
		</div>

	{? /foreach ?}
	{? /if ?}
	
	<form method="post" action="do_reply.php" name="reply" id="reply_form" onsubmit="on_submit();">
	<input type="hidden" name="topic_no" value="{? $topic_no ?}" />
	<div id="post_you_answer">
		<div class="title">你的回应</div>

		{? include file="module/mod_WYSIWYG.tpl" ?}
 
		<div class="submit"><input type="submit" value="发表回复"/></div> 
	</div>
	</form>

</div>

<div class="span-3 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>
