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

$db = new db();
$tpl = new custom_smarty();

//判断用户是否已经登录,已登录用户不可访问本页面
$user_info_proc = user_auth_process::has_login( $db );

if ( ! ($user_info_proc instanceof user_info_process) ){

	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '未登录用户不能提交代码啊.' ,
			 'url_des' => '去登录？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$request = new request( 'get' );
$problem_no = $request->get( 'problem_no' );

$user_id = $user_info_proc->get_user_id();

//判断该题目在当前会话的条件下
//是否可以提交
if( !problem_process::is_available( $db , $problem_no , $user_id ) ){

	 //该题目并没有被开放提交
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '不好意思，该试题不存在或还没有开放提交' ,
			 'url_des' => '试试其他题？' ,
			 'url' => '../../controller/problem/' );

	app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );

}else{

	 //判断是否在竞赛中
	 $contest_proc = unserialize( @session::get( 'contest_proc' ) );
	 if ( $from_contest_page = ( $contest_proc instanceof contest_process ) ){
	 
	 	 $contest_id = $contest_proc->get_id();
	 	 $tpl->assign( 'contest_id' , $contest_id );
	 }	 

	 $tpl->assign( 'problem_no' , $problem_no );

	 //得到当前脚本所属模块名称
	 //以加载相应的css文件
	 $tpl->assign( 'module' , app::get_module_name() );
	 $tpl->assign( 'active' , '' );
	 $tpl->assign( 'title' , '代码提交' );

	 $nick = $user_info_proc->get_nick();
	 $tpl->assign( 'nick' , $nick );

	 $tpl->display( 'code/code_submit.tpl' );
}
