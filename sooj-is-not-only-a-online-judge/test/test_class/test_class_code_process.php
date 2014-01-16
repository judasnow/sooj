<?php
/**
 * 测试 代码评测处理类
 *
 * @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

class test_class_db_obj_code extends UnitTestCase{

	private $db;

	function setUp(){

		 $db = new db();
		 $this->db = $db;
		 $this->cook = new cookie( $this->db );

		 $this->create = new create_table();
		 $this->create->create( "code" );
	}

	function tearDown(){		

		 $this->create->drop( "code" );
	}

	//测试保存用户的代码
	function test_funtino_save(){

		$_POST = array( 'problem_no'=>'1000' , 'user_id'=>'26' , 'language'=>'c' , 'content'=>'testesteset' );
	 	$request = new request( 'post' );

		$code_proc = new code_process( $this->db );

		$res = $code_proc->save( $request );
		$this->assertTrue( $res );

		//save返回true证明成功缓存
		$cache = app::init_cache();
		$code_info = $cache->get( $code_proc->get_code_no() );
		$code_info = json_decode( $code_info , true );
		$this->assertEqual( $code_info['content'] , $code_info['content'] );

		//测试用例
		$test_case_info = json_decode( $cache->get( $_POST['problem_no'] ) );
		$this->assertTrue( is_array( $test_case_info ) );
	}
}

$test = new test_class_db_obj_code();
$test->run( new HtmlReporter() );



