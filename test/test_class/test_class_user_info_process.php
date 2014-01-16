<?php
/**
 * 测试类 user info process
 *
 * @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

class test_class_user_info_process extends UnitTestCase{

	private $db;

	function setUp(){

		$sql_create_user_profile = "
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(256),
  `head_img` varchar(256),
  `email` varchar(256),
  `motto` varchar(2048),
  `reg_time` varchar(128) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		";
		$sql_create_user = "
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(512) NOT NULL,
  `password` varchar(128) NOT NULL,
  `last_login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_ipadd` varchar(128) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;
		";
		$sql_insert_one_user = "
INSERT INTO `user` (`id`, `username`, `password`, `last_login_time`, `last_login_ipadd`) VALUES
( 8 , 'test', '098f6bcd4621d373cade4e832627b4f6', '2011-03-31 19:54:42', NULL );			
";
		$sql_insert_one_user_profile = "
INSERT INTO  `user_profile` (`id` ,`nick` ,`head_img` ,`email` ,`motto` ,`reg_time`) VALUES 
('8', NULL , NULL , NULL , NULL ,  '2011-1-1');
";

		$this->db = db_connect();
		$this->db->query( $sql_create_user );
		$this->db->query( $sql_create_user_profile );
		$this->db->query( $sql_insert_one_user );
		$this->db->query( $sql_insert_one_user_profile );
	}

	function tearDown(){
		
		$sql_drop_user = "drop table test.user";
		$sql_drop_user_profile = "drop table test.user_profile";

		$this->db->query( $sql_drop_user );
		$this->db->query( $sql_drop_user_profile ); 	
	}

	function test_create_user_info(){

		$user_info_proc = new user_info_process( $this->db , '8' );
		//得到用户名
		$username = $user_info_proc->get_username();
		$this->assertEqual( 'test' , $username );
	}

}

$test = new test_class_user_info_process();
$test->run( new HtmlReporter() );
