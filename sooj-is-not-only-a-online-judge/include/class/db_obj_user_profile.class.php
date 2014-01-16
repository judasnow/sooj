<?php
/**
 * 定义user profile表
 *
 * @author <judasnow@gmail.com>
 */
class db_obj_user_profile extends db_obj{

	public function __construct( $db ){
		
		parent::__construct( $db , 'user_profile' , 'id' );

		//用户编号
		$this->add( 'id' , '' );
	 	//用户昵称
		$this->add( 'nick' , '' );
		//头像地址
		$this->add( 'head_img' , '' );
		$this->add('email' , '');
		//用户个性签名
		$this->add('motto
			','' );
		//用户注册时间
		$this->add('signup_time' , '' );
	}
}

