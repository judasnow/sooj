<?php
/**
 * 页面功能类
 *
 * 封装了页面的一些常用，共通的功能
 * 如:用户访问控制等
 *
 * @author <judasnow@gmail.com>
 */
class app{

	/**
	 * 返回当前执行的脚本名
	 * 注意不带后缀名
	 *
	 * @todo 将来可能会被用于单一入口的实现
	 *
	 * @return string 当前脚本的文件名但是不包含后缀名
	 */
	static function get_script_name(){

		//请求的url被按'/','\','.'分隔开，脚本名必为
		//倒数第2项。
		$request = split( '[/.\\]' , $_SERVER['SCRIPT_NAME'] );
	 	return $request[ count($request)-2 ];
	}

	/**
	 * 返回当前脚本所属模块
	 * 
	 * @return string 当前文件所属模块的名称( 当前情况下就是其文件夹名称 )
	 */
	static function get_module_name(){
		
		//请求的url被按'/','\','.'分隔开，脚本名必为
		//倒数第3项。
		//@todo 错误处理？
		$request = split( '[/.\\]' , $_SERVER['SCRIPT_NAME'] );
		return $request[ count($request)-3 ];
	}

	/**
	 * 返回应用的根目录
	 *
	 * @todo 替换现行的包含path.php的方法
	 * 不使用./path中定义的常量好处在于
	 * 重用时更为方便，没有耦合。
	 *
	 * @return string 返回应用的根目录
	 */
	static function get_app_root(){
		
		 //根据class文件夹所在的位置
		 return realpath( dirname(__FILE__) . "/../../" );
	}

	/**
	 * 返回脚本类型
	 *
	 * 按照当前脚本名称，返回脚本的类型
	 *
	 * @return string 当前脚本前缀，即其类型
	 */
	static function get_script_type(){

		$scrpit_name = self::get_script_name();
	 	//目前只有两种类型的脚本
		if( strstr( $scrpit_name , 'do_' ) ){
		
			return 'process';
		}else{
			 
			return 'display';
		}
	}

	/**
	 * 重定向函数
	 *
	 * 处理系统重定向需求
	 *
	 * @param array $redirect_info 
	 */
	static function redirect( $url , $message=array() ){

		//判断是否有信息传入
	 	if( is_array( $message ) && !empty( $message ) ){
 
			//将信息按用户提供的键名存入session中
			session::set( $message['name'] , $message['content'] );
		}
	 	
		header( "Location: $url" );
		exit();
	}

	/**
	 * 初始化cache 
	 *
	 * @return mixed cache对象或者为false
	 */
	static function init_cache(){

		//读取缓存池地址以及端口号
		$cache_config = self::get_config( 'cache' );
		$cache = new cache( $cache_config['servers'] );
	 	 
		if( $cache instanceof cache ){
			 
			return $cache;
		}else{
		
			return false;
		}	
	}	 

	/**
	 * 从配置文件中读取相应的配置
	 *
	 * @param string 需要读出的模块名称
	 * @return array 根据提供的模块，配置文件中相应的值
	 */
	static function get_config( $mod ){

		//判断是否在测试模式
		if( defined( 'TEST' ) && TEST ){
		//测试模式
			require( SOOJ_ROOT.'/config/sooj.test_config.php' );
		}else{
		//生产环境下的配置
			require( SOOJ_ROOT.'/config/sooj.config.php' );
		}

		//配置文件中的sooj数组没有设置
		if( !isset( $sooj[$mod] ) || !is_array( $sooj[$mod] ) ){

			return false;
		}

		//返回指定模块的配置信息
		return $sooj[$mod];
	}


//单入口实现所需,发展方向

	/**
	 * 加载指定模块
	 *
	 * @todo
	 */
	static function load_mod( $mod ){
	
	 	 require_once( self::get_app_root()."/include/function/$mod.function.php" );
	}

	/**
	 * 进行脚本的初始化
	 *
	 */
	static function init(){
	 	 
		//加载自动包含模块
		self::load_mod( 'autoload' );
	 	//打开session
		//session::start();

		//根据脚本类型，加载不同的模块
		switch( self::get_script_type() ){
			 
			 //逻辑处理类型的脚本，'do_'开头的
			 case 'process':
				 self::load_mod( 'db_connect' );
	 	 	 	 break;
			 case 'display':	 	 
				 break;
			 default:
			 //无法识别的脚本类型
				 break;				 
		}
	}


}

