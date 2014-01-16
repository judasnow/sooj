<?php
/**
 * 定义系统中有关 cookies 的操作
 * 
 * @author <judasnow@gmail.com>
 */
class cookie{
	 
	/**
	 * 数据库连接类
	 *
	 * @var object db 
	 */
	private $db;
	
	/**
	 * cookie对应的数据库操作类
	 *
	 * @var object 
	 */
	private $db_obj_cookie;

	/**
	 * user表对应的数据库操作类
	 *
	 * @var object 
	 */
        private $db_obj_user;

	function __construct( $db ){

		$this->db = $db;
		$this->db_obj_cookie = new db_obj_cookie( $db );
		$this->db_obj_user = new db_obj_user( $db );
	}

	/**
	 * 设置用户的cookie
	 * 以实现用户的自动登录
	 *
	 * @param int $user_id 用户在系统中的唯一编号
	 * @return bool
	 */
	function enable_auto_login( $user_id ){
	 	
		//使用用户请求时间和用户名作为键生成hash值
		$cookie_hash = hash( 'MD4' , $_SERVER['REQUEST_TIME'].$user_id );

		//保存hash到客户端(cookies)
		if( !defined( "TEST" ) ){
			 
			 //非测试状态下
			 $res = setcookie( 'user_id' , $cookie_hash , $_SERVER['REQUEST_TIME']+2419300 , '/sooj/controller/' );	 
		}else{
	 	 	 //moke cookies的设置		
			 $res = $_COOKIE['user_id'] = $cookie_hash;
		}

		//保存到数据库中
		//判断是否数据库中已经有相应用户的cookies
	 	if( $this->db_obj_cookie->load( 'user_id' , $user_id ) ){

		 	 //数据库中已经有相应用户的记录		
			 $this->db_obj_cookie->set( 'cookie_hash' , $cookie_hash );
			 $this->db_obj_cookie->set( 'expire' , $_SERVER['REQUEST_TIME']+2419300 );
			 $res = $this->db_obj_cookie->save() && $res;
		}else{

			 //数据库中没有相应的用户的记录
			 $this->db_obj_cookie->set( 'cookie_hash' , $cookie_hash );
			 $this->db_obj_cookie->set( 'user_id' , $user_id );
			 $this->db_obj_cookie->set( 'expire' , $_SERVER['REQUEST_TIME']+2419300 );
			 $res = $this->db_obj_cookie->save() && $res;
		}

		return $res;
	}

	/**
	 * 测试用户是否已经使用cookie功能自动登录
	 * 如果已经设置，则登录之(必须cookie和数据库中均有相应的记录)
	 * 并返回 $user_info_process 对象
	 *
	 * @return object $user_info_process
	 */
	function auto_login(){
	 
		//如果cookie中的user变量已经设置
		//但仅仅证明用户端的信息已经设置
		if( !empty( $_COOKIE['user_id'] ) ){
	 	 	
			//读取数据库中的相应信息
			if( $this->db_obj_cookie->load( 'cookie_hash' , $_COOKIE['user_id'] ) ){
	 	
				//数据库中有相应的记录
				//证明自动登录功能可用
				$user_id = $this->db_obj_cookie->get( 'user_id' );
	 	 	 
				//测试是否到期,避免用户更改
				if ( $this->db_obj_cookie->get( 'expire' ) <= $_SERVER['REQUEST_TIME'] ){

					 //cookie已经过期
					 $this->disable_auto_login();
					 return false;
				}
	 	 	 
				$this->db_obj_user->load( 'id' , $user_id );
				$this->db_obj_user->set( 'last_login_time' , date( "Y-m-d H:i:s",time()+8*60*60 ) );
				$this->db_obj_user->set( 'last_login_ipadd' , $_SERVER['REMOTE_ADDR'] );
				$this->db_obj_user->save();

				$user_info_process = new user_info_process( $this->db , $user_id );
				session::set( 'user' , serialize( $user_info_process ) );
	 	 	 	
			 	return $user_info_process;
	 	 	 }else{
	 	 	 	 
				 if( defined( "TEST" ) ){
					 echo "db_error";
				 }
				 //数据库中没有相应用户的信息
				 //自动登录功能不可用
				 return false;
			 }
		}else{
	 	 	
			if( defined( "TEST" ) ){
				
				echo "cookie error";
			}
			return false;
		}
	}

	/**
	 * 删除cookie，删除数据库中有关信息
	 * disable自动登录
	 *
	 * @return bool 
	 */
	function disable_auto_login(){
	 	 
	 	 //判断是否设置了自动登录
	 	 if( isset( $_COOKIE['user_id'] ) ){
	 	 	
			 $cookie_hash = $_COOKIE['user_id'];

			 //删除数据库中相应的记录
			 //不可先删除cookie 否则数据库中的相应记录便
			 //不可得了( cookie_hash 丢失 )
			 $this->db_obj_cookie->delete( 'cookie_hash' , $cookie_hash );
	 	 	 
			 //无效化cookies
			 if( defined( 'TEST' ) && TEST ){

				 $_COOKIE['user_id'] = '';  
	 	 	 }else{	 
				 
			 	 setcookie( 'user_id' , '' , $_SERVER['REQUEST_TIME']-3600 , '/' );
		 	 }

			 return true;
		 }else{

			 //没有设置
			 return true;
		 }
	 	 
		 //操作失败
	 	 return false;
	}
}
