<?php
require_once( SOOJ_CMS_ROOT.'/models/Icontroller.interface.php' );
require_once( SOOJ_CMS_ROOT.'/models/view.class.php' );
require_once( SOOJ_CMS_ROOT.'/models/db.class.php' );

class auth implements Icontroller{
	
	public function index(){

		$fc = front_controller::get_instance();
		$view = new view();
	
		@$view->login_false = $_SESSION['login_false'];
		$_SESSION['login_false'] = 0;

		$result = $view->render( '../views/index.php' );
		$fc->set_body( $result );
	}

	public function dologin(){

		$admin = addslashes( $_POST['admin'] );
		$passwd = md5( $_POST['password'] ); 

		//执行登录操作
		$sql = "SELECT * 
			FROM `staff` 
			WHERE `admin` = '$admin' AND `passwd` = '$passwd'";

		$db = db::get_instance();
		$res = $db->query( $sql );

		if( $res->num_rows == 1 ){
			
			 //登录成功
			 //保存会话变量
			 $_SESSION['admin'] = $admin; 

			 //更新最后登录时间以及ip
			 $last_login_time = date( "Y-m-d H:i:s",time()+8*60*60 );
			 $last_login_ipadd = $_SERVER['REMOTE_ADDR'];

			 $sql = "UPDATE `staff` 
				 SET `last_login_time` = '$last_login_time' , `last_login_ipadd` = '$last_login_ipadd'
				 WHERE `admin` = '$admin'";
			 $res = $db->query( $sql );
			 if( $res ){

				 //更新数据库成功
			 	 header( 'Location: /sooj/cms/problem_manager/' );
			 	 exit;
			 }else{
			 
				 $_SESSION['login_false'] = 1;
			 	 header( 'Location: /sooj/cms/' );
				 exit;
			 }
		}else{
			 			 
			 $_SESSION['login_false'] = 2;
			 header( 'Location: /sooj/cms/' );
			 exit;
		}
	}

	public function dologout(){

		if( isset( $_SESSION['admin'] ) ){
			 
			//删除会话变量
			unset( $_SESSION['admin'] );
		}
		//重定向到首页
		header( 'Location: /sooj/cms/' );
		exit();
	}
}

