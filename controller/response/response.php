<?php
require_once( 'path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
require_once( 'Log.php');
session::start();

$tpl = new custom_smarty();


//得到当前用户信息
$user_info_proc = unserialize( session::get( 'user' ) );

$tpl->assign( 'title' , '系统信息' );

//若用户已经登录
if ( $user_info_proc instanceof user_info_process ){

	$nick = $user_info_proc->get_nick();
	$tpl->assign( 'nick' , $nick );
}

//如果用户直接调用本页面,消息格式必须为一数组
if( session::get( 'response_message' ) ){

	$tpl->assign( 'response_message' , session::get( 'response_message' ) );
	session::clear( 'response_message' );
}else{
	 $response_message = array(
		 'type' => 'info' ,
		 'content' => '暂时没有您的消息' ,
		 //url描述
		 'url_des' => '返回首页' ,
		 'url' => '../../controller/' ); 

	 $tpl->assign( 'response_message' , $response_message );
}

$tpl->display( 'response/response.tpl' );

