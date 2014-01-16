<?php
/**
 * 用户查看代码内容
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

//判断用户是否已经登录,未登录用户不可访问本页面
$user_info_proc = user_auth_process::has_login( $db );

if ( ! ($user_info_proc instanceof user_info_process) ){

	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '未登录用户不能查看代码啊.' ,
			 'url_des' => '去登录？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$request = new request( 'get' );
$code_no = $request->get( 'code_no' );
$user_id = $user_info_proc->get_user_id();


$code_proc = new code_process( $db );
$code_proc->load( $code_no );

$tpl->assign( 'lang' , $code_proc->get( 'language' ) );
$tpl->assign( 'code_user' , $code_proc->get( 'user_id' ) );
$tpl->assign( 'code_no' , $code_no );
$tpl->assign( 'content' , $code_proc->get( 'content' ) );

$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , '' );
$tpl->display( 'code/view_code.tpl' );

