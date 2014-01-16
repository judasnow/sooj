<?php
/**
 * 定义用户回复帖子相关的操作
 *
 * @author <judasnow@gmail.com>
 */
class reply_process{

	private $db;
	/**
	 * 回复表数据库类
	 *
	 * @access private 
	 */
	private $db_obj_reply;

	/**
	 * 此条回复对应的帖子
	 * 
	 * @access private
	 */
	private $topic_proc;

	function __construct( $db , $request = null ){
		
		$this->db = $db ;

		$this->topic_proc = new topic_process( $db );
		$this->db_obj_reply = new db_obj_reply( $db );
		//设置回复时间
		$this->db_obj_reply->set( 'reply_time' , date( "Y-m-d H:i:s",time()+8*60*60 ) );
		//设置该回复默认状态
		$this->db_obj_reply->set( 'status' , 0 );
	}

	function set_replyer_id( $user_id ){

		 return $this->db_obj_reply->set( 'replyer_id' , $user_id );
	}
	function set_replyer_nick( $user_nick ){

		 return $this->db_obj_reply->set( 'replyer_nick' , $user_nick );
	}
	function set_content( $content ){
		 
		 return $this->db_obj_reply->set( 'content' , $content );
	}
	function set_topic_no( $topic_no ){

		//读出相应的主题
		$this->topic_proc->load( 'topic_no' , $topic_no );
		return $this->db_obj_reply->set( 'topic_no' , $topic_no );
	}
	function save(){
	 	 
		$this->pre_save();
		return $this->db_obj_reply->save();
	}
	
	/**
	 * 将用户回复数据存入数据库前
	 * 进行的操作目前只是增加topic表中
	 * reply计数
	 *
	 * @access priavte 
	 * @return bool 
	 */
	function pre_save(){

		return $this->topic_proc->plus_reply_count();
	}

	function delete_by_no($no){

		$sql = "DELETE FROM reply WHERE reply_no =".$no ;
		$res = $this->db->query( $sql ); 
		if (PEAR::isError($res)) {
			throw new Exception( '删除出错'.$res->getMessage() );
		}
		return true;
	}
	
	function delete_by_topic_no( $topic_no ){

		$sql = "DELETE FROM reply WHERE topic_no =".$topic_no ;
		$res = $this->db->query( $sql ); 
		if (PEAR::isError($res)) {
			throw new Exception( '删除出错'.$res->getMessage() );
		}
	}

	/**
	 * 得到指定帖子相关的所有回复内容
	 * 
	 * @access static
	 */
        static function get_all_reply( $db , $topic_no ){

		//按回复时间降序排列
		$sql = "SELECT * FROM `reply`
			WHERE `topic_no` = $topic_no
			ORDER BY `reply_time` DESC" ;
		
		return $db->query_fetch( $sql , false );		
	}
}
?>
