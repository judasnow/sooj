<?php /* Smarty version 2.6.26, created on 2011-05-20 02:20:56
         compiled from div/div_nav.tpl */ ?>
<!--导航元素-->	 
<div id="nav" class="nav">
 	 <ul>

 	 <li>
	 	 <a href="/sooj/controller/"
	 	 	 <?php if ($this->_tpl_vars['active'] == 'index'): ?>class="active"<?php endif; ?>>首页<span class="english">|Index</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/problem/" 
	 	 	 <?php if ($this->_tpl_vars['active'] == 'problem'): ?>class="active"<?php endif; ?>>题库<span class="english">|Problems</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/contest/"
	 	 	 <?php if ($this->_tpl_vars['active'] == 'contest'): ?>class="active"<?php endif; ?>>竞赛<span class="english">|Contest</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/discuss/"
	 	 	 <?php if ($this->_tpl_vars['active'] == 'discuss'): ?>class="active"<?php endif; ?>>论坛<span class="english">|Discuss</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/judge_result/"
	 	 	 <?php if ($this->_tpl_vars['active'] == 'judge_result'): ?>class="active"<?php endif; ?>>在线评测状态<span class="english">|Online Status</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/ranklist/" 
	 	 	 <?php if ($this->_tpl_vars['active'] == 'ranklist'): ?>class="active"<?php endif; ?>>用户排名<span class="english">|Ranklist</span></a></li>
 	 
	 </ul>
</div>