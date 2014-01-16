<?php
/**
 * 处理用户退出某比赛
 * 的请求
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
$user_info_proc = user_auth_process::has_login( $db );

//反序列化在 contest_detail 页面生成的contest_proc 对象
$contest_proc = unserialize( session::get( 'contest_proc' ) ); 
if ( !$user_info_proc || !$contest_proc ){
//已经登录成功，无需再进行登录操作，重定向到response_message页面
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '未登录用户不能进行本操作' ,
			 'url_des' => '登录去？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$user_id = $user_info_proc->get_user_id();
$res = $contest_proc->undo_user_reg( $user_id );

if( !$res ){

	$response_message = array(
			 'type' => 'error' , 
			 'content' => '退出本次比赛失败，请确认之前是否已经成功登记。' ,
			 'url_des' => '返回竞赛页面？' ,
			 'url' => '../../controller/contest/' );

}else{

	$response_message = array(
			 'type' => 'success' , 
			 'content' => '退出参加本次比赛成功！' ,
			 'url_des' => '返回竞赛页面？' ,
			 'url' => '../../controller/contest/' );
}

app::redirect( '../response/response.php' ,
	 array( 'name'=>'response_message' , 'content'=>$response_message ) );




