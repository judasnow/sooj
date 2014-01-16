<?php
/**
 * 定义 ranklist 相关操作
 *
 * @todo
 * @author Judas <judasnow@gmail.com>
 * @license http://www.opensource.org/licenses/lgpl-license.php LGPL
 */

class ranklist_process{
	
	private $db;
	private $db_obj_ranklist;
	private $db_obj_user_judge_statistics;
	
	function __construct( $db ){
		
		$this->db = $db;
	}
	
	//update_ranklist是否应该放在
	//db_obj_user_judge_statistics
	static function update_ranklist( $db ){
		
		$sql = "SELECT user_id , sb_count , ac_count 
			FROM user_judge_statistics 
			ORDER BY ac_count DESC , sb_count DESC";

		$res = $db->query( $sql );

		if (PEAR::isError($res)){

			throw new DatabaseException( '更新ranklist出错'.$res->getMessage());
		}

		if ( $res->NumRows() >= 1 ){
			
			//根据返回的结果更新 ranklist 表
			$db_obj_ranklist = new db_obj_ranklist( $db );

			$rank = 1;
			$db_obj_ranklist->reset();
	 	 	 
			//这个算法有问题,每次都需要全部更新。。。
			while ( $row = $res->fetchRow( MDB2_FETCHMODE_ASSOC ) ){

				$db_obj_ranklist->set( 'rank' , $rank++ );
				$db_obj_ranklist->set( 'user_id' , $row['user_id'] );
				$db_obj_ranklist->save();
			}

		}else{
			
			return false ;	
		}
	}

	/**
	 * 计算用户 ac/sb 比率
	 * (因为数据库中保存的仅仅是单个的数值)
	 * 
	 * @param array $ranks
	 * @return array $ranks 
	 */
	private function calc_ratio( $ranks ){

		if( empty( $ranks )){
		
			 return false;
		}

		foreach( $ranks as $index=>$value ){
			
			//提交次数(sb_count)为0
			if( $ranks[$index]['sb_count'] == 0 ){
	 	 	 	 
				 //sb次数为0，但是ac次数不为0.证明逻辑有错误
				 if( $ranks[$index]['ac_count'] != 0 ){

					 throw new LogicException( "sb_count为0，但是ac次数不为0" );
				 }else if( $ranks[$index]['ac_count'] == 0){
				 
				 	 $ranks[$index]['ac_slash_sb'] = "-";
				 }

			 }else{

				 $ranks[$index]['ac_slash_sb'] = number_format( $ranks[0]['ac_count']/$ranks[0]['sb_count'] , 2 );
			 }
			
			 //unset( $ranks[$index]['ac_count'] );
			 //unset( $ranks[$index]['sb_count'] );
		}

		return $ranks;
	}

	static function get_ranklist( $db ){
		
		$sql = "SELECT `user_profile`.`head_img` , `ranklist`.`rank` , `user_profile`.`id` , `user_profile`.`nick` , `user_profile`.`motto` , 
			`user_profile`.motto , `user_judge_statistics`.sb_count , 
			`user_judge_statistics`.ac_count , `user`.`last_login_time`
			FROM ranklist, user_profile , user_judge_statistics , user 
			WHERE `ranklist`.`user_id` = `user_profile`.id and `user`.`id` = `user_profile`.`id`
		        AND ranklist.user_id =	user_judge_statistics.user_id 
			ORDER BY ranklist.rank";

		//第2个参数是设置缓存, 关于缓存设置@see db.class.php
		$ranks = self::calc_ratio( $db->query_fetch( $sql ) );

		return $ranks;
	}	

	//用于首页小部件，获得排名前十的用户
	static function get_top_10( $db ){
		 
		$sql = "SELECT ranklist.rank , user_profile.nick , 
			user_judge_statistics.sb_count , user_judge_statistics.ac_count
			FROM ranklist, user_profile , user_judge_statistics
			WHERE ranklist.user_id = user_profile.id 
		        AND ranklist.user_id =	user_judge_statistics.user_id 
			ORDER BY ranklist.rank LIMIT 0,10";
	 	 
	 	//对结果进行处理，计算 ac_count/sb_count 
		$ranks = self::calc_ratio( $db->query_fetch( $sql ) );

		return $ranks;
	}
}


