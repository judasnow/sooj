<?php
/**
 * 处理竞赛有关的请求
 *
 * @author <judasnow@gmail.com>
 */
class contest_process{

	 private $db;
	 private $db_obj_contest;

	 function __construct( $db ){
	 
		 $this->db = $db;
		 $this->db_obj_contest = new db_obj_contest( $db );
	 }

	 //按竞赛号查找试题
	 function get_contest_problem( $id ){

		 $sql = "SELECT `contest_problem`.`sorter` , `contest_problem`.`problem_no` , `problem`.`title` 
			 FROM `contest_problem`,`problem`
			 WHERE `contest_id` = $id 
			 AND `contest_problem`.`problem_no` = `problem`.`no`";
		 $res = $this->db->query( $sql );
	 	 if ( PEAR::isError( $res ) ) {

	 	 	 throw new DatabaseException( '获得竞赛题目列表出错'.$res->getMessage() );
		 }
		 if( $res->NumRows() >= 1 ){

			 $rows = $res->fetchAll( MDB2_FETCHMODE_ASSOC );
		 }else{
		 	 
			 print "还没有为此竞赛添加试题或竞赛不存在";die;
		 }
		 return $rows;
	 }

	 //@todo 有重复?
	 function load( $id ){
	 	 
	 	 return $this->db_obj_contest->load( 'id' , $id );
	 }

	 function get_start_time(){
	 	 
		 return $this->db_obj_contest->get( 'start_time' );
	 }
	 function get_end_time(){
	 
		 return $this->db_obj_contest->get( 'end_time' );
	 }
	 function get_status(){
	 	 
		 return $this->db_obj_contest->get( 'status' );
	 }
	 function get_title(){
	 	 
		 return $this->db_obj_contest->get( 'title' );
	 }
	 function get_summary(){
	 	 
		 return $this->db_obj_contest->get( 'summary' );
	 }

	 function get_all(){
	 	 
		 $sql = "SELECT `id` , `title` , `status` , `start_time` , `end_time` 
			 FROM contest";
	 	 $res = $this->db->query( $sql );
	 	 if ( PEAR::isError( $res ) ) {

	 	 	 throw new DatabaseException( '获得竞赛列表出错'.$res->getMessage() );
		 }
		 if( $res->NumRows() >= 1 ){

			 $rows = $res->fetchAll( MDB2_FETCHMODE_ASSOC );
		 }else{
		 	 
			 print "没有竞赛";die;
		 }
		 return $rows;
	 }

	 //得到最新的 5 项竞赛，用于首页的小部件
	 static function get_last_contest( $db , $no = 5 ){
	 	 
		 $sql = "SELECT id , title , status  
			 FROM contest
			 ORDER BY id DESC 
			 LIMIT 0 , $no";

		 return $db->query_fetch( $sql );
	 }

}
