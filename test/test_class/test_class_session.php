<?php
/**
 * 测试配置文件读取函数
 *
* @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

session::start();
class test_class_session extends UnitTestCase{
	
	private $db;

	function setUp(){
	}
	function tearDown(){
	}
	function test_test(){
	 	 
		$this->assertTrue( true );
	}

}
	

$test = new test_class_session();
$test->run( new HtmlReporter() );




