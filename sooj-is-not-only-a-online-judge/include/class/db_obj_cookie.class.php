<?php
/**
 * 定义user表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_cookie extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'cookie' , 'cookie_hash' );

		$this->add( 'cookie_hash' , '' );
		$this->add( 'user_id' , '' );
		$this->add( 'expire' , '' );
	}
}
