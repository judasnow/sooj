<?php
/**
 * Ajax 显示题目详细信息
 *
 * @todo 考虑是否可以静态化
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

//验证自动登录
try{

$db = db_connect();
$cookie = new cookie( $db );
$cookie->auto_login();
}catch( Exception $e ){

	 $e->getMessage();
}

$tpl = new custom_smarty();

//得到当前用户信息
$user_info_proc = unserialize( session::get( 'user' ) );

//若用户已经登录
if ( $user_info_proc instanceof user_info_process ){

	$nick = $user_info_proc->get_nick();
	$tpl->assign( 'nick' , $nick );
}

//@todo 注入危险
$request = new request( 'get' );
$no = $request->get( 'no' , 'magic' );

$tpl = new custom_smarty();
$db = db_connect();


try {

$problem_proc = new problem_process( $db );
$problems = $problem_proc->load( 'no' , $no );

//得到题目信息
$time_limit = $problem_proc->get( 'time_limit' );
$memory_limit = $problem_proc->get( 'memory_limit' );
$title = $problem_proc->get( 'title' );
$source = $problem_proc->get( 'source' );
$best_user = $problem_proc->get( 'best_user' );
$content = $problem_proc->get( 'content' );
$input = $problem_proc->get( 'input' );
$output = $problem_proc->get( 'output' );
$sample_input = $problem_proc->get( 'sample_input' );
$sample_output = $problem_proc->get( 'sample_output' );

$tpl->assign( 'no' , $no );
$tpl->assign( 'problem_title' , $title );
$tpl->assign( 'time_limit' , $time_limit );
$tpl->assign( 'memory_limit' , $memory_limit );
$tpl->assign( 'source' , $source );
$tpl->assign( 'best_user' , $best_user );
$tpl->assign( 'content' , $content );
$tpl->assign( 'input' , $input );
$tpl->assign( 'output' , $output );
$tpl->assign( 'sample_input' , $sample_input );
$tpl->assign( 'sample_output' , $sample_output );

}catch( Exception $e){

	echo $e->getMessage();
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->display( 'problem/ajax_problem_detail.tpl' );


