<?php
/**
 * 发布一个新主题
 *
 * @todo 考虑是否可以静态化
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

$tpl = new custom_smarty();
$db = new db();

//判断用户是否已经登录,已登录用户才可访问本页面
$user_info_proc = app::has_login( $db );

//验证自动登录
try{

//判断是否已经登录
if ( !( $user_info_proc instanceof user_info_process ) ){
//没有登录系统不能发帖
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '还没有登录系统不能发帖哇' ,
			 'url_des' => '去登录？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}


$db = db_connect();
$cookie = new cookie( $db );
$cookie->auto_login();

//得到当前用户信息
$user_info_proc = unserialize( session::get( 'user' ) );

//若用户已经登录
if ( $user_info_proc instanceof user_info_process ){

	$nick = $user_info_proc->get_nick();
	$tpl->assign( 'nick' , $nick );
}

}
catch( Exception $e ){

	 print $e->getMessage();
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , 'discuss' );
$tpl->assign( 'title' , 'discuss' );
$tpl->display( 'discuss/post_new_topic.tpl' );

