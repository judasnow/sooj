<?php
/**
 * 数据库类
 * 封装了MDB2，增加了 cache 功能
 *
 * @author <judasnow@gmail.com>
 */
require_once( 'MDB2.php' );
class db{

	 private $mdb2;
	 private $cache;
	 
	 function __construct(){
	 
	 	 $config = app::get_config( 'db' );

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

	 	 $this->mdb2 =& MDB2::factory( $dsn , $options );
		 if ( PEAR::isError( $this->mdb2 ) ) {

		 	 throw new RuntimeException( '数据库连接错误:' . $this->mdb2->getMessage() );
		 }

		 //mysql设置 utf8 编码
		 $this->mdb2->query( "set names utf8" );
		 $this->mdb2->query( "set character_set_client=utf8" );
		 $this->mdb2->query( "set character_set_result=utf8" );
	 }

	 //仅仅进行查询，但是不进行结果数组的获取
	 function query( $sql ){
	 	 
		 $res = $this->mdb2->query( $sql );
	 
		 if ( PEAR::isError( $res ) ){

    	 	 	 throw new DatabaseException( $res->getMessage() );
		 }

		 return $res;
	 }


	 function query_fetch( $sql , $cache = false , $expires = 1 ){
		 
		 if( $cache == true ){
			 
			 //检查缓存是否有效
		 	 $cache = app::init_cache();
			 $sql_hash = hash( 'md4' , $sql );	 	 	 
			 $rows = $cache->get( $sql_hash );

			 //@todo 如何判断其为合法的数据库查询结果集？
			 if( is_array( $rows ) ){

				 //缓存命中
		 	 	 return $rows;
			 }
			 
			 //缓存没有命中
			 //查询数据库，并写入缓存
			 $res = $this->mdb2->query( $sql );
			 //判断查询时是否存在异常
			 if ( PEAR::isError( $res ) ){
	 	 	 	 
				 //@todo 异常信息作为参数可以传入
			 	 throw new RunTimeException( '数据库异常'.$res->getMessage() );
			 }
			 $rows = $this->fetch( $res );
			 $cache->set( $sql_hash , $rows );

		 }else{

		 	 //没有使用缓存
			 $res = $this->mdb2->query( $sql );
			 $rows = $this->fetch( $res );
		 }
	 	 
	 	 return $rows;
	 }

	 function disconnect(){
	 
	 	 return $this->mdb2->disconnect();
	 }

	 function fetch( $res ){
	 
		 //判断是否又反回值
		 if ( $res->NumRows() >= 1 ){
		
			 return $res->fetchAll( MDB2_FETCHMODE_ASSOC );
		 }else{
		
			 return false;	
		 }
	 }

	 function numRows(){
	 
	 	 return $this->mdb2->numRows();
	 }
}

