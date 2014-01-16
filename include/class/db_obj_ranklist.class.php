<?php
/**
 * 用户排名 ranklist 表
 *
 * @todo
 * @author <judasnow@gmail.com>
 */
class db_obj_ranklist extends db_obj{

	public function __construct( $db ){

		parent::__construct( $db , 'ranklist' , 'rank' );
		
		$this->add('username' , '' );
		$this->add('rank' , '' );
	}	
}
