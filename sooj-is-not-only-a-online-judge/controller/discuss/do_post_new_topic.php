<?php
/**
 * 处理用户发帖
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );

require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

//获得一个request对象，便于过滤输入
$request = new request( 'post' );
$user_info_proc = unserialize( session::get( 'user' ) );

try{

//判断是否已经登录
if ( !( $user_info_proc instanceof user_info_process ) ){
//没有登录系统不能发帖
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '还没有登录系统不能发帖哇' ,
			 'url_des' => '去登录？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$db = db_connect();
$topic_proc = new topic_process( $db );

$title = $request->get( 'title' , 'post' );
$content = $request->get( 'content' , 'post' );
$problem_no = $request->get( 'problem_no' , 'post' );

$topic_proc->set_poster_id( $user_info_proc->get_user_id() );
$topic_proc->set_poster_nick( $user_info_proc->get_nick() );

$topic_proc->set_title( $title );
$topic_proc->set_content( $content );
$topic_proc->set_problem_no( $problem_no );

if( $topic_proc->save() ){
//发帖成功
	$response_message = array(
		 'type' => 'success' , 
		 'content' => '发帖成功' ,
		 'url_des' => '去帖子列表哇？' ,
		 'url' => '../../controller/discuss/' );	 
}else{
//失败
	$response_message = array(
		 'type' => 'error' , 
		 'content' => 'Sorry，发帖失败' ,
		 'url_des' => '报告Bug?' ,
		 'url' => '../../controller/report_bug/' );
}

app::redirect( '../response/response.php' ,
	 array( 'name'=>'response_message' , 'content'=>$response_message ) ); 

}catch( Exception $e ){

	 echo $e->getMessage();
}

