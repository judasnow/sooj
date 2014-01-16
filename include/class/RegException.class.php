<?php
/**
 * 自定义的注册时异常
 *
 * @author <judasnow@gmail.com>
 */
class RegException extends Exception{

	function __construct( $message = null , $code = 0 ){

		parent::__construct( $message , $code );
	}
}

