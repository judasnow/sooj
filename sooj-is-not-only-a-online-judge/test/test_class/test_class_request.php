<?php
/**
 * 测试request类
 *
 * @author 纹身特湿 <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

class test_class_request extends UnitTestCase{
	
	private $db_connect; 

	function setUp(){
	}
 	function tearDown(){
	}

	function test_function_get_for_post(){
	 	
		$_POST = array( 'email'=>'123@123.xom' );

		$req = new request( 'post' );
		$email = $req->get( 'email' );

		$this->assertTrue( $email == $_POST['email'] );
	}

	function test_function_get_for_get(){
	 	
		$_GET = array( 'email'=>'123@123.xom' );

		$req = new request( 'get' );
		$email = $req->get( 'email' );

		$this->assertTrue( $email == $_GET['email'] );
	}

	function test_funtion_is_vaild_email(){
	
		$_POST = array( 'noemail'=>'123123.com' , 'email'=>'judasnow@gmail.com');

		$req = new request( 'post' );

		$res = $req->is_vaild( 'noemail' , 'email' );
		$this->assertFalse( $res );

		$res = $req->is_vaild( 'email' , 'email' );
		$this->assertTrue( $res );
	}

}
	

$test = new test_class_request();
$test->run( new HtmlReporter() );




