<?php
/**
 * 定义对于评测结果的显示
 *
 * @author <judasnow@gmail.com>
 */
class judge_result_process{
	 
	 /**
	  * 数据库连接
	  * 
	  * @var object $db 
	  */
	 private $db;
	 /**
	  * 评测结果数据库操作类
	  * 
	  * @var object $db_obj_judge_result
	  */
	 private $db_obj_judge_result;

	 //用户评测结果统计
	 private $user_judge_statistics_proc;

	 private $problem_detail_proc;

	 function __construct( $db ){
	 
	 	 $this->db = $db;
		 $this->db_obj_judge_result = new db_obj_judge_result( $db );

		 //用户提交统计信息
		 $this->user_judge_stat_proc = new user_judge_statistics_process( $db );
		 //题目被提交统计信息
		 $this->problem_detail_proc = new problem_detail_process( $db );
	 }
	 
	 /**
	  * 得到所有的评测结果
	  * 用于在专门的页面列表显示之
	  * 
	  * @return array 
	  */
	 function get_all(){
	 	 
		 //使用联合查询的效率 - -!!!
		 $sql = "SELECT  `judge_result`.`no` , `user_profile`.`nick` , `judge_result`.`problem_no` , 
			 	 `judge_result`.`result` , `judge_result`.`memory` , `judge_result`.`time` ,
				 `judge_result`.`language` , `judge_result`.`code_length` , `judge_result`.`judge_time`
			 FROM `user_profile` , `judge_result` 
			 WHERE `user_profile`.`id` = `judge_result`.`user_id` 
			 ORDER BY `judge_result`.`no` DESC";

		 $res = $this->db->query( $sql );
	 	 
		 if ( PEAR::isError( $res ) ){

			 throw new DatabaseException( '获得评测结果列表出错'.$res->getMessage() );
		 }

		 return $res->fetchAll( MDB2_FETCHMODE_ASSOC );
	 }
	 
	 /**
	  * 评测结果存储到数据库中，并更新用户评测统计数据
	  * 
	  * @todo 放入 gearman 后台处理之
	  *
	  * @param json $result_info 评测结果，json格式的数组
	  * @return bool 如果存储进数据库成功返回 true 否则返回 false
	  */
	 function insert( $res_info ){

		 $user_id = $res_info['user_id'];
		 $problem_no = $res_info['problem_no'];
	 	 
		 //读取题目提交统计
		 $this->problem_detail_proc->load_by_problem_no( $problem_no );

		 //读取相应用户的统计记录
		 $this->user_judge_stat_proc->load_by_user_id( $user_id );

		 //根据评测结果更新相应的统计记录
		 $result = $res_info['res'];
		 $this->user_judge_stat_proc->plus_count( $result );
		 $this->problem_detail_proc->plus_count( $result );

		 //根据统计数据更新用户排名信息
		 ranklist_process::update_ranklist( $this->db );

		 $this->db_obj_judge_result->set( 'language' , $res_info['lang'] );
		 $this->db_obj_judge_result->set( 'user_id' , $user_id );
	 	 $this->db_obj_judge_result->set( 'result' , $result );
		 $this->db_obj_judge_result->set( 'problem_no' , $problem_no );
		 $this->db_obj_judge_result->set( 'time' , @$res_info['run_time'] );
		 $this->db_obj_judge_result->set( 'memory' , @$res_info['mem_peak'] );
		 $this->db_obj_judge_result->set( 'code_length' , @$res_info['length'] );

		 return $this->db_obj_judge_result->save();
	 }

	 /**
	  * 得到最新的评测结果
	  *
	  * @param string $require_time 请求时间
	  * @return 生成时间晚于require_time的评测结果数组
	  */
	 function get_new( $max_no , $require_time ){
	 
		 $sql = "SELECT * 
			 FROM judge_result 
			 WHERE `judge_time` > '$require_time' and `no` > '$max_no'
			 ORDER BY `no` DESC";

		 $res = $this->db->query( $sql );

		 if ( PEAR::isError( $res ) ) {

			 throw new DatabaseException( '获得评测结果列表出错'.$res->getMessage() );
		 }

		 return $res->fetchAll( MDB2_FETCHMODE_ASSOC );
	 }
}

