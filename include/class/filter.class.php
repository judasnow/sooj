<?php
/**
 * 提供变量验证以及过滤功能的类
 *
 * @author <judasnow@gmail.com> 
 */
class filter{

	/**
	 * 当前被支持的验证有效的条件
	 *
	 * @var array $vaild_cond
	 */
	private $vaild_cond;

	/**
	 * 当前被支持的过滤的条件
	 *
	 * @var array $filter_cond
	 */
	private $filter_cond;

	function __construct(){

		$this->vaild_cond = array(

			'username' => FILTER_CALLBACK , 
			'nick' => FILTER_CALLBACK , 
			'email' => FILTER_VALIDATE_EMAIL ,
			'int' => FILTER_VALIDATE_INT ,
			'bool' => FILTER_VALIDATE_BOOLEAN ,
			'url' => FILTER_VALIDATE_URL ,
			'ip' => FILTER_VALIDATE_IP , 
		);

		$this->filter_cond = array(

			'raw' => FILTER_UNSAFE_RAW ,
			'string' => FILTER_SANITIZE_SPECIAL_CHARS ,
			'encoded' => FILTER_SANITIZE_ENCODED ,
	 	 	'char' => FILTER_SANITIZE_SPECIAL_CHARS , 
			'magic' => FILTER_SANITIZE_MAGIC_QUOTES ,
			'url' => FILTER_SANITIZE_URL ,
			//帖子内容的过滤
			'post' => FILTER_CALLBACK
		);
	}

	/**
	 * 验证用户名
	 *
	 * @param string $username 用户名
	 * @return bool 
	 */
	static function username( $username ){

		//用户名可用字符的范围 数字字母，长度 3-32	
		return preg_match( '/^[a-zA-Z0-9_\@\.]{3,32}$/' , $username );
	}

	/**
	 * 验证用户昵称
	 *
	 * @param string $nick 昵称
	 * @return bool 
	 */
	static function nick( $nick ){

		//汉字字母数字, 长度 3-16
		return preg_match( '/[\x00-\xffa-zA-Z0-9_]{3,16}/' , $nick );
	}

	/**
	 * 验证帖子内容
	 *
	 * @param $content
	 * @return bool 
	 */
	static function post( $content ){
	 	 
		//仅可以使用一下的几种 html 标签 
		return strip_tags( $content , "<b><p><img><code><em><br>" );
	}

	/**
	 * 根据条件判断变量是否有效
	 *
	 * @return bool 
	 * @todo 此处传入变量初始值不能为空
	 */
	function is_vaild( $var , $cond ){

		if( empty( $this->vaild_cond[ $cond ] ) ){
			
			 throw new InvalidArgumentException( '不被支持的验证类型:'.$cond );
		}

		$cond_code = $this->vaild_cond[ $cond ];

		//自定义过滤
		if( $cond_code == FILTER_CALLBACK ){
	 	 	
			//调用本类内定义的callback函数
			$call_back = "filter::$cond";
			if( !is_callable( $call_back ) ){

				 throw new InvalidArgumentException( '没有找到内建过滤函数:'.$cond );
			}
			if( filter_var( $var , $cond_code  , array( "options"=>$call_back ) ) ){

				return true;
			}else{

				return false;
			}
		}
		if( filter_var( $var , $cond_code ) ){
			
			return true;
		}else{

			return false;
		}
	}

	/**
	 * 根据条件过滤变量
	 *
	 * @param string $key 
	 * @param string $cond 
	 * @param array $request 
	 * @return bool
	 */
	function do_filter( $key , $cond , $request ){

		if( empty( $this->filter_cond[ $cond ] ) ){
		
			 throw new InvalidArgumentException( '不被支持的过滤类型:'.$cond );
		}
	 
		$cond_code = $this->filter_cond[ $cond ];

		//自定义过滤
		if( $cond_code == FILTER_CALLBACK ){
	 	 	 
			$call_back = "filter::$cond";
			if( !is_callable( $call_back ) ){

				 throw new InvalidArgumentException( '没有找到内建过滤函数:'.$cond );
			}

			return filter_var( $request[$key] , $cond_code  , array( "options"=>$call_back ) );
		}

		return filter_var( $request[ $key ] , $cond_code );
	}
}
