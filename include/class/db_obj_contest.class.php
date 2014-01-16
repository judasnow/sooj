<?php  
/**
 * 处理contest表
 *
 * @author <judasnoe@gmail.com> 
 */
require_once('db_obj.class.php');

class db_obj_contest extends db_obj{

	function __construct( $db ){

		parent::__construct( $db , 'contest' , 'id' );

		$this->add('no' , '');   
		$this->add('title' , '');                
		$this->add('start_time' , '' );     
		$this->add('end_time' , '' );      
		$this->add('summary','' );              
		$this->add('status','');        
	}    
} 
?>
