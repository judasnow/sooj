<?php
/**
 * 统计用户评测数据
 *
 * @author <judasnow@gmail.com>
 */
class user_judge_statistics_process{

	 private $db;
	 private $db_obj_user_judge_statistics;

	 function __construct( $db ){
	 
		 $this->db = $db;
		 $this->db_obj_user_judge_statistics = new db_obj_user_judge_statistics( $db );
	 }

	 /**
	  * 在 user_judge_statistics_process 表中插入
	  * 新注册用户相应的记录
	  *
	  * @param $db 数据库连接
	  * @param int $user_id 新注册用户的id 
 	  */
	 static function create_row( $db , $user_id ){

		 $sql = "INSERT INTO `user_judge_statistics` 
			 SET `user_id` = $user_id ";
		 $res = $db->query( $sql );

		 if ( PEAR::isError( $res ) ) {

			 throw new DatabaseException( '插入新用户记录到 user_judge_statistics_process 表时出错'.$res->getMessage() );
		 }

		 return true;
	 }

	 function load_by_user_id( $user_id ){
	 
	 	 return $this->db_obj_user_judge_statistics->load( 'user_id' , $user_id );
	 }
	 
	 //设置新的统计数值 
	 function plus_count( $key ){
	 	
	 	 return $this->db_obj_user_judge_statistics->plus( $key );
	 } 
}
