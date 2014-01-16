<?php /* Smarty version 2.6.26, created on 2011-06-17 13:48:18
         compiled from div/div_footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'xdebug_time_index', 'div/div_footer.tpl', 13, false),array('modifier', 'memory_get_usage', 'div/div_footer.tpl', 14, false),)), $this); ?>
<!--页脚元素-->
<div id="footer">
	&copy;
	2009-2011
	Sooj Team
	.
	All Rights Reserved. 
	<a href="/sooj/view/html/join_us.html" class="join_us">欢迎加入我们的团队</a>
	<a href="/sooj/bugs/" class="report_bug">报告Bug</a>
	<span class="ver"> Ver 1.0</span>
	<a href="/sooj/cms/" class="cms">后台管理</a>
	<p class="run_time_info">
	<span>脚本运行时间:<?php echo xdebug_time_index(''); ?>
(second) </span> |
	<span>脚本内存占用:<?php echo memory_get_usage(''); ?>
(byte)</span>
	</p>
</div>