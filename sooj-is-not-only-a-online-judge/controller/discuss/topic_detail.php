<?php
/**
 * 显示主题列表
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

$request = new request('get');

$tpl = new custom_smarty();

//验证自动登录
try{

$db = new db();
$cookie = new cookie( $db );
$cookie->auto_login();

//得到当前用户信息
$user_info_proc = unserialize( session::get( 'user' ) );

//若用户已经登录
if ( $user_info_proc instanceof user_info_process ){

	$nick = $user_info_proc->get_nick();
	$tpl->assign( 'nick' , $nick );
}

$topic_no = $request->get( 'topic_no' );
//获取主题详细信息
$topic_proc = new topic_process( $db );
$topic_proc->load( 'topic_no' , $topic_no );

//增加帖子被查看次数
$topic_proc->plus_view_count();

$reply_count = $topic_proc->get( 'reply_count' );

//获取发帖用户id,用来获取用户名(nick)
$poster_id = $topic_proc->get( 'poster_id' );
$user_info_proc = new user_info_process( $db , $poster_id );

//@todo 如何保证用户昵称一定存在?
$poster_nick = $user_info_proc->get_nick();

$tpl->assign( 'topic_title' , $topic_proc->get( 'title' ) );
$tpl->assign( 'content' , $topic_proc->get( 'content' ) );
//用来生成头像地址
$tpl->assign( 'poster_id' , $poster_id );
$tpl->assign( 'poster_nick' , $poster_nick );
$tpl->assign( 'post_time' , $topic_proc->get( 'post_time' ) );
$tpl->assign( 'view_count' , $topic_proc->get( 'view_count' ) );
$tpl->assign( 'reply_count' , $reply_count );

$tpl->assign( 'topic_no' , $topic_no );

//得到回复消息，如果有的话
if( $reply_count != 0 ){
	
	$replys = reply_process::get_all_reply( $db , $topic_no );
	$tpl->assign( 'replys' , $replys );
}

}catch( Exception $e ){

	 echo $e->getMessage();
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , 'discuss' );
$tpl->assign( 'title' , 'discuss' );
$tpl->display( 'discuss/topic_detail.tpl' );

