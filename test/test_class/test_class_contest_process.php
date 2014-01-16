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

		 $db = new db();
		 $this->db = $db;

		 $this->create = new create_table();
	 	 $this->create->create( "contest" );
	 }

	 function tearDown(){

	 	 $this->create->drop( "contest" );
	 }

	 function test_(){

	 	 
	 }
}

$test = new test_class_contest_process();
$test->run( new HtmlReporter() );

