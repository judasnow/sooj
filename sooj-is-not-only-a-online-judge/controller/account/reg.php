<?php
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( 'Log.php');
session::start();

$tpl = new custom_smarty();

$db = new db();
//判断用户是否已经登录,已登录用户不可访问本页面
$user_info_proc = user_auth_process::has_login( $db );

if ( $user_info_proc ){
//已经登录成功，无需再进行登录操作，重定向到response_message页面
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '已经成功登录系统' ,
			 'url_des' => '返回首页？' ,
			 'url' => '../../controller/index.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

if( $user_info_proc ){
	 //已经登录直接定向到update_user_profile页面
	 app::redirect( 'update_user_profile.php' );	 
}	 

//若有注册错误消息需要反映给用户
@$reg_fail_message = session::get( 'reg_fail_message' );

if( !empty( $reg_fail_message ) ){

	$tpl->assign( 'reg_fail_message' , $reg_fail_message );
	//清除错误信息
	session::clear( 'reg_fail_message' );
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'title' , '用户注册' );
$tpl->display( 'account/reg.tpl' );

