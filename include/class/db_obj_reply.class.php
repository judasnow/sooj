<?php
/**
 * 定义 reply 表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_reply extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'reply' , 'reply_no' );

		$this->add( 'reply_no' , '' );
		$this->add( 'topic_no' , '' );
		$this->add( 'content' , '' );
		$this->add( 'replyer_id' , '' );
		$this->add( 'replyer_nick' , '' );
		$this->add( 'reply_time' , '' );
		$this->add( 'useful' , '' );
		$this->add( 'unuseful' , '' );
		$this->add( 'status' , '' );
	}
}

