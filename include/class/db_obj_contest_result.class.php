<?php  
/**
 * 处理contest_result表
 *
 * @author <judasnoe@gmail.com> 
 */
require_once( 'db_obj.class.php' );

class db_obj_contest_result extends db_obj{

	function __construct( $db , $contest_id , $user_id , $problem_no ){

	 	$this->contest_id = $contest_id;
		$this->user_id = $user_id;
		$this->problem_no = $problem_no; 

		parent::__construct( $db , 'contest_result' , '' );

		$this->add( 'contest_id' , '');   
		$this->add( 'user_id' , '');                
		$this->add( 'problem_no' , '' );     
		$this->add( 'status' , '' );      
		$this->add( 'penalty' , '' );
     		$this->add( 'code_no' , '' );       		
	} 

	 
	//增加指定的惩罚值
	public function plus_penalty( $value=20 ){
	
		//$this->load();
		//@todo 首次penalty 为空时要报错..
		$penalty = @$this->get( 'penalty' );
		return $this->update( 'penalty' , $penalty + $value );
	}

	public function update( $key , $value ){
	
		$sql = "UPDATE `contest_result` 
			SET `$key`='$value'
			WHERE `contest_id`='$this->contest_id' and `problem_no`='$this->problem_no' and `user_id`='$this->user_id'"; 
		
		$res = $this->db->query( $sql );
		if ( PEAR::isError( $res ) ){

	 	 	 throw new DatabaseException( '更新竞赛结果信息出错'.$res->getMessage() );
		}
	 	
		return true;
	}

	//在结果表中初始化一条记录
	public function insert(){

		$sql = "INSERT INTO `contest_result`
			SET `user_id`='$this->user_id' , `contest_id`='$this->contest_id' , `problem_no`='$this->problem_no'";
		
		$res = $this->db->query( $sql );
		if ( PEAR::isError( $res ) ){

	 	 	 throw new DatabaseException( '获得用户竞赛试题结果出错'.$res->getMessage() );
		}
	 	
		return true;
	}

	//得到当前试题在本次比赛中本次用户的状态
	public function load(){
	
		$sql = "SELECT `status` , `penalty`
			FROM `contest_result`
			WHERE `contest_id`='$this->contest_id' and `problem_no`='$this->problem_no' and `user_id`='$this->user_id'";

		$res = $this->db->query( $sql );
		if ( PEAR::isError( $res ) ){

	 	 	 throw new DatabaseException( '获得用户竞赛试题结果出错'.$res->getMessage() );
		}
		if( $res->NumRows() == 1 ){

			$row = $res->fetchRow( MDB2_FETCHMODE_ASSOC );	
			$this->set( 'status' , $row['status'] );
			$this->set( 'penalty' , $row['penalty'] );
		}else{
			 
			//数据库还没有相应的记录
			$this->insert();
			return false;
		}
		
		return false;
	}
} 

