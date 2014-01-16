<?php
/**
 * 处理竞赛有关的请求
 *
 * @author <judasnow@gmail.com>
 */
class contest_process{

	/**
	 * @var $db 数据库连接对象
	 */
	private $db;
	/**
	 * @var $db_obj_contest contest 表操作对象
	 */
	private $db_obj_contest;
	/**
	 * @var $db_obj_contest_reg contest_reg 表操作对象
	 */
	private $db_obj_contest_reg;
	/**
	 * @param $id contest_id 
	 * @param $db 数据库连接
	 */
	function __construct( $db , $id ){

		 //传入用户想要查看的
		 $this->id = $id;
		 $this->db = $db;
		 $this->db_obj_contest = new db_obj_contest( $db );
		 $this->db_obj_contest_reg = new db_obj_contest_reg( $db );
	}
	 
	/**
	 * 按竞赛号查找试题
	 * 用于列出所有该竞赛相关的试题
	 * 
	 * @param $id 竞赛ID
	 * @return array $rows 满足条件的试题数组
	 */
	function get_contest_problem(){

		 $sql = "SELECT `contest_problem`.`sorter` , `contest_problem`.`problem_no` , `problem`.`title` 
			 FROM `contest_problem`,`problem`
			 WHERE `contest_id` = '$this->id' 
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

	 /**
	  * 得到所有的竞赛列表
	  *
	  * @return array $rows 竞赛列表
	  */
	 static function get_all( $db ){
	 	 
		 $sql = "SELECT `id` , `title` , `status` , `start_time` , `end_time` 
			 FROM contest";
		 $res = $db->query( $sql );

	 	 if ( PEAR::isError( $res ) ){

	 	 	 throw new DatabaseException( '获得竞赛列表出错'.$res->getMessage() );
		 }
		 if( $res->NumRows() >= 1 ){

			 $rows = $res->fetchAll( MDB2_FETCHMODE_ASSOC );
		 }else{
		 	 
			 print "没有竞赛";die;
		 }
		 return $rows;
	 }

	 //用户注册参加这个比赛
	 public function user_reg( $user_id ){

		 //判断用户是否已经登录参加本次
		 //比赛
		 if( $this->is_user_reg( $user_id ) ){
	 	 	 
			 //返回给 do_reg_contest 页面指
			 //该用户已经参加了本次比赛
		 	 return false;
		 }

		 //向 contest_reg 表中插入一条记录便可
		 $this->db_obj_contest_reg->set( 'contest_id' , $this->id );
		 $this->db_obj_contest_reg->set( 'user_id' , $user_id );
		 //生成唯一的用户登录竞赛凭证
		 $this->db_obj_contest_reg->set( 'auth_code' , substr( hash( 'md4' , time().$user_id.rand() ) , -6 ) );

		 return $this->db_obj_contest_reg->save();
	 }

	 /**
	  * 判断用户是否已经注册本次竞赛
	  *
	  * @param $user_id 用户id
	  * @return bool 
	  */
	 public function is_user_reg( $user_id ){

		 if( empty( $user_id ) ){
		 
		 	 return false;
		 }
	 	 
		 //初始化contest_reg对象
		 $this->db_obj_contest_reg->load( $this->id , $user_id );

		 //按照用户id在contest_reg表中进行查找
		 //以此判断用户
		 $sql = "SELECT *
			 FROM `contest_reg`
			 WHERE `user_id`='$user_id' and `contest_id`='$this->id'";

		 $res = $this->db->query( $sql );
		 if ( $res->NumRows() == 1 ){
	 	 	 
			 return true;
		 }

		 return false;
	 }

	 /**
	  * 是用户退出参加本次比赛
	  *
	  * @param $user_id 用户id
	  * @return bool 
	  */
	 public function undo_user_reg( $user_id ){
	 	 
		 //不便用db_obj处理
		 $sql = "DELETE 
			 FROM `contest_reg`
			 WHERE `user_id`='$user_id' and `contest_id`='$this->id'";

		 return $this->db->query( $sql );
	 }
	 
	 //@todo 有重复?
	 function load( $id ){
	 	 
	 	 return $this->db_obj_contest->load( 'id' , $id );
	 }
	 function get_id(){
	 
		 return $this->db_obj_contest->get( 'id' );
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
	 public function get_title(){
	 	 
		 return $this->db_obj_contest->get( 'title' );
	 }
	 public function get_summary(){
	 	 
		 return $this->db_obj_contest->get( 'summary' );
	 }
	 public function get_auth_code(){
	 	 
	 	 return $this->db_obj_contest_reg->get( 'auth_code' );
	 }
	 /**
	  * 得到最新的 5 项竞赛，用于首页的小部件
	  *
	  * @return array $rows 
	  */
	 static function get_last_contest( $db , $no = 5 ){
	 	 
		 $sql = "SELECT `id` , `title` , `status`
			 FROM `contest`
			 ORDER BY `id` DESC
			 LIMIT 0 , $no";

		 return $db->query_fetch( $sql );
	 }
	 

}
