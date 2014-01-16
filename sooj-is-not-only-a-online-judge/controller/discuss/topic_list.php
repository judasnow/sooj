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
require_once( 'Pager.php' );
session::start();

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

//获取主题列表
$request = new request( 'get' );
$problem_no = $request->get( 'problem_no' );

if( $problem_no != null ){

	 $topics = topic_process::get_all_topic_by_tag( $db , 'problem_no' , $problem_no );
}else{
	
	 $topics = topic_process::get_all_topic( $db );
}



}catch( Exception $e ){

	 echo $e->getMessage();
}

//分页处理
//@todo 此配置应该可以由配置文件读出
$params = array(
	'itemData' => $topics,
	'perPage' => 6,
	'delta' => 8,             
	'append' => true,
	'clearIfVoid' => false,
	'urlVar' => 'entrant',
	'useSessions' => true,
	'closeSession' => true,
	'mode'  => 'Jumping',
);
$pager =& Pager::factory( $params );
$page_data = $pager->getPageData();
$links = $pager->getLinks();

//在模板中分页显示
$tpl->assign( 'topics' , $page_data );
$tpl->assign( 'links' , $links['all'] );

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , 'discuss' );
$tpl->assign( 'title' , 'discuss' );
$tpl->display( 'discuss/topic_list.tpl' );


