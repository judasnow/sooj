<?php
ob_start();
/**
 * 测试类 cookies
 *
 * @author <judasnow@gmail.com> 
 */
setcookie( 'user' , '' );
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

class test_class_cookies extends UnitTestCase{
	
	 private $db;
	 private $create;

	 function setUp(){

		 $db = new db();
		 $this->db = $db;
		 $this->cook = new cookie( $this->db );

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

		 $this->create->drop( "user" );
		 $this->create->drop( "cookie" );
		 $this->create->drop( "user_profile" );
	 }

	 function test_function_enable_auto_login(){

		 $user_id = rand();

		 $res = $this->cook->enable_auto_login( $user_id );
		 $this->assertTrue( $res );

		 //断言数据库中以及用户浏览器中都应有相应的用户信息
		 $res = $this->db->query( "select * from `cookie` where `user_id` = '$user_id'" );
		 $this->assertEqual( $res->numRows() , 1 );

		 //md4 hash 后的为32位字符串
	 	 $this->assertEqual( strlen( $_COOKIE['user_id'] ) , 32 );
	 }

	 function test_function_auto_login(){
	
		 //moke user_id
		 //在数据库生成时插入了id为8的用户
		 $user_id = '8';

		 //断言数据库中存在该用户
		 $res = $this->db->query( "select * from `user` where `id` = '$user_id'" );
		 $this->assertEqual( $res->numRows() , 1 );
	 	 
		 //使能auto login
		 $res = $this->cook->enable_auto_login( $user_id );
		 $this->assertTrue( $res );

		 //断言数据库中以及用户浏览器中都应有相应的用户信息
		 $res = $this->db->query( "select * from `cookie` where `user_id` = '$user_id'" );
		 $this->assertEqual( $res->numRows() , 1 );

		 //md4 hash 后的为32位字符串
		 $this->assertEqual( strlen( $_COOKIE['user_id'] ) , 32 );

		 //调用自动登录
		 $res = $this->cook->auto_login( $user_id );
		 $this->assertTrue( $res );

		 //自动登录成功
		 $this->assertTrue( unserialize( $_SESSION['user'] ) instanceof user_info_process );
	 }

	 function test_disable_auto_login(){
	 
		 //断言自动登录成功
		 //moke user_id
		 //在数据库生成时插入了id为8的用户
		 $user_id = '8';

		 //断言数据库中存在该用户
		 $res = $this->db->query( "select * from `user` where `id` = '$user_id'" );
		 $this->assertEqual( $res->numRows() , 1 );
	 	 
		 //使能auto login
		 $res = $this->cook->enable_auto_login( $user_id );
		 $this->assertTrue( $res );

		 //断言数据库中以及用户浏览器中都应有相应的用户信息
		 $res = $this->db->query( "select * from `cookie` where `user_id` = '$user_id'" );
		 $this->assertEqual( $res->numRows() , 1 );

		 //md4 hash 后的为32位字符串
		 $this->assertEqual( strlen( $_COOKIE['user_id'] ) , 32 );

		 //调用自动登录
		 $res = $this->cook->auto_login( $user_id );
		 $this->assertTrue( $res );

		 //自动登录成功
		 $this->assertTrue( unserialize( $_SESSION['user'] ) instanceof user_info_process );

		 //无效化自动登录
		 $res = $this->cook->disable_auto_login();
		 $this->assertTrue( $res );

		 //调用自动登录
		 $res = $this->cook->auto_login( $user_id );
	 
		 //断言自动登录失败
		 $this->assertFalse( $res );
	 }
}

$test = new test_class_cookies();
$test->run( new HtmlReporter() );

