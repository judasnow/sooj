<?php
/**
 * 测试脚本的头文件
 * 集中包含了一些测试用的库文件
 *
 * @author 纹身特湿 <judasnow@gmail.com>
 */

//require_once( 'path.php' );

//定义测试常量，指明当前运行于测试模式
define( "TEST" , true );

require_once( SOOJ_ROOT . '/test/simpletest/unit_tester.php' );
require_once( SOOJ_ROOT . '/test/simpletest/reporter.php' );

require_once( SOOJ_ROOT.'/include/function/get_config.function.php' );
require_once( SOOJ_ROOT.'/include/function/autoload.function.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );

require_once( SOOJ_ROOT.'/test/sooj_database.php' );

