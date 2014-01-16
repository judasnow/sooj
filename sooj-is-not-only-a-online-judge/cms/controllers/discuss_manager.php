<?php
require_once( SOOJ_CMS_ROOT.'/models/Icontroller.interface.php' );
require_once( SOOJ_CMS_ROOT.'/models/view.class.php' );

class discuss_manager implements Icontroller{

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
		$topic_no = $params['no'];

		$db = db::get_instance();

		$sql = "SELECT * 
			 FROM `topic`";

		$res = $db->query( $sql );
	 	if( $res->num_rows >= 1 ){

			 $i = 0;
	 	 	 while( $row = $res->fetch_assoc() ){
	 	 
			 	 //先全部保存在一个数组中
			 	 foreach( $row as $key=>$value ){
		
			 	 	 $topic_lists[$i][$key] = $value;
			 	 }
			 	 $i++;
			 }
		}else{
		
			 $topic_lists="还没有帖子";
		}	 

		$view = new view();
		$view->controller = $fc->get_controller();
		$view->topic_lists = $topic_lists;
		$result = $view->render( '../views/discuss_manager.php' );
		$fc->set_body( $result );
	}

	public function do_del_topic(){

		$this->is_login();

		$fc = front_controller::get_instance();
		$params = $fc->get_params();
		$topic_no = $params['no'];

		$db = db::get_instance();

		$sql = "DELETE
			FROM `topic`
			WHERE `topic_no` = '$topic_no'";

		$res = $db->query( $sql );
	 	if( !$res ){
		
			 die( '删除帖子信息出错' );
		}

		header( 'Location: /sooj/cms/discuss_manager' );
		exit();
	}

	public function topic_replys(){

		$this->is_login();
	
		$fc = front_controller::get_instance();
		$params = $fc->get_params();
		$topic_no = $params['topic_no'];

		$db = db::get_instance();

		$sql = "SELECT * 
			FROM `reply`
			WHERE `topic_no`='$topic_no'";

		$res = $db->query( $sql );
	 	if( $res->num_rows >= 1 ){

			 $i = 0;
	 	 	 while( $row = $res->fetch_assoc() ){
	 	 
			 	 //先全部保存在一个数组中
			 	 foreach( $row as $key=>$value ){
		
			 	 	 $topic_replys[$i][$key] = $value;
			 	 }
			 	 $i++;
			 }
		}else{
		
			 $topic_replys="还没有帖子回复";
		}	 

		$view = new view();
		$view->controller = $fc->get_controller();
		@$view->topic_replys = $topic_replys;
		$result = $view->render( '../views/topic_replys.php' );
		$fc->set_body( $result );
	}

	public function do_del_reply(){

		$this->is_login();
	
		$fc = front_controller::get_instance();
		$params = $fc->get_params();
		$reply_no = $params['reply_no'];
		$topic_no = $params['topic_no'];

		$db = db::get_instance();

		$sql = "DELETE
			FROM `reply`
			WHERE `reply_no` = '$reply_no'";

		$res = $db->query( $sql );
	 	if( !$res ){
		
			 die( '删除帖子回复信息出错' );
		}

		header( "Location: /sooj/cms/discuss_manager/topic_reply.php/no/$topic_no" );
		exit();
	}

}

