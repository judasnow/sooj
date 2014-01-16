<?php
/**
 * 测试类 user auth process 
 *
 * @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

session::start();

class test_class_user_reg_process extends UnitTestCase{

	private $db;

	function setUp(){

	 	$this->db = new db();

	 	$this->create = new create_table();
		$this->create->create( "user" );
		$this->create->create( 'user_profile' );
		$this->create->create( 'user_judge_statistics' );

	 	$sql = "
INSERT INTO `user` (`id`, `username`, `password`, `last_login_time`, `last_login_ipadd`) VALUES
(8, 'test', '098f6bcd4621d373cade4e832627b4f6', '2011-03-31 19:54:42', NULL);
";
		$this->db->query( $sql );

	 	$sql="
INSERT INTO `user_profile` (`id`, `nick`, `head_img`, `email`, `motto`, `reg_time`) VALUES
(8, NULL, NULL, NULL, '13131313', '2011-1-1');
";
		$this->db->query( $sql );	
	}

	function tearDown(){
		
		$this->create->drop( 'user' );
		$this->create->drop( 'user_profile' );
		$this->create->drop( 'user_judge_statistics' );
	}

	//测试用户注册操作
	function test_do_reg(){

		//mike 用户输入
		$_POST = array( 'username'=>'tet' , 'password'=>'test' , 'nick'=>'test' );
	 	 
		$request = new request( 'post' );
		$user_reg_process = new user_reg_process( $this->db , $request );

		//断言该用户没有被注册
		$res = $user_reg_process->is_reg();
	 	$this->assertFalse( $res );

		//断言do_reg返回结果为true
		$res = $user_reg_process->do_reg();
		$this->assertTrue( $res );

		//断言数据库中有相应的记录
		$db_obj_user_check = new db_obj_user( $this->db );
		$db_obj_user_profile_check = new db_obj_user_profile( $this->db );
		$db_obj_user_check->load( 'username' , $request->get( 'username' ) );
		$this->assertEqual( $db_obj_user_check->get( 'username' ) , $request->get( 'username' ) );
		$this->assertEqual( $db_obj_user_check->get( 'password' ) , md5( $request->get( 'password' ) ) );

		//断言存在user_profile表中的相应记录
		$id = $db_obj_user_check->get( 'id' );
		$res = $db_obj_user_profile_check->load( 'id' , $id );
		$this->assertTrue( $res );

		//断言用户已经注册
		$res = $user_reg_process->is_reg();
	 	$this->assertTrue( $res );
	}
}

$test = new test_class_user_reg_process();
$test->run( new HtmlReporter() );

