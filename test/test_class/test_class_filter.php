<?php
/**
 * 测试过滤函数
 *
 * @author <judasnow@gmail.com> 
 */
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );


class test_class_filter extends UnitTestCase{

	function setUp(){
	}
	function tearDown(){
	}

	function test_is_vaild(){

		$filter = new filter();
		//满足用户名要求的字符串
		$string = "teststring";
		$res = $filter->is_vaild( $string , 'username' );
		$this->assertTrue( $res );
		//非法字符
		$string = "<teststring>";
		$res = $filter->is_vaild( $string , 'username' );
		$this->assertFalse( $res );

		//合法nick名
		$string = "纹身特湿";
		$res = $filter->is_vaild( $string , 'nick' );
		$this->assertTrue( $res );

		//非法nick
		$string = "<托马斯";
		$res = $filter->is_vaild( $string , 'username' );
		$this->assertFalse( $res );

	}

	function test_do_filter(){

		$filter = new filter();
	 	//标签已经被转化
		$_POST['username'] = "<b>test</b>";
		$res = $filter->do_filter( 'username' , 'string' , $_POST );
		$this->assertTrue( preg_match( '/&#60/' , $res ) );

	}

	function test_do_filter_for_post_content(){
	
		$filter = new filter();
		//指定的标签未被转化
		$_POST['content'] = "<b>test</b><p>123</p><img><code><hr /><br/>";

		$res = $filter->do_filter( 'content' , 'post' , $_POST );
		$this->assertTrue( preg_match( '<p>' , $res ) );
	}

}


$test = new test_class_filter();
$test->run( new HtmlReporter() );




