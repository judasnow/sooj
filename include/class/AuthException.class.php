<?php
require_once( 'Log.php' );
class AuthException extends Exception{

	protected $auth_exception_message;

	function __construct( $message = null , $code = 0 ){

		parent::__construct( $message , $code );
		$this->auth_exception_message = $message;
		$this->log();
	}

	function log(){
	
		$db_log_file = Log::factory( 'file', '../../log/auth_exception.log' );
	 	$db_log_file->log( $this->__toString() . '[from ipadd]' . $_SERVER['REMOTE_ADDR'] );
	}
}
