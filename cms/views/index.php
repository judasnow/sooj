<?php
include( 'mod/html_header_info.tpl.php' );
?>

<style>
/*body{ background-image:url('/sooj/cms/views/picture/cms_index_bg3.png'); }*/
</style>

<?php
include( 'mod/header.php' );
?>

<div class="container">

<div id="left" class="span-8">
<br />
</div>

<div id="manager_login" class="span-8">
<fieldset id="cms_login">
<form action="/sooj/cms/auth/dologin" method="post">
	 <h3> Sooj 后台管理系统入口 </h3>

<?php 
if( @$this->login_false ){
	 //echo '<div class="error">管理员用户名或密码错误</div>';
}
?>
	 <br />
	 <p>
	 	 <label for="admin">管理员</label><br>
	 	 <input type="text" class="text" id="admin" name="admin" value="">
	 </p>

	 <p> 
	 	 <label for="password">密码</label><br> 
	 	 <input type="password" class="text" id="password" name="password" value=""> 
	 </p> 
	 
	 <input type="submit" value="登录"  class="row" /> 
	 <input type="reset" value="重置"  class="row" /> 
	 
</form>
</fieldset>
<?php 
if( @$this->login_false ){
	 echo "<script> new Effect.Shake( $('cms_login') , {distance:30 , duration:0.4}); </script>";
}
?>
</div>

<div id="right" class="span-8">
<br />
</div>

</div>

<?php
include( 'mod/footer.tpl.php' );


