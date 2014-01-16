{?include file='div/div_html_head_info.tpl'?}

<body>

{?include file='div/div_pre_header.tpl'?}

<div class="container">


{?include file='div/div_header.tpl'?}

{?include file='div/div_nav.tpl'?}

<hr />

<div class="span-4 last">
<br />
</div>

<div class="span-15 account">

{?include file='module/mod_update_user_profile_nav.tpl'?}

<!--更新用户信息模块-->
<form action="/sooj/controller/account/do_update_user_head_img.php" method="post" enctype="multipart/form-data">
 
	 {?*若更改用户头像时有错误信息*?}
	 {?include file='module/mod_form_message.tpl' form_message=$update_head_img_fail_message?}

	 	 <label for="head_url">当前头像</label><br />

	 	 <hr />
		 <img src="{?$head_img?}" style="margin:10px;"/>
		 <img src="{?$head_img|replace:"big":"small"?}" style="margin:10px;"/>
	 	 <hr />

	 	 <p>
	 	 <span>你可以上传JPG、JPEG、GIF、PNG或BMP文件.</span><br />
	 	 <label for="head_img">文件名:</label>
	 	 <input type="file" name="head_img" id="head_img" />
	 	 </p>

	 	 <p>
	 	 <input type="submit" value="马上更新头像" />
		 </p>

                 <p>
                 {? if !$gravatar_url ?}
	 	 您还可以使用<a href="http://en.gravatar.com/"> gravater </a>来设置头像,一劳永逸.
	 	 {? else ?}
	 	 您的email地址对应的 gravater 头像
	 	 <p><img src="{? $gravatar_url ?}" /></p>
	 	 {? /if ?} 
                 </p>

</form>

</div>

<div class="span-4 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

</body>
</html>
