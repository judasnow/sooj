<?php
/**
 * 竞赛详细信息
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
require_once( 'Pager.php' );
session::start();

$request = new request( 'get' );
$tpl = new custom_smarty();
$db = new db();

try{
//@todo 有注入危险
$id = $request->get( 'id' );

$contest_proc = new contest_process( $db );
$problem_list = $contest_proc->get_contest_problem( $id );
$contest_proc->load( $id );

$tpl->assign( 'problem_list' , $problem_list );

//设置竞赛详细信息
$tpl->assign( 'summary' , $contest_proc->get_summary() );
$tpl->assign( 'start_time' , $contest_proc->get_start_time() );
$tpl->assign( 'end_time' , $contest_proc->get_end_time() );
$tpl->assign( 'status' , $contest_proc->get_status() );
$tpl->assign( 'contest_title' , $contest_proc->get_title() );

$tpl->assign( 'active' , 'contest' );
$tpl->assign( 'title' , '竞赛详细' );
$tpl->display( 'contest/contest_detail.tpl' );

}catch ( Exception $e ){

	 echo $e->getMessage();
}


