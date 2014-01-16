{?include file='div/div_html_head_info.tpl'?}

<link href="/sooj/view/css/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/sooj/view/js/lib/google-code-prettify/prettify.js"></script>

<body onload="prettyPrint()">

{?include file='div/div_pre_header.tpl'?}

<div class="container">

{?include file='div/div_header.tpl'?}

{?include file='div/div_nav.tpl'?}

<hr />

<div class="span-3">
<br />
</div>

<div id="view_code" class="span-17">
<p>
<span class="code_no">代码编号:{? $code_no ?}</span>
<span class="user">贡献者用户ID:{? $code_user ?}</span>
<span class="lang">语言:{? $lang ?}</span>
<span><a href="#">返回</a></span>
</p>

<pre class="prettyprint">
{? $content ?}
</pre>
</div>

<div class="span-3 last">
<br />
</div>

</div>

{?include file='div/div_footer.tpl'?}

<div id="display_result" class="simple_window" onclick="h();" style="display:none;"></div>
</body>
</html>


