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
	 *
	 */
	private $db_obj_problem;

	function __construct( $db ){
		 
		$this->db = $db;
		$this->db_obj_problem = new db_obj_problem( $db );
	}

	function load( $key , $value ){
	
		$this->db_obj_problem->load( $key , $value );
		return true;
	}
	function get( $key ){
		 
		return $this->db_obj_problem->get( $key );
	} 

	/**
	 * 得到全部题目列表
	 * 注意仅仅是现实列表需要的信息
	 * 而且需要对两个表进行操作
	 *
	 * @return array $rows 返回的题目信息数组
	 */
	static function get_all( $db ){
 
		$sql = 'SELECT problem.`no`, `title` , `best_user` , `sb_count` , `ac_count`
			FROM problem , problem_detail
			WHERE problem.`no` = problem_detail.`problem_no`';

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
				WHERE problem.`no` = problem_detail.`problem_no` and ' . 'problem.`'.$cond['key'] . '`=\'' . $cond['value']. "'" ;

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
