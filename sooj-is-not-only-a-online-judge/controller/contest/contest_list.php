<?php
/**
 * 显示所有竞赛的列表
 *
 * @author <judasnow@gmail.com>
 */
require_once( './path.php' );
//包含自动加载类
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );
require_once( 'Pager.php' );
session::start();

$tpl = new custom_smarty();
$db = new db();

$contest_proc = new contest_process( $db );
$contest_list = $contest_proc->get_all();

$tpl->assign( 'contest_list' , $contest_list );

$tpl->assign( 'active' , 'contest' );
$tpl->assign( 'title' , '竞赛列表' );
$tpl->display( 'contest/contest_list.tpl' );


