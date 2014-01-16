<?php
/**
 * 定义 topic 表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_topic extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'topic' , 'topic_no' );

		$this->add( 'topic_no' , '' );
		$this->add( 'problem_no' , '' );
		$this->add( 'title' , '' );
		$this->add( 'content' , '' );
		$this->add( 'poster_id' , '' );
		$this->add( 'poster_nick' , '' );
		$this->add( 'view_count' , '' );
		$this->add( 'reply_count' , '' );
		$this->add( 'post_time' , '' );
		$this->add( 'hot' , '' );
		$this->add( 'status' , '' );
	}
}

