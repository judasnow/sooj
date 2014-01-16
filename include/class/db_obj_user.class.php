<?php
/**
 * 定义user表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_user extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'user' , 'id' );

		//用户名
		$this->add('username' , '' );
	 	//用户密码
		$this->add('password' , '' );
		//最后一次登录的时间
		$this->add('last_login_time','' );
		//最后一次登录的ip地址
		$this->add('last_login_ipadd' , '' );
	}

	/**
	 * 验证该用户名是是否唯一
	 * 即是否该用户名已经被注册
	 * 
	 * @return bool
	 */
	public function is_reg( $request ){
		 
	 	 $username = $request->get( 'username' );
		 $sql = "SELECT * 
			 FROM `user` 
			 WHERE `username`='$username'";
		 $res = $this->db->query( $sql );

		 if( $res->numRows() != 0  ){
		 	 
			 //该用户名已经被注册
		 	 return true;
		 }else{

		 	 //该用户名木有被注册还
		 	 return false;
		 }
	}	
}
