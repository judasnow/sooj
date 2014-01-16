<!-- 页首以及导航模块 -->
<div id="header">

<span class="title">Sooj 后台管理</span>
<?php 
if( isset( $_SESSION['admin'] ) && !empty( $_SESSION['admin'] ) ){

	//如果管理员已经登录显示管理员信息
	echo '<span class="staff_name">'.$_SESSION['admin'].'</span>';
	echo '<span class="func"><a href="/sooj/cms/auth/dologout">退出登录</a></span>';
}
?>

<div id="nav">
<span><a href="/sooj/cms/problem_manager/" <?php if ( @$this->controller == 'problem_manager' ) echo "class='active'"; ?>> 题库管理</a></span>
<span><a href="/sooj/cms/contest_manager/" <?php if ( @$this->controller == 'contest_manager' ) echo "class='active'"; ?>>竞赛管理</a></span>
<span><a href="/sooj/cms/user_manager/" <?php if ( @$this->controller == 'user_manager' ) echo "class='active'"; ?>>用户管理</a></span>
<span><a href="/sooj/cms/discuss_manager/" <?php if ( @$this->controller == 'discuss_manager' ) echo "class='active'"; ?>>论坛管理</a></span>
<span><a href="/sooj/controller/" class="back_index">返回Sooj首页</a></span>
</div>

</div>
