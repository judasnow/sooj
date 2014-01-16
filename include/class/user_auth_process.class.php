<?php
/**
 * 定义用户认证有关操作
 * 
 * @author <judasnow@gmail.com>
 */
class user_auth_process{

	/**
	 * @var object $db MDB2 类的实例 
	 */
	private $db;

	/**
	 * @var object $request request 类的实例,包含了用户的输入
	 */
	private $request;

	/**
	 * @var string $table_name 定义了表名
	 */
	private $table_name;

	/**
	 * @var object $db_obj_user db_obj_user类的一个实例 包含了数据库中相应用户的信息
	 */
	private $db_obj_user;

	/**
	 * 
	 * @param object $db 
	 * @param object $request 
	 */
	function __construct( $db , $request=null ){

		$this->db = $db;
		$this->request = $request;
		$this->db_obj_user = new db_obj_user( $db );	
		//@todo	有什么用？忘了。。。
		$this->table_name = $this->db_obj_user->get_table_name();
	}

	/**
	 * 执行具体的login操作
	 *
	 * @return bool
	 */
	public function do_login(){

		if( $this->has_login( $this->db ) ){

			throw new AuthException( '用户已经登录' );
		}

		//从用户输入得到用户名以及密码并过滤之
		$username = $this->request->get( 'username' , 'string' );
		$password = $this->request->get( 'password' , 'string' );

		$password = md5( $password );
		$sql = "select * from $this->table_name where username='$username' and password='$password'";
		$res = $this->db->query( $sql );
		if ( PEAR::isError( $res ) ){

			throw new DatabaseException( '用户认证时数据库查询异常:'.$sql.':'.$res->getMessage() );
		}

		//返回结果数为1才被视为成功登陆
		if ( $res->NumRows() == 1 ){

			//更新用户登录时间以及ip地址
			$last_login_time = date( "Y-m-d H:i:s",time()+8*60*60 );
			$last_login_ipadd = $_SERVER['REMOTE_ADDR'];

	 	 	//@todo 封装为一个函数 方便获取用户id?
			$this->db_obj_user->load( 'username' , $username );
			$id = $this->db_obj_user->get( 'id' );

			$this->db_obj_user->set( 'last_login_time' , $last_login_time );
			$this->db_obj_user->set( 'last_login_ipadd' , $last_login_ipadd );
			$this->db_obj_user->save();

			//序列化之后的用户信息处理对象保存到session中
			//注意是以'user'作为key
			$user_info_process = new user_info_process( $this->db , $id );
			session::set( 'user' , serialize( $user_info_process ) );
			return true;

		//无返回结果被视为登录失败
		}elseif( $res->NumRows() == 0 ){ 

			return false;
		
		//其他的结果数则表明数据表中有异常存在
		}else{

			throw new DatabaseException( '数据库异常:用户名不唯一:'.$username );
		}
	}

	/** 
	 * 进行用户登出操作
	 *
	 * @return bool 
	 */
	static function do_logout(){

		if( @session::get( 'user' ) ){

			//清除session变量
			session::clear( 'user' );

			//@todo 清除cookie
			if( !defined( "TEST" ) ){

				//在生产环境下
				setcookie( 'user' , '' , 0 );
			}
			return true;
		}else{

			return false;
		}
	}

	/**
	 * 判断用户是否已经登录
	 * 
	 * 如果用户已经成功登录则返回用户对应的
	 * user_info_proc对象，否则返回空值
	 *
	 * @return mixed $user_info_proc or false	  
	 */
	static function has_login( $db ){

		//获取会话变量中的user_info_proc对象
		$user_info_proc = unserialize( session::get( 'user' ) );

		//反序列化后以是否为user_info_process类的一个实例
		//作为用户是否成功登录的依据
		if ( $user_info_proc instanceof user_info_process ){

			//用户已经成功登录系统
			return  $user_info_proc;
		}else{
			//尝试自动登录
			return self::auto_login( $db );
		}
	}

	/**
	 * 尝试通过cooike自动登录系统
	 *
	 * @param object $db 
	 * @return object or bool $user_info_proc 成功则返回user_info_process 类的对象否则
	 * 返回false
	 */
	static function auto_login( $db ){
	 	 
		 $cookie = new cookie( $db );
		 if( $user_info_proc = $cookie->auto_login() ){
			 
			 //已经设置自动登录并且验证成功
		 	 return $user_info_proc;
		 }

		 return false;
	}
}
	
