<?php
require_once( SOOJ_CMS_ROOT.'/models/Icontroller.interface.php' );
require_once( SOOJ_CMS_ROOT.'/models/view.class.php' );
require_once( SOOJ_CMS_ROOT.'/models/db.class.php' );

class problem_manager implements Icontroller{

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
	
		//得到题库中的全部试题
		$sql = 'SELECT problem.`no`, `title` , `best_user` , `sb_count` , `ac_count` , `problem`.`status`
			FROM problem , problem_detail
			WHERE problem.`no` = problem_detail.`problem_no`';
		$db = db::get_instance();

		$res = $db->query( $sql );
		if( $res->num_rows >= 1 ){

			 $i = 0;
	 	 	 while( $row = $res->fetch_assoc() ){
	 	 
			 	 //先全部保存在一个数组中
			 	 foreach( $row as $key=>$value ){
		
			 	 	 $rows[$i][$key] = $value;
			 	 }
			 	 $i++;
			 }
			 
			 //对数据库中取出的值进行一些转义
			 foreach( $rows as $key => $value ){
	 	 	 	 
				//替换最简用户
				if( $rows[$key]['best_user'] <= 0 ){

	 	 	 	 	$rows[$key]['best_user'] = '-'; 
				}

				//计算正确率
				//分母不能为0
				if ( $rows[$key]['sb_count'] != 0 ){
					//结果精确到小数点后两位
					$rows[$key]['ratio'] = number_format( 
						( $rows[$key]['ac_count'] / $rows[$key]['sb_count'] )*100 , 
						2 );	 
				}else{
				
					$rows[$key]['ratio'] = '-';
				}
			}
		}else{
		
			echo "null";
		}
		$view = new view();
		$view->problem_list = $rows;
		$view->controller = $fc->get_controller();
		@$view->message_no = $_SESSION['message_no'];
		unset( $_SESSION['message_no'] );

		$result = $view->render( '../views/problem_manager.php' );
		$fc->set_body( $result );
	}

	public function do_del_problem(){
	
		 $this->is_login();

		 $fc = front_controller::get_instance();
		 $params = $fc->get_params();

		 $problem_no = $params['no'];

		 $db = db::get_instance();
		 $db->autocommit(0);

		 $sql_1 = "DELETE FROM `problem`
			 WHERE `no`='$problem_no'";

		 $sql_2 = "DELETE FROM `problem_detail`
			 WHERE `problem_no`='$problem_no'";

		 $sql_3 = "DELETE FROM `problem_test_case`
			 WHERE `problem_no`='$problem_no'";

		 $res = $db->query( $sql_1 );
		 if( !$res ){
		 	 
			 $db->rollback();
		 	 return false;
		 }

		 $res = $db->query( $sql_2 );
		 if( !$res ){
		 	 
			 $db->rollback();
		 	 return false;
		 }

		 $res = $db->query( $sql_3 );
		 if( !$res ){
		 	 
			 $db->rollback();
		 	 return false;
		 }

		 $db->autocommit(1);
		 return true;
	}

	public function modify_problem(){
	
		 $this->is_login();

		 $fc = front_controller::get_instance();
		 $params = $fc->get_params();

		 $problem_no = $params['no'];
		 $db = db::get_instance();

		 //得到题目的一般信息
		 $sql = "SELECT * FROM `problem`
			 WHERE `no`='$problem_no'";

		 $res = $db->query( $sql );
		 if( !$res ){
		 
		 	 $problem_info = "获取题目信息出错";
		 }else{
		 
		 	 if( $res->num_rows == 1 ){

		 	 	 $problem_info = $res->fetch_assoc();
	 	
			 }else{
			 
				 $problem_info = "获取题目信息出错或者题库中还没有试题";
			 }
		 }

		 //得到题目的统计信息
		 $sql = "SELECT * FROM `problem_detail`
			 WHERE `problem_no`='$problem_no'";

		 $res = $db->query( $sql );

		 if( !$res ){
		 
		 	 $problem_detail_info = "获取题目信息出错";
		 }else{
		 
		 	 if( $res->num_rows >= 1 ){

				 $problem_detail_info = $res->fetch_assoc();

			 }else{
			 
				 $problem_detail_info = "获取题目信息出错或者题库中还没有试题";
			 }
		 }

		 //得到题目的测试用例信息
		 $sql = "SELECT * FROM `problem_test_case`
			 WHERE `problem_no`='$problem_no'";

		 $res = $db->query( $sql );

		 if( !$res ){
		 
		 	 $problem_info = "获取题目信息出错";
		 }else{
		 
		 	 if( $res->num_rows >= 1 && $res->num_rows <=3 ){

		 	 	 $i = 0;
	 	 	 	 while( $row = mysqli_fetch_assoc( $res ) ){
	 	 
	 	 	 	 	 //先全部保存在一个数组中
	 	 	 	 	 foreach( $row as $key=>$value ){
		
	 	 	 	 	 	 $problem_test_case_infos[$i][$key] = $value;
	 	 	 	 	 }
					 
					 $i++;
	 	 		 	 }
			 }else{
			 
				 $problem_test_case_infos = "获取题目测试用例出错,请检查数据库信息";
			 }
		 }

	 	$view = new view();
		$view->controller = $fc->get_controller();

		$view->problem_info = $problem_info;
		$view->problem_detail_info = $problem_detail_info;
		$view->problem_test_case_infos = $problem_test_case_infos;
		@$view->message_no = $_SESSION['message_no'];
		unset( $_SESSION['message_no'] );

		$result = $view->render( '../views/modify_problem.php' );
		$fc->set_body( $result );
	 }

	public function do_modify_problem(){

		 $this->is_login();

	 	 $problem_no = $_POST['no'];

		 //查看 problem表 是不是有所更新
		 $sql = "SELECT * 
			 FROM `problem` 
			 WHERE `no`='$problem_no'";

		 $db = db::get_instance();
		 $res = $db->query( $sql );

		 if( !$res ){
		 
		 	 $problem_info = "获取题目信息出错";
		 }else{
		 
		 	 if( $res->num_rows >= 1 ){

		 	 	 $problem_info = mysqli_fetch_assoc( $res );
			 }else{
			 
				 $problem_info = "获取题目信息出错或者题库中还没有试题";
			 }
		 }

		 $i = 0;
		 $sets = null;
		 foreach( $problem_info as $key => $value ){
		 
			 if( $_POST[$key] != $problem_info[$key] ){
			 
	 	 	 	 $sets[$i++] = sprintf( "`%s`='%s'" , $key , $_POST[$key] );
			 }
		 }

		 //有被修改的项
	 	 if( !empty( $sets ) ){
		 	 $set = join( ' , ' ,  $sets );
		 	 echo $sql = "UPDATE `problem` 
			 	 SET $set
				 WHERE `no` = '$problem_no'";
			 $res = $db->query( $sql );
		 	 if( !$res ){
		 
		 	 	 die( "更新题目信息出错" );
			 }
	 	 }
		

		 //删除原有的用例，全部
		 $sql = "DELETE FROM `problem_test_case` 
			 WHERE `problem_no` = '$problem_no'";

		 $res = $db->query( $sql );
		 if( !$res ){
		 
		 	 die( '删除原有测试用例信息失败' );
		 }
		 
		 $test_case = array(
			 0=>array( 
			 	 'input' => isset( $_POST['test_case_input0'] )?$_POST['test_case_input0']:null,
				 'output' => isset( $_POST['test_case_output0'] )?$_POST['test_case_output0']:null
			 	 ),
	 	 	 1=>array(
				 'input' => isset( $_POST['test_case_input1'] )?$_POST['test_case_input1']:null,
				 'output' => isset( $_POST['test_case_output1'] )?$_POST['test_case_output1']:null
			 	 ),
	 	 	 2=>array( 
				 'input' => isset( $_POST['test_case_input2'] )?$_POST['test_case_input2']:null,
				 'output' => isset( $_POST['test_case_output2'] )?$_POST['test_case_output2']:null
				 )
		 );
	 	 
		 foreach( $test_case as $case_no => $case ){
		 	
		 	 if( $case['input'] != '' && $case['output'] != '' ){
			 	 
				 $input = $case['input'];
				 $output = $case['output'];
				 $sql = "INSERT INTO `problem_test_case` 
					 SET `input`='$input', `output`='$output', `case_no`='$case_no', `problem_no`='$problem_no'";

				 $res = $db->query( $sql );
		 	 	 if( !$res ){
		 
		 	 	 	 die( '添加测试用例信息失败' );
			 	 }
			 }
		 }

		 //更改该试题的统计信息
		 //查看那一项内容有更新
		 $sql = "SELECT * 
			 FROM `problem_detail` 
			 WHERE `problem_no`='$problem_no'";

		 $db = db::get_instance();
		 $res = $db->query( $sql );

		 if( !$res ){
		 
		 	 $problem_info = "获取题目统计信息出错";
		 }else{
		 
		 	 if( $res->num_rows >= 1 ){

		 	 	 $problem_detail_info = mysqli_fetch_assoc( $res );
			 }else{
			 
				 $problem_detail_info = "获取题目统计信息出错或者题库中还没有该试题";
			 }
		 }
	 	 
		 foreach( $problem_detail_info as $key => $value ){

			 if( $key == 'problem_no' ){
			 
			 	 continue;
			 }
			 if( $_POST[$key] != $problem_detail_info[$key] ){
 	 	 	 	 
	 	 	 	 $value = $_POST[$key];
				 $sql = "UPDATE `problem_detail` 
					 SET `$key`='$value'
					 WHERE `problem_no`='$problem_no'";

				 $res = $db->query( $sql );
				 if( !$res ){
				 
				 	 die( '更新题目统计信息出错' );
				 }
			 }
		 }

		 //更新成功
		 //通过session设置更新成功信息
		 $_SESSION['message_no'] = 1;
		 header( "Location: /sooj/cms/problem_manager/modify_problem/no/$problem_no" );
	 }

	public function add_new_problem(){

		$this->is_login();

		$fc = front_controller::get_instance();
		$params = $fc->get_params();

		$view = new view();
		$view->controller = $fc->get_controller();

		$result = $view->render( '../views/add_new_problem.php' );
		$fc->set_body( $result ); 
	 }

	public function do_add_new_problem(){

		$this->is_login();
	 
		 //插入信息到 problem 表中
		 $problem_no = $no = $_POST['no'];
		 $sql = sprintf( 
			 "INSERT INTO `problem` 
			  SET 
			 `no`='%s' , 
			 `title`='%s' ,
			 `content`='%s' , 
			 `input`='%s' ,
			 `output`='%s' ,
			 `sample_input`='%s' ,
			 `sample_output`='%s' ,
			 `tip`='%s',
			 `time_limit`='%s' ,
			 `memory_limit`='%s'" ,
			 $_POST['no'] , $_POST['title'] , $_POST['content'] ,
			 $_POST['input'] , $_POST['output'] , $_POST['sample_input'] , $_POST['sample_output'] ,
			 $_POST['tip'] , $_POST['time_limit'] , $_POST['memory_limit'] );

		 $db = db::get_instance();
		 $res = $db->query( $sql );
		 if( !$res ){
		 
		 	 die( '增加试题到problem表时出错' );
		 }

		 //插入测试用例信息到 problem_test_case 表中
	 	 $test_case = array(
			 0=>array( 
			 	 'input' => isset( $_POST['test_case_input0'] )?$_POST['test_case_input0']:null,
				 'output' => isset( $_POST['test_case_output0'] )?$_POST['test_case_output0']:null
			 	 ),
	 	 	 1=>array(
				 'input' => isset( $_POST['test_case_input1'] )?$_POST['test_case_input1']:null,
				 'output' => isset( $_POST['test_case_output1'] )?$_POST['test_case_output1']:null
			 	 ),
	 	 	 2=>array( 
				 'input' => isset( $_POST['test_case_input2'] )?$_POST['test_case_input2']:null,
				 'output' => isset( $_POST['test_case_output2'] )?$_POST['test_case_input2']:null
				 )
		 );
	 	 
		 foreach( $test_case as $case_no => $case ){
		 	
		 	 if( $case['input'] != '' && $case['output'] != '' ){
			 	 
				 $input = $case['input'];
				 $output = $case['output'];
				 $sql = "INSERT INTO `problem_test_case` 
					 SET `input`='$input', `output`='$output', `case_no`='$case_no', `problem_no`='$problem_no'";

				 $res = $db->query( $sql );
		 	 	 if( !$res ){
		 
		 	 	 	 die( '添加测试用例信息失败' );
			 	 }
			 }
		 }

		 //插入一行记录到 problem_detail 表中
		 $sql = "INSERT INTO `problem_detail` SET `problem_no`='$problem_no'";
		 $res = $db->query( $sql );

		 if( !$res ){
		 
		 	 die( '插入记录到problem_detail表时出错' );
		 }

		 //添加试题成功
		 $_SESSION['message_no'] = 1;
		 header( 'Location: /sooj/cms/problem_manager/' );
	 }

}

