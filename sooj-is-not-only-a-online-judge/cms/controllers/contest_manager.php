<?php
require_once( SOOJ_CMS_ROOT.'/models/Icontroller.interface.php' );
require_once( SOOJ_CMS_ROOT.'/models/view.class.php' );

class contest_manager implements Icontroller{
	
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
		$db = db::get_instance();

		$sql = "SELECT * FROM `contest`";
		$res = $db->query( $sql );
	 	if( !$res ){
		
			 die( '获得竞赛列表出错' );
		}

	 	if( $res->num_rows >= 1 ){

			 $i = 0;
			 while( $row = mysqli_fetch_assoc( $res ) ){

	 	 	 //先全部保存在一个数组中
	 	 	 foreach( $row as $key=>$value ){
		 
				 $contest_lists[$i][$key] = $value;
	 	 	 }
					 
			 $i++;
			 }

		}else{
			 
			$contest_list = "还没有竞赛信息";
		}

		$view = new view();
		$view->controller = $fc->get_controller();
		@$view->contest_lists = $contest_lists;
		$result = $view->render( '../views/contest_manager.php' );
		$fc->set_body( $result );
	}

	public function add_new_contest(){
	
		$this->is_login();
		$fc = front_controller::get_instance();	

		$view = new view();
		$view->controller = $fc->get_controller();

		$result = $view->render( '../views/add_new_contest.php' );
		$fc->set_body( $result );
	}

	public function do_add_new_contest(){

		$this->is_login();
	
		$sql = @sprintf( "INSERT INTO `contest` 
			SET `title`='%s' , `start_time`='$start_time' , `end_time`='%s' , `summary`='%s'" , 
			$_POST['title'] , $_POST['start_time'] , $_POST['end_time'] , $_POST['summary'] );

		$db = db::get_instance();
		$res = $db->query( $sql );
		if( !$res ){
		
			 die( '添加新的竞赛信息时出错' );
		}

		header( 'Location: /sooj/cms/contest_manager/' );
		exit();
	}

	public function modify_contest(){
	
		$this->is_login();
		$fc = front_controller::get_instance();
		$params = $fc->get_params();
	 
		$contest_id = $params['id'];
		$db = db::get_instance();

		$sql = "SELECT * 
			FROM `contest` 
			WHERE `id`='$contest_id'";

		$res = $db->query( $sql );
	 	if( !$res ){
			 
			 die( '获得竞赛信息出错' );
		}
		if( $res->num_rows == 1 ){
		
			 $contest_info = $res->fetch_assoc();
		}

		//获得竞赛试题信息
		$sql = "SELECT `contest_problem`.`problem_no` , `contest_problem`.`sorter` , `problem`.`title` 
			FROM `contest_problem` , `problem`
			WHERE `contest_problem`.`contest_id` = '$contest_id' 
			AND `contest_problem`.`problem_no` = `problem`.`no`";

		$res = $db->query( $sql );
	 	if( !$res ){
			 
			 die( '获得竞赛题目信息出错' );
		}
		if( $res->num_rows >= 1 ){

			 $i = 0;
			 while( $row = mysqli_fetch_assoc( $res ) ){

	 	 	 //先全部保存在一个数组中
	 	 	 foreach( $row as $key=>$value ){
		 
				 $contest_problem_infos[$i][$key] = $value;
	 	 	 }
					 
			 $i++;
			 }

		}else{
			 
			$contest_problem_lists = "竞赛中还没有可用题目";
		}

		$view = new view();
		$view->controller = $fc->get_controller();
		@$view->contest_info = $contest_info;
		@$view->contest_problem_infos = $contest_problem_infos;
		$result = $view->render( '../views/modify_contest.php' );
		$fc->set_body( $result );
	}

	public function do_del_problem_from_contest(){
	
		$this->is_login();
		$fc = front_controller::get_instance();
		$params = $fc->get_params();
	 
		$problem_no = $params['problem_no'];
		$contest_id = $params['contest_id'];
		$db = db::get_instance();

		$sql = "DELETE 
			FROM `contest_problem` 
			WHERE `contest_id`='$contest_id' AND `problem_no`='$problem_no'";
		 
		$db = db::get_instance();
		$res = $db->query( $sql );
		if( !$res ){
		
			 die( '从竞赛信息中删除指定的题目出错' );
		}

		header( "Location: /sooj/cms/contest_manager/modify_contest/id/$contest_id" );
		exit();
	}

	public function do_add_new_problem(){
		
	 	 $problem_no = $_POST['new_problem_no'];
	 	 $contest_id = $_POST['contest_id'];

		 echo $sql = "INSERT 
			 INTO `contest_problem` 
			 SET `problem_no` = '$problem_no'
			 , `contest_id` = '$contest_id'";

		 $db = db::get_instance();
		 $res = $db->query( $sql );

		 if( !$res ){
		 
			 die( '向竞赛中添加试题时出错' );
		 }

	 	 
		 header( "Location: /sooj/cms/contest_manager/modify_contest/id/$contest_id" );
		 exit();
	}

	public function do_modify_contest(){
	
		$contest_id = $_POST['id'];
		//判断哪些字段的值发生了改变
		$sql = "SELECT *
			FROM `contest`
			WHERE `id` = '$contest_id'";

		$db = db::get_instance();
		$db->query( $sql );

		$res = $db->query( $sql );
		$contest_info = $res->fetch_assoc();

		foreach( $_POST as $key => $value ){
		
			if( $contest_info[$key] != $value ){
			
				$sql = "UPDATE 
					`contest` 
					SET `$key`='$value'
					WHERE `id`='$contest_id'";

				$res = $db->query( $sql );
				if( !$res ){
				
					 die( '更新竞赛信息失败' );
				}
			}
		}

		//更新成功
		 header( "Location: /sooj/cms/contest_manager/modify_contest/id/$contest_id" );
		 exit();
	}

	public function do_del_contest(){
	
		$this->is_login();

		$fc = front_controller::get_instance();
		$params = $fc->get_params();
	 
		$contest_id = $params['id'];
		$db = db::get_instance();

		//删除contest表中相应的记录
		$sql = "DELETE 
			FROM `contest` 
			WHERE `id`='$contest_id'";
		 
		$db = db::get_instance();
		$res = $db->query( $sql );
		if( !$res ){
		
			 die( '从contest表中删除指定的竞赛出错' );
		}

		//删除contest_problem表中相应的记录
		$sql = "DELETE 
			FROM `contest_problem`
			WHERE `contest_id`='$contest_id'";

		$res = $db->query( $sql );
		if( !$res ){
		
			 die( '从contest_problem表中删除指定的竞赛出错' );
		}

		header( "Location: /sooj/cms/contest_manager/modify_contest/id/$contest_id" );	
		exit();
	}
	
}

