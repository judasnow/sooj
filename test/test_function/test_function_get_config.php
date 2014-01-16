<?php
/**
 * 测试配置文件读取函数
 *
 * @author 纹身特湿 <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );
require_once( SOOJ_ROOT.'/include/function/get_config.function.php' );

class test_function_get_config extends UnitTestCase{

	function setUp(){}
	function tearDown(){}
	
	function test_get_db_config_file(){
		
		$db_config = get_config('db');
		$this->assertTrue(array_key_exists('host', $db_config));
		$this->assertTrue(array_key_exists('username', $db_config));
		$this->assertTrue(array_key_exists('password', $db_config));
		$this->assertTrue(array_key_exists('name', $db_config));
	}
}

$test = new test_function_get_config();
$test->run(new HtmlReporter());

