<?php
//仅仅用于封装SESSION相关的
//方法，使用时不进行实例化
class session{

 	 //禁止进行实例化
	private function __construct(){}
		
	static function start(){

		if( !isset( $_SESSION ) ){
	 	 
			session_start();	 
		}
	}

	static function destroy(){

		session_destroy();
	}

	static function set( $key , $value ){

		$_SESSION[$key] = $value;
		return true;
	}

	static function get( $key ){

		if( isset( $_SESSION[$key] )) {

			return $_SESSION[$key];
		}else{

			//@todo
			//此处是否需要进行异常处理?
			//throw new Exception( '会话变量'.$key.'不存在.' );
			return false;
		}
	}

	static function clear( $key ){

		unset( $_SESSION[$key] );
		return true;
	}
}

