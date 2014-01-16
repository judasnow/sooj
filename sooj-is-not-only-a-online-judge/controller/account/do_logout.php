<?php
/**
 * 处理用户的登出系统请求
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );

require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

$db = db_connect();
$user_info_proc = user_auth_process::has_login( $db );

try{
//判断是否已经登录
if ( $user_info_proc ){
//已经处于登录状态才可进行登出

	//清除cookie信息，disable自动登录
	$cookie = new cookie( $db );
	if( !$cookie->disable_auto_login() ){

		throw new RunTimeException( '清除自动登录cookie信息时出错' );
	}

	//开始登出操作
	if ( user_auth_process::do_logout() ){
	//登出成功
		
	 	 $response_message = array(
			'type' => 'success' , 
			'content' => '退出登录成功' ,
			'url_des'=>'返回首页？' ,
			'url' => '../../controller/index.php' );

	}else{
	//退出登录失败
		$response_message = array(
			'type' => 'error' , 
			'content' => '退出登录失败' ,
			'url_des'=>'再试一次？' ,
			'url' => '../../controller/index.php' );
	}

}else{
	$response_message = array(
		'type' => 'notice' , 
		'content' => '您还没有登录，不能进行退出登录操作。' ,
		'url_des'=>'去登录？' ,
		'url' => '../../controller/account/login.php' );
}

app::redirect( '../response/response.php' ,
	array( 'name'=>'response_message' , 'content'=>$response_message ) );

}catch( Exception $e ){

	echo $e->getMessage();
}

