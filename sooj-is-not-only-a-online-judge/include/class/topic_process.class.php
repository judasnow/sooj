<?php
/**
 * 定义 discuss . topic 相关操作
 *
 * @author <judasnow@gmail.com>
 */
class topic_process{

	private $db;
	private $db_obj_topic;

	function __construct( $db , $request = null ){
	
		$this->db = $db;
		$this->db_obj_topic = new db_obj_topic( $db );
		//设置发帖时间
		$this->db_obj_topic->set( 'post_time' , date( "Y-m-d H:i:s",time()+8*60*60 ) );
		//设置帖子状态
		$this->db_obj_topic->set( 'status' , 0 );
	}

	function get( $key ){
	
		return $this->db_obj_topic->get( $key );	
	}
	
   	function set_status( $status ){ 
   
     		 $this->db_obj_topic->set( 'status' , $status );
	}

	function set_poster_id( $user_id ){

		return $this->db_obj_topic->set( 'poster_id' , $user_id );
	}

	function set_poster_nick( $user_nick ){

		return $this->db_obj_topic->set( 'poster_nick' , $user_nick );
	}
	
	function set_title( $title ){

		return $this->db_obj_topic->set( 'title' , $title );
	}
	
	function set_content( $content ){

		return $this->db_obj_topic->set( 'content' , $content );
	}

	function set_problem_no( $problem_no ){

		return $this->db_obj_topic->set( 'problem_no' , $problem_no );
	}

	function load( $key , $value ){

		return $this->db_obj_topic->load( $key , $value );
	}

	function save(){
	
		return $this->db_obj_topic->save();
	}

	function plus_view_count(){

		$view_count = $this->db_obj_topic->get( 'view_count' );
		$this->db_obj_topic->set( 'view_count' , $view_count+1 );
		
		return $this->db_obj_topic->save();
	}
	function plus_reply_count(){
	
		$reply_count = $this->db_obj_topic->get( 'reply_count' );
		$this->db_obj_topic->set( 'reply_count' , $reply_count+1 );

		return $this->db_obj_topic->save();
	}

	//$level 0 ~ 9
	function set_hot( $level ){
		 ;	
	}
	 
	/**
	 * 根据条件获得帖子
	 *
	 * @param object $db
	 * @param string $tags
	 * @reutrn string 
	 */
	static function get_all_topic( $db , $tags = null ){
		
		$sql = 'SELECT * 
			FROM `topic`
			ORDER BY `post_time` DESC';

		//注意缓存的设置可能会延误新帖
		return $db->query_fetch( $sql , true , 5 );		
	}

	/**
	 * 按照用户ID获得所有的帖子
	 *
	 * @param $db 数据库连接
	 * @param $poster_id 用户id
	 */
	static function get_all_topic_by_poster_id( $db , $poster_id ){
		
		$sql = "SELECT * 
			FROM topic 
			WHERE poster_id ='$poster_id'";

		return $db->query_fetch( $sql , true , 10 ); 		
	}
	/**
	 * 按照标签显示所有的帖子
	 *
	 */
	static function get_all_topic_by_tag( $db , $tag , $value ){

		//默认情况显示全部帖子 
		if( $tag == null ){
			 
			return self::get_all_reply();
		}
		$sql = "SELECT * 
			FROM `topic` 
			WHERE `$tag` = $value";
		
		return $db->query_fetch( $sql , true , 10 );
	}

	function delete(){

		 $this->db_obj_topic->delete('topic_no',$this->db_obj_topic->get('topic_no'));
	}
}
