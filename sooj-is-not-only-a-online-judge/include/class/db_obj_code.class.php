<?php
/**
 * 定义code表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_code extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'code' , 'no' );
	 	 	
		$this->add( 'no' , '' );
		$this->add( 'problem_no' , '' );
		$this->add( 'user_id' , '' );
		$this->add( 'language' , '' );
		$this->add( 'last_modify' , '' );
		$this->add( 'create_time' , '' );
		$this->add( 'content' , '' );
	}

	//取得刚插入代码的no
	public function get_last_code_no(){

	 	$user_id = $this->properties['user_id']['v'];
		$last_modify = $this->properties['last_modify']['v'];
		$problem_no = $this->properties['problem_no']['v'];
		$sql = "SELECT no FROM code 
			WHERE user_id = $user_id and last_modify = '$last_modify' and problem_no = $problem_no";

		$res = $this->db->query( $sql );
		
		if( PEAR::isError( $res ) ){
		
			throw new DatabaseException( "获取代码no错误:数据库查询异常:$sql:".$res->getMessage() );
		}
		$rows = $res->fetchRow( MDB2_FETCHMODE_ASSOC );
		//判断行数只能唯一
	 	return $rows['no'];	
	}
	
	//从数据库中得到测试用例
	function get_test_case(){

		 $problem_no = $this->properties['problem_no']['v'];
		 $sql = "SELECT * FROM `problem_test_case` WHERE `problem_no` = $problem_no";
		 $res = $this->db->query( $sql );

		 if( PEAR::isError( $res ) ){
		
			throw new DatabaseException( "获取测试用例错误:数据库查询异常:$sql:".$res->getMessage() );
		 }
		 $rows = $res->fetchAll( MDB2_FETCHMODE_ASSOC );
		 //@todo 判断测试用例不能少于3个
		 return $rows;
	}
}
