<?php
/**
 * 处理用户的登录请求
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );

require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/class/AuthException.class.php' );
require_once( 'Log.php' );
session::start();

$db = new db();
//获得一个request对象，便于过滤输入
$request = new request( 'post' );

//判断用户是否已经登录,已登录用户不可访问本页面
$user_info_proc = user_auth_process::has_login( $db );

try{

if( $user_info_proc ){
//自动登录验证成功
	 $response_message = array( 'type'=>'success' , 
		'content'=>'登录成功' ,
		'url_des'=>'返回首页' ,
		'url'=>'../index.php' );
	 
	 app::redirect( '../response/response.php' , 
			 array( 'name'=>'response_message' , 'content'=>$response_message ) );	 	 
}

//检查用户输入的验证码是否正确
if( session::get( 'auth_fail_times' ) >= 3 ){
//需要检验验证码
	$captcha_input = $request->get( 'captcha_input' , 'string' );
	$captcha_parase = session::get( 'captcha_parase' );
	if( $captcha_input == $captcha_parase && !empty( $captcha_input ) ){
	//验证码输入正确

		//删除验证码图片
	 	captcha_process::delete_img( '/sooj/view/picture/captcha/'.$_COOKIE[ 'PHPSESSID' ].'.jpg' );
	}else{
	//加入出错消息，返回给用户

		throw new RunTimeException( '验证码输入错误' );
	}
}

$user_auth_process = new user_auth_process( $db , $request );

//开始登录操作
if ( $user_auth_process->do_login() ){
//登录成功

	//重置失败尝试次数
	session::set( 'auth_fail_times' , 0 );

	//用户是否需要启用cookie
	$set_auto_login = $request->get( 'remember_user' );
	if( $set_auto_login == 'on' ){
	 	
		//@todo 貌似建立了重复的对象
		$cookie = new cookie( $db );
		$user_info_proc = unserialize( session::get( 'user' ) );
		//cookie保存4周时间
		
		if( !$cookie->enable_auto_login( $user_info_proc->get_user_id() ) ){
			 
			 throw new RunTimeException( '设置cookie错误' );
		}
	}
	$response_message = array( 'type'=>'success' , 
		'content'=>'登录成功' ,
		'url_des'=>'返回首页' ,
		'url'=>'../index.php' );

	app::redirect( '../response/response.php' , 
			 array( 'name'=>'response_message' , 'content'=>$response_message ) );

}else{
	//@see user_auth_process 按用户提供的用户名密码查寻数据库无记录
	throw new AuthException( '用户名或密码错误' );
}

}catch( DatabaseException $e ){
//记录日志

	$auth_fail_message = array( 'type'=>'error' , 
		'content'=>'用户名或密码错误' , 
	);

	app::redirect( 'login.php' , 
			 array( 'name'=>'auth_fail_message' , 'content'=>$auth_fail_message ) );

}catch( AuthException $e ){
//异常信息将暴露给用户
	
	//失败次数加1
	$times = session::get( 'auth_fail_times' );
	$times += 1;
	session::set( 'auth_fail_times' , $times );

	$auth_fail_message = array( 'type'=>'error' , 
		'content'=>'用户名或密码错误' , 
	);

	app::redirect( 'login.php' , 
			 array( 'name'=>'auth_fail_message' , 'content'=>$auth_fail_message ) );

}catch( Exception $e ){

	$auth_fail_message = array( 'type'=>'error' , 
		'content'=>$e->getMessage() , 
	);

	app::redirect( 'login.php' , 
			 array( 'name'=>'auth_fail_message' , 'content'=>$auth_fail_message ) );
}

