<?php
/**
 * 定义对于代码的相关操作
 *
 * @author <judasnow@gmail.com>
 */
class code_process{

	/**
	 * 数据库连接库
	 *
	 * @var $db 
	 */
	private $db;

	/**
	 * code 表对应的数据库操作类
	 * 
	 * @var $db_obj_code
	 */
	private $db_obj_code;

	/**
	 * array格式的code数据用于缓存
	 * 
	 * @var array $code_info
	 */
	private $code_info;

	/**
	 * 对应题目的测试用例
	 *
	 * @var array $test_case_info 
	 */
	private $test_case_info;

	/**
	 * 处理代码评测的对象
	 * 
	 * @var mixed 
	 */
	private $judge_proc;

	function __construct( $db ){
		 
		$this->db = $db;
		$this->db_obj_code = new db_obj_code( $db );
		$this->judge_proc = new judge_process( $db );
	}

	/**
	 * 保存当前代码信息( $this->code_info )到缓存中
	 * 先缓存代码信息,之后缓存测试用例
	 *
	 * @return bool 
	 */
	private function set_cache(){

		//初始化缓存对象
	 	$cache = app::init_cache();

		//保存代码信息到 cache 中
		//进行 json 编码先
		$json_code_info = json_encode( $this->code_info );
		if ( !$cache->set( $this->code_info['no'] , $json_code_info , 90 ) ){
			
		         //如果设置缓存失败
			 return false;
		}
	
		//查看缓存中是否存在该题目的测试用例
		//注意！测试用例的缓存使用题号作为键值
		$is_cache_test_case = $cache->get( $this->code_info['problem_no'] );

		if( empty( $is_cache_test_case ) ){
			 	 
			 //缓存没有命中
			 //从数据库中获取测试用例信息
			 $this->test_case_info = $this->db_obj_code->get_test_case();
			 $json_test_case_info = json_encode( $this->test_case_info );
			 if( $cache->set( $this->code_info['problem_no'] , $json_test_case_info , 90 ) ){
			 	 
			 	 //如果设置缓存失败
			 	 return false;
			 }

			 return true;
		}
	}

	/**
	 * 得到当前代码编号
	 *
	 * @return int $code_no 代码在数据库中的编号
	 */
	function get_code_no(){

		if( !isset( $this->code_no ) ){
	       	 	 
			$this->code_no = $this->db_obj_code->get_last_code_no(); 

		}
		return $this->code_no;
	}
		

	/**
	 * 保存用户代码
	 * 一式两份,一份保存到缓存中，另一份保存到数据库中
	 *
	 * @param mixed $request 用户的输入
	 * @return bool 
	 */
	function save( $request ){

		//从用户输入可以得到的信息
		//@todo 注入危险
		$problem_no = $request->get( 'problem_no' );
		$language = $request->get( 'language' );
		$user_id = $request->get( 'user_id' );
		$content = $request->get( 'content' );
		$create_time = date("Y-m-d H:i:s",time()+8*60*60);
		$last_modify = date("Y-m-d H:i:s",time()+8*60*60);

		$this->db_obj_code->set( 'problem_no' , $problem_no );
		$this->db_obj_code->set( 'language' , $language );
		$this->db_obj_code->set( 'user_id' , $user_id );
		$this->db_obj_code->set( 'content' , $content );
		$this->db_obj_code->set( 'create_time' , date("Y-m-d H:i:s",time()+8*60*60) );
		$this->db_obj_code->set( 'last_modify' , date("Y-m-d H:i:s",time()+8*60*60) );
		
		//保存到数据库中
		$this->db_obj_code->save();

		//得到code_no , 方法为同时按时间和用户查询数据库
		//@todo 方法需要改进
		$this->code_no = $no = $this->db_obj_code->get_last_code_no();

		$this->code_info = array(
			 "no"=>$no ,
			 "problem_no"=>$problem_no , 
			 "content"=>$content ,
			 "language"=>$language ,
			 "user_id"=>$user_id ,
		 );

		$this->set_cache();
	 	return true;
	}

	function do_judge(){

		return $this->judge_proc->do_judge( $this->code_no );
	}
}
