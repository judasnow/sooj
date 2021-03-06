<?php
/**
 * 处理用户的更改个人信息的请求
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );

require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

//取得用户的输入
$request = new request( 'post' );
//得到session中的用户信息
$user_info_proc = unserialize( session::get( 'user' ) );

try{
//判断是否已经登录
if ( !( $user_info_proc instanceof user_info_process ) ){
//用户还没有登录,定向到response页面提示用户进行登录操作先
	 $response_message = array(
			 'type' => 'notice' , 
			 'content' => '你还没有登录,不能进行该操作' ,
			 'url_des'=>'去登录?' ,
			 'url' => '../../controller/account/login.php' );
			 
	 session::set( 'response_message' , $response_message );
	 header( 'Location: ../response/response.php' );
	 exit();
}

$db = db_connect();

//开始更新操作
$new_nick = $request->get( 'nick' , 'string' );
if( !empty( $new_nick ) ){

	 $user_info_proc->update_nick( $new_nick );
}

echo $new_motto = $request->get( 'motto' , 'string' );
if( !empty( $new_nick ) ){

	 $user_info_proc->update_motto( $new_motto );
}

if( $user_info_proc->do_update() ){
//更新成功
	header( 'Location: update_user_profile.php' );
	exit();
}

}catch( Exception $e ){

	echo $e->getMessage();
}

