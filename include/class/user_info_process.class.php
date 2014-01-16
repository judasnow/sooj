<?php
require_once( SOOJ_ROOT.'/include/function/get_gravatar.function.php' );
/**
 * 提供对用户信息查询更改等操作
 *
 * 用户登录之后session中保存的便是此对象
 *
 * @author <judasnow@gmial.com>
 */
class user_info_process{

	private $db;
	//user id
	private $id;

	private $db_obj_user;
	private $db_obj_user_profile;

	function __construct( $db , $id ){

		$this->db = $db;
		$this->id = $id;

		$this->db_obj_user = new db_obj_user( $db );
		$this->db_obj_user->load( 'id' , $id );

		$this->db_obj_user_profile = new db_obj_user_profile( $db );
		$this->db_obj_user_profile->load( 'id' , $id );
	}
	 
	//@todo 
	static function get_nick_by_id( $db , $nick ){
		 ;
	}

	function get_user_id(){
	
		return $this->id;
	}
	function get_username(){

		return $this->db_obj_user->get( 'username' );
	}
	function get_password(){

		return $this->db_obj_user->get( 'password' );
	}
	function get_nick(){
		
		return $this->db_obj_user_profile->get( 'nick' );
	}
	function get_motto(){

		return $this->db_obj_user_profile->get( 'motto' );
	}
	function get_head_img(){
	
	 	return $this->db_obj_user_profile->get( 'head_img' );
	}
	function get_email(){
	
	 	return $this->db_obj_user_profile->get( 'email' );
	}


	//更新用户的昵称
	function update_nick( $nick ){
	 	 
		return $this->db_obj_user_profile->set( 'nick' , $nick );
	}
	function update_user_head_img( $img ){ 
		 
		return $this->db_obj_user_profile->set( 'head_img' , $img );
	}
	function update_motto( $motto ){
		
		return $this->db_obj_user_profile->set( 'motto' , $motto );
	}
	function update_email( $email ){
	
		return $this->db_obj_user_profile->set( 'email' , $email );
	}
	function do_update(){

		if( $this->db_obj_user_profile->save() ){

			$this->update_session_user_info();
			return true;
		}

		return false;	
	}
	function do_update_password( $new_password ){

		$this->db_obj_user->set( 'password' , md5( $new_password ) );
		$this->db_obj_user->save();

		$this->update_session_user_info();
		return true;
	}
	//更session中的用户信息
	function update_session_user_info(){

		//@todo 必须又传入一次$db?
		$user_info_proc = new user_info_process( db_connect() , $this->id );
		return session::set( 'user' , serialize( $user_info_proc ) );
	}

	/**
	 * 用于更新用户的头像
	 * 该函数在用户上传头像之后，会先对其进行缩放处理
	 * 保存一个big(长宽都在120之内)，同时保存一个small
	 * (长宽是48，因此用户上传的图片大小必须大于48)
	 */
	function do_update_user_head_img(){
	//使用pear的Http_upload类

		$upload = new HTTP_Upload();
		$file = $upload->getFiles( 'head_img' );

		if( $file->isMissing() ){

			throw new RunTimeException( '还没有选择图片文件' );
		
		}elseif( $file->isError() ) {
    	 	 
			echo $file->errorMsg();
	 	}

		if( $file->isValid() ){

			//必须这样设置路径！不然上传不可识别路径
			$file_path = '/sooj/view/picture/user_head_img/';

			//上传文件的信息
			$file_prop = $file->getProp();
			$ext = $file_prop['ext'];

			//设置文件名称 用户名加big或small
			$file_name = 'big_'.$this->id.'.'.$ext;
			$file_name_small = 'small_'.$this->id.'.'.$ext;
			$file->setName( $file_name );
			//生成缩略图 small ，因为使用的是上传之后的临时
			//文件地址，因此必须在调用moveTo函数之前生成
			//否则临时文件可能会被删除
			$picture_adjust = new picture( $file_prop );
			$picture_adjust->resize_picture( SOOJ_ROOT.'/view/picture/user_head_img/'.$file_name_small , 48 , 48 );
			//对用户上传的图片进行规范化 200 * 200 像素最大
			$picture_adjust->resize_picture( SOOJ_ROOT.'/view/picture/user_head_img/'.$file_name , 200 , 200 );

			/*$upload_error = $file->moveTo( $file_path );

			if ( PEAR::isError( $upload_error ) ){
				//@todo 错误信息需要加以完善
				throw new Exception( '更新用户头像出错'.$upload_error->getMessage() );
			}*/

			//更新数据库中的头像url
			//更新数据库中头像缩略图的url

			if ( $this->update_user_head_img( $file_path.$file_name ) ){

				$this->do_update();
				return true;
			}else{

				throw new Exception( '更新用户头像url时出错' );
			}

		}else{
			throw new Exception( '更新用户头像出错'.$file->errorMsg() );
		}
	}

	/**
	 *
	 *return $url 
	 */
	function get_gravatar_img(){

		$email = @$this->get_email();
		//当前对象中存在有效email	
		if( $email ){
		
			 return get_gravatar( $email );
		}	
       	 
	 	return false;		
	}
}
