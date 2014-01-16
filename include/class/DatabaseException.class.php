<?php
/**
 * 自定义的数据库异常
 * 
 * 捕获异常的同时,会将异常信息写入日志文件中
 *
 * @author <judasnow@gmail.com>
 */
require_once( 'Log.php' );
class DatabaseException extends Exception{

	protected $db_exception_message;

	function __construct( $message = null , $code = 0 ){

		parent::__construct( $message , $code );
		$this->db_exception_message = $message;
		$this->log();
	}

	protected function log(){

		 $db_log_file = Log::factory( 'file', '../../log/db_exception.log' );
		 $db_log_file->log( $this->__toString() );
	}
}
