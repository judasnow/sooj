<?php
/**
 * 题目操作类
 *
 * @uathor <judasnow@gmail.com>
 */
class problem_process{

	/**
	 * 数据库连接
	 *
	 * @var $db 
	 */
	private $db;
	/**
	 * 存放试题的problem表对应的
	 * 数据库处理函数
	 *
	 * @var $db_obj_problem
	 */
	private $db_obj_problem;
	private $db_obj_problem_detail;

	function __construct( $db ){
		 
		$this->db = $db;
		$this->db_obj_problem = new db_obj_problem( $db );
		$this->db_obj_problem_detail = new db_obj_problem_detail( $db );
	}

	//$value 在一般情况下为no
	function load( $problem_no ){

		$this->db_obj_problem->load( 'no' , $problem_no );
		$this->db_obj_problem_detail->load( 'problem_no' , $problem_no );
		return true;
	}

	function get( $key ){

		//统计信息需要从detail表中获取
		if( $key == 'ac_count' || $key == 'sb_count' ){
		
			return $this->db_obj_problem_detail->get( $key );
		}else{
			 
			return $this->db_obj_problem->get( $key );
		}	
	}

	/**
	 * 判断该试题是否存在或
	 * 是否允许非竞赛用户提交
	 * 注意在竞赛状态下不存在不允许
	 * 提交的试题
	 * 
	 * @param $db 数据库连接
	 * @param $problem_no 需要查询的题目的编号
	 * @param $user_id 当前登录的用户id
	 * @return bool 
	 */
	static public function is_available( $db , $problem_no , $user_id ){

		$sql = "SELECT `status` 
			FROM `problem`
			WHERE `no` = '$problem_no'";
       	
		$res = $db->query( $sql );
	 
		//是否存在该试题或该试题是否允许
		//用户在非竞赛状态下提交
		if ( $res->NumRows() == 1 ){
	 	
			$row = $res->fetchRow( MDB2_FETCHMODE_ASSOC );
	 		
			$problem_status_is_open = ( $row['status'] == 'open' ) ? true : false; 

			$contest_proc = unserialize( @session::get( 'contest_proc' ) );
			//判断用户是否在竞赛状态
			if ( $from_contest_page = ( $contest_proc instanceof contest_process ) ){
			
				$contest_is_in_process = $contest_proc->get_status() == 'in_process'? true : false;
				$is_user_reg = $contest_proc->is_user_reg( $user_id );
			}

			//用户可以查看该试题的条件有
			//其一为 当前竞赛为is_process
			//其二为 当前用户已经参与了该竞赛
			//其三为 该试题本来就开放提交
			return ( $problem_status_is_open || ( $is_user_reg && $contest_is_in_process ) );
		}else{    

			//根本存在该试题或者
			//题库中的题目编号不唯一
			//数据库中出现异常
			echo 'muyou';die;
	 	 	return false;
		}			
	}

	/**
	 * 得到全部题目列表
	 * 注意仅仅是现实列表需要的信息
	 * 而且需要对两个表进行操作
	 *
	 * @return array $rows 返回的题目信息数组
	 */
	static function get_all( $db ){

		//得到所有状态为open的试题
		//比赛状态被修改为结束后其
		//中的所有试题状态会被修改为
		//open以开放提交
		$sql = 'SELECT problem.`no`, `title` , `best_user` , `sb_count` , `ac_count`
			FROM problem , problem_detail
			WHERE problem.`no` = problem_detail.`problem_no` AND `problem`.`status` = "open"';

		return self::fetch_problem_list( $db , $sql );
	}
	 
	/**
	 * 实现对试题的搜索功能
	 *
	 * @param $db 数据库连接
	 * @param $cond 查询条件
	 * @return array 数据库中符合查询条件的结果数组 
	 */
	static function search( $db , $cond=array() ){
	 	//@todo 有注入危险 
		//目前仅支持以这两种条件进行搜索
		if( $cond['key']=='no' || $cond['key']=='source' ){

			$sql = 'SELECT problem.`no`, `title` , `best_user` , `sb_count` , `ac_count`
				FROM problem , problem_detail
				WHERE `problem`.`status` = "open" AND problem.`no` = problem_detail.`problem_no` and ' . 'problem.`'.$cond['key'] . '`=\'' . $cond['value']. "'" ;

		}else{
			 //传入的查询条件有误
			 return false;
		}	

		return self::fetch_problem_list( $db , $sql );
	}

	//按不同的要求从数据库获取题目列表
	static function fetch_problem_list( $db , $sql ){

		$res = $db->query( $sql );

		if ( PEAR::isError( $res ) ) {

			throw new DatabaseException( '获得题目列表出错'.$res->getMessage() );
		}
		if ( $res->NumRows() >= 1 ){

			$rows = $res->fetchAll( MDB2_FETCHMODE_ASSOC );

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
			return $rows ;

		}else{

			return false ;	
		}
		 
	}
}
