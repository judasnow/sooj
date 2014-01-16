<?php
require_once( SOOJ_CMS_ROOT.'/models/Icontroller.interface.php' );
require_once( SOOJ_CMS_ROOT.'/models/view.class.php' );
require_once( SOOJ_CMS_ROOT.'/models/db.class.php' );

class user_manager implements Icontroller{

	public function is_login(){
	 	 
		//判断用户是否已经登录
		if( !isset( $_SESSION['admin'] ) || empty( $_SESSION['admin'] ) ){
		
			header( 'Location: /sooj/cms/' );
			exit();
		}
	
	}

	public function index(){

		$this->is_login();

		$fc = front_controller::get_instance();
		$params = $fc->get_params();
	
		//得到系统中的全部用户
		$sql = 'SELECT * 
			FROM `user`';
		$db = db::get_instance();

		$res = $db->query( $sql );
		if( $res->num_rows >= 1 ){

			 $i = 0;
	 	 	 while( $row = $res->fetch_assoc() ){
	 	 
			 	 //先全部保存在一个数组中
			 	 foreach( $row as $key=>$value ){
		
			 	 	 $users[$i][$key] = $value;
			 	 }
			 	 $i++;
			 }
		}else{
		
			 $users="还没有注册用户";
		}	 
			
		$view = new view();
		$view->users = $users;
		$view->controller = $fc->get_controller();

		@$view->message_no = $_SESSION['message_no'];
		unset( $_SESSION['message_no'] );

		$result = $view->render( '../views/user_manager.php' );
		$fc->set_body( $result );
	}

	public function do_del_user(){
	
		$this->is_login();

		$fc = front_controller::get_instance();
		$params = $fc->get_params();

		$user_id = $params['id'];

		//删除 user 表中相应用户信息
		$sql = "DELETE 
			FROM `user` 
			WHERE `id`='$user_id'";

		$db = db::get_instance();
		$res = $db->query( $sql );
		if( !$res ){
		
			 die( '删除 user 表中用户信息时出错' );
		} 

		//删除 user_profile 中相应用户信息
		$sql = "DELETE 
			FROM `user_profile`
			WHERE `id`=$user_id";

		$res = $db->query( $sql );
		if( !$res ){
		
			 die( '删除 user_profile 表中用户信息时出错' );
		} 

		//删除  user_judge_statistics 中相应用户信息
		$sql = "DELETE 
			FROM `user_judge_statistics`
			WHERE `user_id`=$user_id";

		$res = $db->query( $sql );
		if( !$res ){
		
			 die( '删除  user_judge_statistics 表中用户信息时出错' );
		} 

		header( 'Location: /sooj/cms/user_manager' );
		exit();
	}
}

