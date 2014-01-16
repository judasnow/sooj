<?php
require_once( './path.php' );
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
session::start();

$db = new db();
//判断用户是否已经登录,已登录用户不可访问本页面
$user_info_proc = user_auth_process::has_login( $db );

if ( $user_info_proc ){
//已经登录成功，无需再进行登录操作，重定向到response_message页面
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '已经成功登录系统' ,
			 'url_des' => '返回首页？' ,
			 'url' => '../../controller/index.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$tpl = new custom_smarty();

//若有注册错误消息需要反映给用户
@$auth_fail_message = session::get( 'auth_fail_message' );
@$times = session::get( 'auth_fail_times' );

if( !empty( $auth_fail_message ) ){

	$tpl->assign( 'auth_fail_message' , $auth_fail_message );
	//清除错误信息
	session::clear( 'auth_fail_message' );
}

//大于三次的失败尝试,便需要输入验证码
if( $times >= 3 ){

	$captcha_process = new captcha_process();
	if ( $captcha_process->create_img() ){

		//得到图片中内容放入session中
		$capthca_parase = $captcha_process->get_phrase();
		session::set( 'captcha_parase' , $capthca_parase );
	}else{
		 //生成验证码图片时出错
	}

	//@todo 暴露sessionid问题
	$tpl->assign( 'captcha_img' , '/sooj/view/picture/captcha/'.$_COOKIE[ 'PHPSESSID' ].'.jpg' );
	$tpl->assign( 'captcha' , true );
}

//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'title' , '用户登录' );
$tpl->display( 'account/login.tpl' );

