<?php
/**
 * 用以显示更该用户详细信息的页面
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

$tpl = new custom_smarty();

//得到当前用户信息
$user_info_proc = unserialize( session::get( 'user' ) );

//若用户已经登录
if ( $user_info_proc instanceof user_info_process ){

	$nick = $user_info_proc->get_nick();
	$motto = $user_info_proc->get_motto();
	$head_img = $user_info_proc->get_head_img();
	$email = $user_info_proc->get_email();	 	

	$tpl->assign( 'nick' , $nick );
	$tpl->assign( 'motto' , $motto );
	$tpl->assign( 'head_img' , $head_img );
	$tpl->assign( 'email' , $email );
	$tpl->assign( 'sub_active' , 'update_user_profile' );
}else{
	
	//没有登录的用户不能访问本页面
	$response_message = array(
		'type' => 'notice' , 
		'content' => '您还没有登录，不能进行该操作。' ,
		'url_des'=>'去登录？' ,
		'url' => '../../controller/account/login.php' );

	app::redirect( '../response/response.php' ,
	 	array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

//处理用户更新个人信息时的错误信息
if( session::get('update_fail_message' ) ){

	$tpl->assign( 'upload_fail_message' , session::get( 'upload_fail_message' ) );
	session::clear( 'upload_fail_message' );
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'title' , '更新用户信息' );
$tpl->display( 'account/update_user_profile.tpl' );

