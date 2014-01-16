<?php  
/**
 * 处理用户竞赛时的各种逻辑
 *
 * @author <judasnoe@gmail.com> 
 */
class contest_result_process{

	private $db;
	private $contest_id;
	private $db_obj_contest_result;

	public function __construct( $db , $contest_id , $user_id=null , $problem_no=null ){
	
		$this->db = $db;
		$this->contest_id = $contest_id;
		$this->user_id = $user_id;
		$this->problem_no = $problem_no;
		$this->db_obj_contest_result = new db_obj_contest_result( $db , $contest_id , $user_id , $problem_no );
	}

	public function get( $key ){
	
		return $this->db_obj_contest_result->get( $key );
	}

	public function load(){
	
	 	return $this->db_obj_contest_result->load();	
	}

	public function plus_penalty( $value ){
	
		 return $this->db_obj_contest_result->plus_penalty( $value );
	}

	//得到当前用户对于当前比赛的结果
	//列表
	static public function get_result_list( $db , $contest_id , $user_id=null ){

		 //如果没有设置用户名则返回该竞赛的所有
		 //用户结果
	 	 if( !$user_id ){
		 
		 	 $where = "`contest_id`='$contest_id'";
		 }else{
		 
		 	 $where = "`user_id`='$user_id' and `contest_id`='$contest_id'";
		 }

		 $sql = "SELECT `problem_no` , `status` , `penalty`  
			 FROM `contest_result`
			 WHERE $where";

		 $res = $db->query( $sql );

		 if ( PEAR::isError( $res ) ){

	 	 	 throw new DatabaseException( '获得用户竞赛结果出错'.$res->getMessage() );
		 }
		 if( $res->NumRows() >= 1 ){

			 return $res->fetchAll( MDB2_FETCHMODE_ASSOC );	
		 }else{
			
			 return false;
		 }
	}

	public function get_contest_problem_list(){
	
		$sql = "SELECT  `problem_no`
			FROM `contest_problem`
			WHERE `contest_id`='$this->contest_id'";

		$res = $this->db->query( $sql );
		return $res->fetchaLL( MDB2_FETCHMODE_ASSOC ); 
	}
	 
	//得到竞赛的最终排行 
	public function get_result_list_final(){

		//判断竞赛是否已经结束

		//得到用户排名及其依据 
		$sql = "SELECT `user_id` , count( `status` ) as `slove_sum` , sum(`penalty`) as `penalty_sum` 
			FROM `contest_result` 
			WHERE `contest_id`='$this->contest_id' and `status`='slove' group by `user_id`
			ORDER BY `slove_sum` DESC, `penalty_sum` ASC";

		$res = $this->db->query( $sql );
		return $res->fetchAll( MDB2_FETCHMODE_ASSOC );
	}

	//得到用户解题的了具体情况
	public function get_result_detail(){
	
		$sql = "SELECT `user_id` , `problem_no` , `status` , `penalty` , `code_no` 
		       	FROM `contest_result`
			WHERE `contest_id`='$this->contest_id'";

		$res = $this->db->query( $sql );
		return $res->fetchAll( MDB2_FETCHMODE_ASSOC );
	}
	
	function update( $key , $value ){
	
		return $this->db_obj_contest_result->update( $key , $value );
	}
}

