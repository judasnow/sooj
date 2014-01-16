<?php
/**
 * 显示题目详细信息
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

$db = new db();
$tpl = new custom_smarty();

//判断用户是否已经登录,已登录用户不可访问本页面
$user_info_proc = user_auth_process::has_login( $db );

$user_id = '';
//如果用户已经登录
if ( $user_info_proc instanceof user_info_process ){

	$nick = $user_info_proc->get_nick();
	$user_id = $user_info_proc->get_user_id();
	$tpl->assign( 'nick' , $nick );
}

}catch( Exception $e ){

	 $e->getMessage();
}

//@todo 注入危险
$request = new request( 'get' );
$no = $request->get( 'no' , 'magic' );

try {

$problem_proc = new problem_process( $db );

//判断该试题是否可以
//展示给当前登录用户查看
if( !problem_process::is_available( $db , $no , $user_id ) ){

	 //该题目并没有被开放提交或不存在
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '不好意思，该试题不存在或还没有开放提交' ,
			 'url_des' => '试试其他题？' ,
			 'url' => '../../controller/problem/' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$problem_proc->load( $no );

//得到题目信息
//@todo 效率是不是有点低。。。
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
$tip = $problem_proc->get( 'tip' );

$ac_count = $problem_proc->get( 'ac_count' ); 
$sb_count = $problem_proc->get( 'sb_count' ); 

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
$tpl->assign( 'tip' , $tip );

$tpl->assign( 'ac_count' , $ac_count );
$tpl->assign( 'sb_count' , $sb_count );

}catch( Exception $e){

	echo $e->getMessage();
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , 'problem' );
$tpl->assign( 'title' , '题目详细' );
$tpl->display( 'problem/problem_detail.tpl' );


