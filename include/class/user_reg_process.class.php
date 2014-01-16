<?php
/**
 * 定义用户注册操作
 *
 * @author <judasnow@gmail.com>
 */
class user_reg_process{

	//数据库连接资源
	private $db;
	//用户请求资源对象
	private $request;
	//用户基本信息表对象
	private $db_obj_user;
	//用户详细信息表对象
	private $db_obj_user_profile;

	/**
	 * @param MDB2 object $db 数据库连接
	 * @param request object $request 用户请求数据
	 */ 
	function __construct( $db , $request ){

		$this->db = $db;
		$this->request = $request;
		//用户数据表对象实例
		$this->db_obj_user = new db_obj_user( $db );
		//用户详细信息表对象实例
		$this->db_obj_user_profile = new db_obj_user_profile( $db );
	}

	/**
	 * 验证该用户名是是否唯一
	 * 即是否该用户名已经被注册
	 * 
	 * @return bool
	 */
	 function is_reg(){
		 
	 	 return $this->db_obj_user->is_reg( $this->request );
	 }

	/**
	 * 处理用户注册操作 
	 *
	 * @return bool 
	 */
	function do_reg(){
	 	
		if ( !$this->request || !$this->db ){

			return false;
		}

		//从用户输入的到数据,采取的过滤策略为
		//对于用户名为string
		$username = $this->request->get( 'username' , 'string' );
		$password = $this->request->get( 'password' , 'string' );
		
		$this->db_obj_user->set( 'username' , $username );
		$this->db_obj_user->set( 'password' , md5( $password ));
		
		$res = $this->db_obj_user->save();
		 
		if ( !$res ) {

			return false;
		}
		$this->post_reg();
		return true ;
	}

	/**
	 * 注册完成之后的善后处理
	 *
	 * 目前就是建立一张相应的用户详细信息表
	 */
	function post_reg(){

		//用户注册提供的nick
		$nick = $this->request->get( 'nick' , 'string' );
		//得到刚注册用户的id
		$this->db_obj_user->load( 'username' , $this->request->get( 'username' ));
		$id = $this->db_obj_user->get( 'id' );
		//建立相应用户的user_profile表中的一行记录
		$reg_time = date("Y-m-d");
		$this->db_obj_user_profile->set( 'id' , $id );
		$this->db_obj_user_profile->set( 'reg_time' , $reg_time );
		$this->db_obj_user_profile->set( 'nick' , $nick );

		//生成由用户ID决定的默认头像
		$this->create_qr_code( $id );

		//设置默认头像
		$this->db_obj_user_profile->set( 'head_img' , "/sooj/view/picture/user_head_img/big_$id.png" );

		//在用户评测结果统计表中插入一行记录
		user_judge_statistics_process::create_row( $this->db , $id );

		$res = $this->db_obj_user_profile->save();

		if ( PEAR::isError( $res) ){

			return false;
		}

	 	//检测是否三张表通用户有关的表中均有该用户的信息
		//@todo 也许可以替代为触发器
		$db_obj_user_judge_stat = new db_obj_user_judge_statistics( $this->db );
		try{

		if( !$this->db_obj_user_profile->load( 'id' , $id ) || !$db_obj_user_judge_stat->load( 'user_id' , $id ) ){
	
			//三表内容没有同步
			//注册失败
			return false;
		}
		}catch( Exception $e ){
			 
			//@todo 处理之 
			echo $e->getMessage();
			die;
		}
		return true;
	}

	/**
	 * 删除当前用户
	 * 
	 * @todo
	 */
	function del_user(){
				
		$sql = "DELETE FROM test_user WHERE username = '$username'";

		$res = $db->query( $sql ) ;
		if (PEAR::isError($res)) {

			return false ;
		}
		return true ;
	}
	 
	/**
	 * 使用”PHP QR Code“库 生成用户ID的
	 * 二维码 作为用户的默认头像
	 * 
	 * @access private 
	 */
	private function create_qr_code( $id ){
		 
	 	 
		require_once( SOOJ_ROOT.'/include/lib/phpqrcode/phpqrcode.php' );
		$errorCorrectionLevel = 'L';
		//大头像
	 	$matrixPointSize = 6;
		QRcode::png( $id , "../../view/picture/user_head_img/big_$id.png" , $errorCorrectionLevel , $matrixPointSize );
		//小头像
		$matrixPointSize = 2;
		QRcode::png( $id , "../../view/picture/user_head_img/small_$id.png" , $errorCorrectionLevel , $matrixPointSize );
	}
}

