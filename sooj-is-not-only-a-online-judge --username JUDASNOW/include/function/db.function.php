<?php
require_once 'MDB2.php';
/**
 * 数据库连接函数 
 *
 * 从配置文件中读取数据库信息并据此建立一个MDB2的
 * 对象实例，并返回之。
 *
 * @return MDB2 $db
 * @author 纹身特湿 <judasnow@gmail.com>
 */
function db_connect(){

	/**
	 *调用get_config()函数读取配置信息
	 *并返回到$config数组中。
	 */

	//$config = get_config(); 

	$user    = $config['user'] = 'test';
	$passwd  = $config['passwd'] = 'test';
	$host    = $config['host'] = 'localhost';
	$db_name = $config['db_name'] = 'soj';
	$options = $config['option'] = array( 'debug' => 2,'result_buffering' => true );

	$dsn = "mysql://$user:$passwd@$host/$db_name";
	 
	$db =& MDB2::factory($dsn, $options);

	if (PEAR::isError($db)) {

    		throw new Exception ($db->getMessage());
	}else{

		return $db ;
	}
}
?>
