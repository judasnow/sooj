<?php
/**
 * 定义 user_judge_statistics 表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_user_judge_statistics extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'user_judge_statistics' , 'user_id' );

		$this->add( 'user_id' , '' );
		$this->add( 'sb_count' , '' );
		$this->add( 'ac_sount' , '' );
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

