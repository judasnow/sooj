<?php
/**
 * 在单独的页面显示竞赛结束时的结果
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

$db = new db();
$tpl = new custom_smarty();

//判断用户是否已经登录
$user_info_proc = unserialize( session::get( 'user' ) );

//若用户未登录
if ( !($user_info_proc instanceof user_info_process) ){

	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '未登录用户不能查看竞赛状态啊.' ,
			 'url_des' => '去登录？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$nick = $user_info_proc->get_nick();
$user_id = $user_info_proc->get_user_id();
$tpl->assign( 'nick' , $nick );

//得到竞赛编号
$request = new request( 'get' );
$contest_id = $request->get( 'contest_id' , 'magic' );

try {
	
$contest_proc = new contest_result_process( $db , $contest_id );
$contest_problem_list = $contest_proc->get_contest_problem_list(); 
$contest_reslut_final = $contest_proc->get_result_list_final();
$contest_reslut_detail = $contest_proc->get_result_detail();

$tpl->assign( 'contest_problem_list' , $contest_problem_list );
$tpl->assign( 'contest_reslut_final' , $contest_reslut_final );
$tpl->assign( 'contest_reslut_detail' , $contest_reslut_detail );

}catch( Exception $e){

	echo $e->getMessage();
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->display( 'contest/view_contest_result.tpl' );


