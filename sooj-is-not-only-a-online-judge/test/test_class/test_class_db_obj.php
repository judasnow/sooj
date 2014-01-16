<?php
/**
 * 测试数据库抽象基类
 *
 * @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

//创建一个测试用的类
class db_obj_test extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'test' , 'k' );

		$this->add( 'k' , '' );
		$this->add( 'v' , '' );
	 }
}

class test_class_db_obj extends UnitTestCase{

	private $db;
	private $test;

	function setUp(){
		
		$this->db = new db();
		$sql = "create table `test` ( k varchar(255) , v varchar(255) )";
	 	
		$this->db->query( $sql );
		
	 	$this->k1 = rand();
		$this->v1 = rand();
	}

	function tearDown(){
		
		$this->db->query( "drop table `test`" );
		$this->db->disconnect();
	}

	function test_create(){
	
		@$this->test = new db_obj_test( $this->db );
		$this->assertTrue( $this->test instanceof db_obj );
	}

	function test_function_set_get(){

		$this->test_create();
	 	
		$this->test->set( 'k' , $this->k1 );
		$this->test->set( 'v' , $this->v1 );

		$load_k = $this->test->get( 'k' );
		$load_v = $this->test->get( 'v' );

		$this->assertTrue( $this->k1 == $load_k );
		$this->assertTrue( $this->v1 == $load_v );
	}

	//测试成功保存
	function test_function_save(){

	 	$this->test_create();

		$this->test->set( 'k' , $this->k1 );
		$this->test->set( 'v' , $this->v1 );

		$result = $this->test->save();

		//保存无异常返回true
		$this->assertTrue( $result );
	}

	//测试读出数据
	function test_function_load(){
	
		$this->test_function_save();
	 	 
		$test2 = new db_obj_test( $this->db );

		$result = $test2->load( 'k' , $this->k1 );
		
		//查询无异常返回true
		$this->assertTrue( $result );

		$this->assertTrue( $test2->get( 'k' ) == $this->k1 );
		$this->assertTrue( $test2->get( 'v' ) == $this->v1 );
	}

	//测试修改数据
	function test_function_update(){

		$v2 = 'ffff'; 
		$this->test_function_save();

		$test2 = new db_obj_test( $this->db );
		$test2->load( 'k' , $this->k1 );
		$test2->set( 'v' , $v2 );
		$result = $test2->save();

		//保存无异常返回true
		$this->assertTrue( $result );

		$test3 = new db_obj_test( $this->db );
		$test3->load( 'k' , $this->k1 );
	 	
		//与原对象中值不相同
		$this->assertTrue( $this->test->get( 'v' ) != $test3->get( 'v' ) );
		//现在对象中的值为更新后的值
		$this->assertTrue( $test3->get( 'v' ) == 'ffff' );
	}

	//测试删除一行记录
	function test_delete_one_record(){

		//存入一行记录
		$this->test_function_save();

		$result = $this->test->delete( 'k' , $this->k1 );

		//删除操作无异常
		$this->assertTrue( $result );

		//测试记录是否已经成功删除
		$test2 = new db_obj_test( $this->db );

	 	//应该因无法找到这条记录而返回false
		$res = $test2->load( 'k' , $this->k1 );
		$this->assertFalse( $res );
	}
}

$test = new test_class_db_obj();
$test->run( new HtmlReporter() );

