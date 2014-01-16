<?php
class db{

	 private $_db;
	 static $_instance;

	 private function __construct(){

		 $this->_db = @new mysqli( '172.17.0.46' , 'test' , 'test' , 'sooj' );
		 if ( $this->_db->connect_error ) {

    	 	 	 die('Connect Error: ' . $mysqli->connect_error);
		 } 
		 $this->_db->query( "set names utf8" );
		 $this->_db->query( "set character_set_client=utf8" );
		 $this->_db->query( "set character_set_result=utf8" );
	 }

	//实现单例
	public static function get_instance(){

		if( !self::$_instance instanceof self ){
		
			self::$_instance = new self();
		} 
		return self::$_instance;
	}

	public function query( $sql ){
	 
		 $res = $this->_db->query( $sql );
		 if( !$res ){

    	 	 	 die("Errormessage: " . $this->_db->error);		 	 
		 }
		 return $res;
	 }

	 public function autocommit( $flag ){
	
	 	 return $this->_db->autocommit( $flag );
	 }

	 public function rollback(){
	 
	 	 return $this->_db->roolback();
	 }
}
