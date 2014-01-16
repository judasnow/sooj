<?php
/**
 * 处理用户的更改登录密码的请求
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
			 'content' => '你还没有登录,不能进行该操作哦' ,
			 'url_des' => '去登录?' ,
			 'url' => '../../controller/account/login.php' );
			 
	 app::redirect( '../response/response.php' ,
	 	array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$db = db_connect();

//从系统中得到旧密码
$sys_old_password = $user_info_proc->get_password();
//从用户输入得到用户新密码
$old_password = $request->get( 'old_password' );
//从用户输入得到用户新密码
$new_password = $request->get( 'new_password' );
//从用户输入得到用户新密码确认信息
$new_password_check = $request->get( 'new_password_check' );

if( $sys_old_password != md5( $old_password ) ){
	 
	$update_user_password_message = "输入的旧密码有误";
	app::redirect( 'update_user_password.php' , 
	 array( 'name'=>'update_user_password_message' , 'content'=>$update_user_password_message ) );
}
if( $new_password != $new_password_check ){

	$update_user_password_message = "两次输入的新密码不一样";
	app::redirect( 'update_user_password.php' , 
	 array( 'name'=>'update_user_password_message' , 'content'=>$update_user_password_message ) );
}

//开始更新操作
if( $user_info_proc->do_update_password( $new_password ) ){
//更新成功
	$update_user_password_message = "更新密码ok";
	app::redirect( 'update_user_password.php' , 
	 array( 'name'=>'update_user_password_message' , 'content'=>$update_user_password_message ) );
}

}catch( Exception $e ){

	echo "update occur error.";
}


