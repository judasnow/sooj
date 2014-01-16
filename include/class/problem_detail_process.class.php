<?php
/**
 * 处理题目统计信息
 * 
 * @author <judasnow@gmail.com>
 */
class problem_detail_process{

	 private $db;
	 private $db_obj_problem_detail;

	 function __construct( $db ){
	 
		 $this->db = $db;
	 	 $this->db_obj_problem_detail = new db_obj_problem_detail( $db );
	 }

	 function load_by_problem_no( $problem_no ){
	 
	 	 return $this->db_obj_problem_detail->load( 'problem_no' , $problem_no );
	 }

	 function plus_count( $key ){
	 
	 	 return $this->db_obj_problem_detail->plus( $key );
	 }

}
