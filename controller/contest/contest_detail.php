<?php
/**
 * 竞赛详细信息
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
	$user_id = $user_info_proc->get_user_id();
	$tpl->assign( 'nick' , $nick );
}

try{
$request = new request( 'get' );

//@todo 有注入危险
$id = $request->get( 'id' );

//此处新建的contest_proc对象,序列化之后保存在session中
//起到传递contest_id的作用
//而且,reg_user方法的调用也是本次对象创建的一个
//延续
$contest_proc = new contest_process( $db , $id );
$contest_proc->load( $id );

//序列化并放入session中保存
session::set( 'contest_proc' , serialize( $contest_proc ) );

$problem_list = $contest_proc->get_contest_problem();

$tpl->assign( 'problem_list' , $problem_list );

//设置竞赛详细信息
$tpl->assign( 'summary' , $contest_proc->get_summary() );
$tpl->assign( 'start_time' , $contest_proc->get_start_time() );
$tpl->assign( 'end_time' , $contest_proc->get_end_time() );
$tpl->assign( 'status' , $contest_proc->get_status() );
$tpl->assign( 'contest_title' , $contest_proc->get_title() );

//判断当前用户是否已经登录参加
//了这次比赛
if( $is_user_reg = $contest_proc->is_user_reg( !empty( $user_id ) ? $user_id : false ) ){
	 
	 //得到用户对于本次比赛的auth_code
	 $tpl->assign( 'auth_code' , $contest_proc->get_auth_code() );
	 $tpl->assign( 'is_user_reg' , $is_user_reg );
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , 'contest' );
$tpl->assign( 'title' , '竞赛详细' );
$tpl->display( 'contest/contest_detail.tpl' );

}catch ( Exception $e ){

	 echo $e->getMessage();
}


