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
//已经登录成功，无需再进行登录操作，重定向到response_message页面
	 $response_message = array(
			 'type' => 'notice' , 
			 'content' => '还没有登录系统，不能进行此操作' ,
			 'url_des' => '去登录？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

//若用户已经登录
$nick = $user_info_proc->get_nick();
$head_img = $user_info_proc->get_head_img();
$tpl->assign( 'nick' , $nick );	
$tpl->assign( 'head_img' , $head_img );
$tpl->assign( 'sub_active' , 'update_user_password' );

//处理用户更新密码时的信息
if( session::get( 'update_user_password_message' ) ){

	$tpl->assign( 'update_user_password_message' , session::get( 'update_user_password_message' ) );
	session::clear( 'update_user_password_message' );
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'title' , '更新用户登录密码' );
$tpl->display( 'account/update_user_password.tpl' );

