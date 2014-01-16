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

$tpl->assign( 'title' , '在线评测状态' );

//若用户已经登录
if ( $user_info_proc instanceof user_info_process ){

	$nick = $user_info_proc->get_nick();
	$tpl->assign( 'nick' , $nick );
}

$db = db_connect();
$judge_result_proc = new judge_result_process( $db );
$judge_result_list = $judge_result_proc->get_all();

$tpl->assign( 'judge_result_list' , $judge_result_list );
$tpl->display( 'judge_result/judge_result_list.tpl' );


