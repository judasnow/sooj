<?php
/**
 * 处理用户的提交代码请求
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );

require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

//moke 便于windows下测试
if( PHP_OS == "WINNT" ){

	$_POST['code_no'] = 32;
}

//获得一个request对象，便于过滤输入
$request = new request( 'post' );
$user_info_proc = unserialize( session::get( 'user' ) );

try{

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

$db = new db();
$code_proc = new code_process( $db );

//设置code记录中的user_id
//@todo 考虑id在数据库中做索引要easy些
$request->set( 'user_id' , $user_info_proc->get_user_id() );

$code_no = $request->get( 'code_no' );
//保存用户代码
if( $code_proc->save( $request ) ){

	$code_proc->do_judge( $code_no );
	//重定向到评测结果页面
	//app::redirect( '/sooj/judge_result/judge_result_list.php' );
}

}catch( Exception $e ){

	 echo $e->getMessage();
}

