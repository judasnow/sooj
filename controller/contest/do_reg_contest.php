<?php
/**
 * 处理用户登记参加某比赛
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

//判断用户是否已经登录,未登录用户不可登记参加
//某比赛
$user_info_proc = user_auth_process::has_login( $db );

//反序列化在 contest_detail 页面生成的contest_proc 对象
$contest_proc = unserialize( session::get( 'contest_proc' ) ); 
if ( !$user_info_proc || !$contest_proc ){
//已经登录成功，无需再进行登录操作，重定向到response_message页面
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '未登录用户不能登记参加比赛' ,
			 'url_des' => '去登录？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$user_id = $user_info_proc->get_user_id();
$res = $contest_proc->user_reg( $user_id );

if( !$res ){
	//用户已经参加本次比赛或者
	//其他原因不能成功添加用户
	//信息到 contest_reg 表中 
	$response_message = array(
			 'type' => 'error' , 
			 'content' => '登记参加本次比赛失败，请确认之前是否已经成功登记。' ,
			 'url_des' => '返回竞赛页面？' ,
			 'url' => '../../controller/contest/' );

}else{

	$response_message = array(
			 'type' => 'success' , 
			 'content' => '登记参加本次比赛成功！' ,
			 'url_des' => '返回竞赛页面？' ,
			 'url' => '../../controller/contest/' );
}

app::redirect( '../response/response.php' ,
	 array( 'name'=>'response_message' , 'content'=>$response_message ) );



