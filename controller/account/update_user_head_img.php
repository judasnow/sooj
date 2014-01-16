<?php
/**
 * 用以显示更该用户详细信息的页面
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );

session::start();
$db = new db();

$tpl = new custom_smarty();

//判断用户是否已经登录,已登录用户不可访问本页面
$user_info_proc = user_auth_process::has_login( $db );

if ( !$user_info_proc ){

	 //若用户没有登录
	 $response_message = array(
			 'type' => 'notice' , 
			 'content' => '没有登录用户不能更改头像' ,
			 'url_des' => '去登陆？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}else{

	//若用户已经登录
	$nick = $user_info_proc->get_nick();
	$head_img = $user_info_proc->get_head_img();
	$gravatar_url = $user_info_proc->get_gravatar_img();
	$tpl->assign( 'nick' , $nick );
	$tpl->assign( 'head_img' , $head_img );
	$tpl->assign( 'sub_active' , 'update_user_head_img' );
	$tpl->assign( 'gravatar_url' , $gravatar_url );
}

//处理用户更新个人信息时的错误信息
if( session::get('update_fail_message' ) ){

	$tpl->assign( 'upload_fail_message' , session::get( 'upload_fail_message' ) );
	session::clear( 'upload_fail_message' );
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'title' , '更新用户头像' );
$tpl->display( 'account/update_user_head_img.tpl' );

