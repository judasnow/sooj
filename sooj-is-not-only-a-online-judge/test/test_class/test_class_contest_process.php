<?php
/**
 * 测试类 contest_process 
 *
 * @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

session::start();

class test_class_contest_process extends UnitTestCase{

	private $db;

	function setUp(){
	}

	function tearDown(){
	}

	function test_(){
	}
}

$test = new test_class_contest_process();
$test->run( new HtmlReporter() );

