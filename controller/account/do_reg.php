<?php
/**
 * 处理用户的注册请求
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/class/RegException.class.php' );
session::start();

$db = new db();
$user_info_proc = user_auth_process::has_login( $db );

try{
//判断是否已经登录系统
	
if( $user_info_proc ){
	 //已经登录直接定向到update_user_profile页面
	 app::redirect( 'update_user_profile.php' );	 	 
}

$request = new request( 'post' );

$username = $request->get( 'username' );
$password = $request->get( 'password' );
$nick = $request->get( 'nick' );

//判断用户注册信息的是否为空
if( empty( $username ) || empty( $password ) || empty( $nick ) ){
	
	//注册页面提供的三个参数都不能为空
	$reg_fail_message = array( 'type'=>'error' ,
			 'content'=>'请完整的按要求填写注册信息 , 注意用户名只允许英文数字以及下划线' );

	app::redirect( 'reg.php' ,
		array( 'name'=>'reg_fail_message' , 'content'=>$reg_fail_message ) );	
}

//验证用户注册信息是否合法
if( !$request->is_vaild( $username , 'username' ) || !$request->is_vaild( $nick , 'nick' ) ){

	$reg_fail_message = array( 'type'=>'error' , 
			 'content'=>'注册信息含有非法字符' );

	app::redirect( 'reg.php' , 
		array( 'name'=>'reg_fail_message' , 
			 'content'=>$reg_fail_message ) );	
}

$user_reg_proc = new user_reg_process( $db , $request );

//测试用户名是否已经被注册
if( $user_reg_proc->is_reg() ){

	$reg_fail_message = array( 'type'=>'error' , 
			 'content'=>'该用户名已经被注册' );

	app::redirect( 'reg.php' , 
		array( 'name'=>'reg_fail_message' , 
			 'content'=>$reg_fail_message ) );
}

//开始注册操作
if ( $user_reg_proc->do_reg() ){

	//注册成功
	$response_message = array( 'type'=>'success' , 
		'content'=>'注册成功!' , 
		'url_des'=>'去登录' ,
		'url'=>'../account/login.php' );

	app::redirect( '../response/response.php' , 
		array( 'name'=>'response_message' , 'content'=>$response_message ) );	
}else{

	//无法预料的注册失败
	throw new RegException( '无法预料原因的注册失败' );
}

}catch( DatabaseException $e ){

	if( defined( "DEBUG" ) ){
	
		 $content = '注册失败'.$e->getMessage();
	}
	$reg_fail_message = array( 'type'=>'error' , 'content'=>$content );

	app::redirect( 'reg.php' , 
		array( 'name'=>'reg_fail_message' , 
			 'content'=>$reg_fail_message ) );	

}catch( Exception $e ){

	$reg_fail_message = array( 'type'=>'error' , 'content'=>'注册失败' );

	app::redirect( 'reg.php' , 
		array( 'name'=>'reg_fail_message' , 
			 'content'=>$reg_fail_message ) );	
}

