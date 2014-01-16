<?php
/**
 * 显示竞赛结果 
 *
 * @todo 考虑是否可以静态化
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

$result_list = contest_result_process::get_result_list( $db , $contest_id , $user_id );

if( is_array( $result_list ) ){
	 
	 $tpl->assign( 'result_list' , $result_list );
}

}catch( Exception $e){

	echo $e->getMessage();
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->display( 'contest/ajax_view_contest_result.tpl' );

