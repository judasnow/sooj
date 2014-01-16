<?php
/**
 * 测试problem_process类
 *
 * @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

class test_problem_process extends UnitTestCase{
	
	 private $db; 

	 function setUp(){

		$this->db = new db();
	 
		$this->create = new create_table();
		$this->create->create( "problem" );
		$this->create->create( "problem_detail" );
		$this->create->create( "problem_test_case" );

		//插入数据
		$sql = "INSERT INTO `problem` (`no`, `title`, `content`, `input`, `output`, `sample_input`, `sample_output`, 
			`tip`, `source`, `time_limit`, `memory_limit`, `best_user`) VALUES
			(1010, 'a+b', 'a+b', '1,2\r\n2,3', '3\r\n5', '1,2', '3', 'haha', 'me', '1000', '1000', -1);
		";
	 	$this->db->query( $sql );
		$sql = "INSERT INTO `problem_detail` SET `problem_no` = '1010';";
		$this->db->query( $sql );

	 }
	 function tearDown(){

		 $sql = "drop table problem";
		 $this->db->query( $sql );
		 $sql = "drop table problem_detail";
	 	 $this->db->query( $sql );
	 	 $sql = "drop table problem_test_case";
	 	 $this->db->query( $sql );
	 }
	 function test_get_all(){

	 	 //得到全部试题列表
	 	 $res = problem_process::get_all( $this->db );
	 	 $this->assertTrue( is_array( $res ) );
	 }
	 function test_search(){

	 	 //按题号搜索
	 	 $res = problem_process::search( $this->db , array( "key"=>'no' , "value"=>'1010' ) );
	 	 $this->assertTrue( is_array( $res ) );
		 //按题目的来源搜索
		 $res = problem_process::search( $this->db , array( "key"=>'source' , "value"=>'me' ) );
	 	 $this->assertTrue( is_array( $res ) );
	 }
}

$test = new test_problem_process();
$test->run( new HtmlReporter() );




