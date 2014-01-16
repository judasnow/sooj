<?php
/**
 * 测试 app 类
 *
 * @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

class test_class_app extends UnitTestCase{

	function setUp(){
	}
	function tearDown(){
	}

	//测试判断用户是否登录
	function test_function_has_login(){

		$app = new app();
	}

	function test_function_get_script_name(){
	
		$this_script_name = app::get_script_name();
		$this->assertTrue( $this_script_name , "test_class_app" );
	}

	function test_function_get_module_name(){
	
		$this_script_module = app::get_module_name();
		$this->assertTrue( $this_script_module , "test" );
	}

	function test_function_get_app_root(){
	
		$app_root_path = app::get_app_root();
		$this->assertTrue( $app_root_path , SOOJ_ROOT );
	}

	function test_function_get_script_type(){
	
		 $script_type = app::get_script_type();
		 $this->assertEqual( "display" , $script_type );
	}

	function test_function_init_cache(){
		 
		 $cache = app::init_cache();
		 $this->assertTrue( $cache instanceof cache );
	}
	
	function test_function_get_condig(){
	
		//对于 config 文件中有的内容
		//正确读取
		$db_config = app::get_config( "db" );
		$this->assertTrue( is_array( $db_config ) );

		//对于 config 文件中不存在的内容
		//返回false
		$test_config = app::get_config( "test" );
	 	$this->assertFalse( $test_config );
	}
}
	
$test = new test_class_app();
$test->run( new HtmlReporter() );




