<?php
/**
 * 测试类 user auth process 
 *
 * @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

session::start();

class test_class_user_auth_process extends UnitTestCase{

	private $db;


	function setUp(){

		$this->db = new db();

	 	$this->create = new create_table();
		$this->create->create( "user" );
		$this->create->create( "cookie" );
		$this->create->create( 'user_profile' );

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
		$this->create->drop( 'cookie' );
		$this->create->drop( 'user_profile' );
	}

	//测试用户登出
	function test_user_login_logout(){

		//先保证成功登录
		$_POST = array( 'username'=>'test' , 'password'=>'test' );
		$request = new request( 'post' );
		$user_auth_process = new user_auth_process( $this->db , $request );

		//断言成功登录
		$res = $user_auth_process->do_login();
		$this->assertTrue( $res );

		//断言成功登出
		$res = user_auth_process::do_logout();
		$this->assertTrue( $res );

		$this->assertFalse( $user_auth_process->has_login( $this->db ) );
	}
}

$test = new test_class_user_auth_process();
$test->run( new HtmlReporter() );


