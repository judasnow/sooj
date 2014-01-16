<?php
//动态刷新评测结果
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
session::start();

$request = new request( 'get' );
$max_no = $request->get( 'max_no' );

$tpl = new custom_smarty();

$db = db_connect();
$judge_result_proc = new judge_result_process( $db );
$new_result_list = $judge_result_proc->get_new( $max_no , date("Y-m-d H:i:s",time()+8*60*60) );

$tpl->assign( 'new_result_list' , $new_result_list );
$tpl->display( 'judge_result/refresh.tpl' );

