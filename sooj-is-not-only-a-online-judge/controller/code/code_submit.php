<?php
/**
 * 用户提交代码页面
 *
 * @todo 考虑是否可以静态化
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

$user_info_proc = unserialize( session::get( 'user' ) );

//判断是否已经登录
if ( !( $user_info_proc instanceof user_info_process ) ){
//没有登录系统不能进行代码提交
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '还没有登录系统不能提交代码' ,
			 'url_des' => '去登录？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$tpl = new custom_smarty();
$db = db_connect();

$request = new request( 'get' );
$problem_no = $request->get( 'problem_no' );

$tpl->assign( 'problem_no' , $problem_no );


//得到当前脚本所属模块名称
//以加载相应的css文件
$tpl->assign( 'module' , app::get_module_name() );
$tpl->assign( 'active' , '' );
$tpl->assign( 'title' , '代码提交' );
$tpl->display( 'code/code_submit.tpl' );


