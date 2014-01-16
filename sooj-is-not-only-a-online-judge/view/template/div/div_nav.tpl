<!--导航元素-->	 
<div id="nav" class="nav">
 	 <ul>

 	 <li>
	 	 <a href="/sooj/controller/"
	 	 	 {? if $active eq "index" ?}class="active"{? /if ?}>首页<span class="english">|Index</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/problem/" 
	 	 	 {? if $active eq "problem" ?}class="active"{? /if ?}>题库<span class="english">|Problems</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/contest/"
	 	 	 {? if $active eq "contest" ?}class="active"{? /if ?}>竞赛<span class="english">|Contest</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/discuss/"
	 	 	 {? if $active eq "discuss" ?}class="active"{? /if ?}>论坛<span class="english">|Discuss</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/judge_result/"
	 	 	 {? if $active eq "judge_result" ?}class="active"{? /if ?}>在线评测状态<span class="english">|Online Status</span></a></li>
 	 <li>
	 	 <a href="/sooj/controller/ranklist/" 
	 	 	 {? if $active eq "ranklist" ?}class="active"{? /if ?}>用户排名<span class="english">|Ranklist</span></a></li>
 	 
	 </ul>
</div>
