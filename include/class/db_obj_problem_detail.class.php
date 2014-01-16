<?php
/**
 * 定义problem_detail表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_problem_detail extends db_obj{
	 
	public function __construct( $db ){
	
		parent::__construct( $db , 'problem_detail' , 'problem_no' );
		$this->add( 'sb_count' , '' );
		$this->add( 'ac_count' , '' );
		$this->add( 'wa_count' , '' );
		$this->add( 'tle_count' , '' );
		$this->add( 'mel_count' , '' );
		$this->add( 're_count' , '' );
		$this->add( 'ole_count' , '' );
		$this->add( 'ce_count' , '' );
		$this->add( 'se_count' , '' );
		$this->add( 've_count' , '' );
		$this->add( 'pe_count' , '' );
	}
	 
}
