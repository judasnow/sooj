<?php
/**
 * 测试数据库连接函数
 *
 * @author 纹身特湿 <tel:13778575175> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );
require_once( SOOJ_ROOT.'/include/function/db_connect.function.php' );

class test_function_db_connect extends UnitTestCase{

	function setUp(){}
	function tearDown(){}
	
	//仅仅测试了成功连接时的
	//情况,失败时的情况不易测试
	//但失败时抛出异常已经过手工
	//测试
	function test_connect_db_success(){
		
		$db = db_connect();
		$this->assertTrue( $db instanceof MDB2_Driver_mysql );
	}
}

$test = new test_function_db_connect();
$test->run(new HtmlReporter());
