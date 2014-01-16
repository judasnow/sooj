<?php
/**
 * 定义测试行为
 *
 * @author <judasnow@gmail.com>
 */
class judge_process{

   	private $db;
	private $judge_result_process;

	function __construct( $db ){
		
		$this->db = $db ;
		$this->judge_result_proc = new judge_result_process( $db ) ;
	}

	/**
	 * 进行评测操作
	 *
	 * @param int $code_no 需要评测的题目标号
	 * @return string json格式的评测结果 
	 */
	function do_judge( $code_no ){

		//判断os,为windows则moke之
		//引文win下gearman有问题...
		if ( PHP_OS == "WINNT" ){
			 $config = app::get_config( 'gearmand' );
	 		 //moke 结果便于测试
			 $res = '{"lang": "c", "user_id": "1", "problem_no": "1000", "res": "AC", "length": 77, "mem_peak": "8 kB", "run_time": 0.12, "code_no":"1"}';
	 	}else{
			
		   	$client= new GearmanClient();
			//从配置文件中读取 gearmand 服务器列表
			$config = app::get_config( 'gearmand' );
			foreach( $config['servers'] as $index => $server ){

				foreach( $server as $address => $port ){
			 	 	 
	 	 			 $client->addServer( $address , $port );
	 	 	 	}	 
			}
			//传递给后台进行评测，返回结果为json格式
			$res = $client->do( "do_judge" , $code_no );		
		}
		//@todo 此处的逻辑似乎有问题

		//判断返回结果是否可用
		//即是否是可用的json格式
		$res_info = json_decode( $res , true );
		if( $res_info && !empty( $res ) ){
			 
		   	 //显示结果供异步提交使用
		   	 //json 格式
			 echo $res;
		}else{
		   	
		   	//无法从后台评测系统获得结果只有再查询数据库
			//从 code 表中获得用户以及试题信息
		  	$db_obj_code = new db_obj_code( $this->db );
		        $db_obj_code->load( 'no' , $code_no );
			$user_id = $db_obj_code->get( 'user_id' );
	     		$problem_no = $db_obj_code->get( 'problem_no' );
			$lang = $db_obj_code->get( 'language' );		
			echo $res = sprintf( "{\"res\":\"VE\",\"user_id\":\"%s\",\"problem_no\":\"%s\",\"lang\":\"%s\"}" , 
			      			$user_id , $problem_no , $lang );
			$res_info = json_decode( $res , true );
		}
		
		//将测试结果写入数据库中
		return $this->judge_result_proc->insert( $res_info );
	}
}

