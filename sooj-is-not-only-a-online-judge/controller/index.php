<?php
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

try{
	
$db = new db();
$tpl = new custom_smarty();

//判断用户是否已经成功登录
$user_info_proc = user_auth_process::has_login( $db );

//得到当前用户信息
$user_info_proc = unserialize( session::get( 'user' ) );

//若用户已经登录
if ( $user_info_proc instanceof user_info_process ){

	$nick = $user_info_proc->get_nick();
	$tpl->assign( 'nick' , $nick );
}

//得到小部件需要的信息

//得到排名前十的用户
$plugins_rank_top_10 = ranklist_process::get_top_10( $db );
//得到最新的比赛信息 默认为5条
$last_contest = contest_process::get_last_contest( $db );

}catch( Exception $e ){

	 $e->getMessage();
}

$tpl->assign( 'plugins_rank_top_10' , $plugins_rank_top_10 );
$tpl->assign( 'last_contest' , $last_contest );
$tpl->assign( 'title' , 'Sooj Index Page' );
$tpl->assign( 'active' , 'index' );
$tpl->display( 'index.tpl' );


