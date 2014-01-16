<?php
/**
 * 定义 contest_reg 表
 * 即竞赛用户报名表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_contest_reg extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'contest_reg' , '' );

		$this->add( 'contest_id' , '' );
		$this->add( 'user_id' , '' );
		$this->add( 'auth_code','' );
		$this->add( 'reg_time' , '' );
	}

	//开始没有考虑到load()函数需要多个参数的弊端。。
	public function load( $contest_id , $user_id ){
	
		$sql = "SELECT *
			FROM `contest_reg`
			WHERE `contest_id` = '$contest_id' and `user_id`='$user_id'";

		$res = $this->db->query( $sql );
		if ( PEAR::isError( $res ) ){

	 	 	 throw new DatabaseException( '获得用户竞赛信息出错'.$res->getMessage() );
		}
		if( $res->NumRows() == 1 ){

			$row = $res->fetchAll( MDB2_FETCHMODE_ASSOC );
			$this->set( 'contest_id' , $contest_id );
			$this->set( 'user_id' , $user_id );
		        $this->set( 'auth_code' , $row[0]['auth_code'] );
			$this->set( 'reg_time' , $row[0]['reg_time'] );	
		}
	 	 
		//用户没有注册参加该比赛
		return false;
	}
}
