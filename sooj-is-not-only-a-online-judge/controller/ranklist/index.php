<?php
/**
 * 显示用户积分排名
 * 
 * @todo sql 联合查询是性能瓶颈
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

//获取ranklist
$ranklist = ranklist_process::get_ranklist( $db );

}catch( Exception $e ){

	 echo $e->getMessage();
}

//分页处理
//@todo 此配置应该可以由配置文件读出
$params = array(
	'itemData' => $ranklist,
	'perPage' => 7,
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
$tpl->assign( 'ranks' , $page_data );
$tpl->assign( 'links' , $links['all'] );

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , 'ranklist' );
$tpl->assign( 'title' , 'ranklist' );
$tpl->display( 'ranklist/ranklist.tpl' );

