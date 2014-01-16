<?php
/**
 * 显示所有竞赛的列表
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
require_once( 'Pager.php' );
session::start();

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

$contest_list = contest_process::get_all( $db );

$tpl->assign( 'contest_list' , $contest_list );

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , 'contest' );
$tpl->assign( 'title' , '竞赛列表' );
$tpl->display( 'contest/contest_list.tpl' );


