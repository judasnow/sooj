<?php
/**
 * 显示题目列表,默认为显示全部
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
$db = db_connect();
$request = new request( 'post' );

//验证自动登录
try{

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

//尝试搜索
$search_cond = $request->get( 'search_cond' );
$search_option = $request->get( 'search_option' );
if( !empty( $search_cond ) && !empty( $search_cond ) ){

	$problems = problem_process::search( $db , array( 'key'=>$search_option , 'value'=>$search_cond ) );
}else{

	 //读取全部题库列表
	 $problems = problem_process::get_all( $db );
}
if ( empty( $problems ) ){

	echo "返回题库为空";
}

$problem_sum = count( $problems );

}catch( Exception $e ){

	 echo $e->getMessage();
}

//分页处理
//此配置应该可以由配置文件读出
$params = array(
	'itemData' => $problems,
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

//题库总数
$tpl->assign( 'problem_sum' , $problem_sum );
$tpl->assign( 'problems' , $page_data );
$tpl->assign( 'links' , $links['all'] );

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , 'problem' );
$tpl->assign( 'title' , '题库列表' );
$tpl->display( 'problem/problem_list.tpl' );

