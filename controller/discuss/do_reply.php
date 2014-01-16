<?php
/**
 * 处理用户回复帖子
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
//没有登录系统不能回复帖子
	 $response_message = array(
			 'type' => 'info' , 
			 'content' => '还没有登录系统不能回复哇' ,
			 'url_des' => '去登录？' ,
			 'url' => '../../controller/account/login.php' );

	 app::redirect( '../response/response.php' ,
			  array( 'name'=>'response_message' , 'content'=>$response_message ) );
}

$db = new db();
$reply_proc = new reply_process( $db );

$topic_no = $request->get( 'topic_no' );

//设置回复用户的信息
$reply_proc->set_replyer_id( $user_info_proc->get_user_id() );
$reply_proc->set_replyer_nick( $user_info_proc->get_nick() );

$reply_proc->set_content( $request->get( 'content' ) );
$reply_proc->set_topic_no( $topic_no );

if( $reply_proc->save() ){
//保存回复成功
	 $response_message = array(
			 'type' => 'success' , 
			 'content' => '回复成功' ,
			 'url_des' => '去看自己的回复？' ,
			 'url' => "../../controller/discuss/topic_detail.php?topic_no=$topic_no" );
}else{
//回复失败
	 $response_message = array(
			 'type' => 'success' , 
			 'content' => '回复失败（内部原因）' ,
			 'url_des' => '重新回复？' ,
			 'url' => "../../controller/discuss/topic_detail.php?topic_no=$topic_no" );
}

app::redirect( '../response/response.php' ,
	 array( 'name'=>'response_message' , 'content'=>$response_message ) );

$title = $request->get( 'title' , 'string' );
$content = $request->get( 'content' , 'string' );

}catch( Exception $e ){

	 print $e->getMessage();
}
