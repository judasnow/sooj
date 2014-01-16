<?php
class db_obj_judge_result extends db_obj{
	 

	public function __construct( $db ){
		
		parent::__construct( $db , 'judge_result' , 'no' );
	 	 
		$this->add( 'no' , '' );
		$this->add( 'user_id' , '' );
		$this->add( 'problem_no' , '' );
		$this->add( 'result' , '' );
		$this->add( 'memory' , '' );
	 	$this->add( 'time' , '' );
		$this->add( 'language' , '' );
		$this->add( 'code_length' , '' );
		$this->add( 'judge_time' , '' );
	}
}
