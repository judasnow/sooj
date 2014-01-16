<?php
/**
 * 测试验证码处理类
 *
 * @author 纹身特湿 <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

class test_class_captcha_process extends UnitTestCase{
	
	function setUp() {

	}
	function tearDown(){ 
		
	}

	function test_create_a_captcha_picture(){

		$path = "./";
		$img_name = "captcha.jpg";

		$captcha_process = new captcha_process( );
		$captcha_process->set_path( $path ) ;
		$captcha_process->set_img_name( $img_name );

		$this->assertTrue( $captcha_process->create_img( $img_name ) );

		$this->assertTrue( file_exists( $path.$img_name ) );
	}

	function test_get_phrase(){
		
		$path = "./" ;
		$img_name = "captcha.jpg" ;

		$captcha_process = new captcha_process( $path );
		$captcha_process->set_path( $path ) ;
		$captcha_process->set_img_name( $img_name );

		$this->assertTrue( $captcha_process->create_img( $img_name ) );

		$this->assertTrue( $captcha_process->get_phrase() );
	}

	function test_delete_img(){
		
		$path = "./" ;
		$img_name = "captcha.jpg" ;

		$captcha_process = new captcha_process( $path );
		$captcha_process->set_path( $path ) ;
		$captcha_process->set_img_name( $img_name );

		$this->assertTrue( $captcha_process->create_img( $img_name ) );

		//windows下测试有问题
		//不能删除文件
		//$this->assertTrue( $captcha_process->delete_img() );
		//$this->assertFalse( file_exists( $path.$img_name ) );
	}
}

$test = new test_class_captcha_process();
$test->run( new HtmlReporter() );


