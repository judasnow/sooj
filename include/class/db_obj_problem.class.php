<?php
/**
 * 定义problem表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_problem extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'problem' , 'no' );

		//题号
		$this->add( 'no' , '' );
	 	//题目标题
		$this->add( 'title' , '' );
		$this->add( 'content' , '' );
		$this->add( 'input' , '' );
		$this->add( 'out_put' , '' );
		$this->add( 'sample_input' , '' );
		$this->add( 'sample_output' , '' );
		$this->add( 'tip' , '' );
		$this->add( 'source' , '' );
		$this->add( 'time_limit' , '' );
		$this->add( 'memory_limit' , '' );
	 	$this->add( 'best_user' , '' );
	}
}

