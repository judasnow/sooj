<?php
/**
 * 数据库连接函数
 *
 * 从配置文件中读取数据库信息并据此建立一个mysqli的
 * 对象实例，并返回之。
 *
 * @return MDB2 $db 
 * @author 纹身特湿 <judasnow@gmail.com>
 */
require_once( 'MDB2.php' );
require_once( SOOJ_ROOT.'/include/function/get_config.function.php' ); 

function db_connect(){

	$config = get_config( 'db' );

	$user = $config['username'];
	$password = $config['password'];
	$host = $config['host'];
	$name = $config['name'];
	$dbms = $config['dbms'];
	 
	$dsn = "$dbms://$user:$password@$host/$name";
	$options = array(
		'debug' => 2 ,
		'result_buffering' => true ,
	);

	$db =& MDB2::factory( $dsn , $options );
	if ( PEAR::isError( $db ) ) {

		throw new RuntimeException( '数据库连接错误:' . $db->getMessage() );
	}
	 
	//mysql设置 utf8 编码 
	$db->query( "set names utf8" );
	$db->query("set character_set_client=utf8");
	$db->query("set character_set_result=utf8");
	
	//为了增加效率，暂时不使用MDB2连接数据库
	//$db = new mysqli( $host , $user , $password , $name );

	return $db;
}

