<?php
/**
 * 测试 cache 类
 *
 * @author <judasnow@gmail.com> 
 */
require_once( './path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

class test_class_cache_process extends UnitTestCase{
	 
	private $db;
	
	function setUp(){}
	function teardown(){}

	//测试 set() 函数
	function test_function_set( ){

	 	 //应从配置文件中读出
		 $servers = array( "172.17.0.46"=>"11212" , "172.17.0.46"=>11213 );
		 $cache = new cache( $servers );
		 //测试缓存数据库查询结果

	 	 $sql = "SELECT * FROM user";
		 $hash_sql = hash( 'md4' , $sql );

		 $ca = new cache( $servers );

		 //测试是否保存成功
	 	 $res = $cache->set( $hash_sql , "fuck" );
		 $this->assertTrue( $res );

		 //测试读取数据
		 $res = $cache->get( $hash_sql );
		 $this->assertEqual( $res , 'fuck' );

		 //删除缓存
		 $res = $cache->delete( $hash_sql );
		 $this->assertTrue( $res );
		 //断言缓存中已不存在该数据
		 $res = $cache->get( $hash_sql );
		 $this->assertFalse( $res );
	}

	function test_function_add(){
	
		 ;
	}
}

$test = new test_class_cache_process();
$test->run( new HtmlReporter() );

