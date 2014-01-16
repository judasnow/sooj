<?php
/**
 * 对用户的各种请求数据进行一个封装
 *
 * @author <judasnow@gmail.com>
 */
class request{

	/**
	 * 请求类型
	 *
	 * @var string $type 
	 */
	private $type;
	/**
	 * 存放请求变量数组
	 *
	 * @var array $request 
	 */
	private $request;
	/**
	 * 存放过滤器对象
	 *
	 * @var mixed $filter
	 */
	private $filter;

	/**
	 * 传入用户提交变量类型
	 * 生成相应的对象
	 * 
	 * @param $type 数据传入的类型
	 */
	function __construct( $type ){

	 	 //如果为 POST 类型	
	 	 if( $type == 'post' ){
	 	 	 
	 	 	 if( !isset( $_POST ) ){

	 	 	 	 throw new InvalidArgumentException( '没有post变量传入' );
	 	 	 }
	 	 	
			 $this->type = '_POST';
	 	 	 $this->request = $_POST;

		//如果为 GET 类型
		}elseif( $type == 'get' ){

	 	 	 if( !isset( $_GET ) ){

	 	 	 	 throw new InvalidArgumentException( '没有get变量传入' );
	 	 	 }

	 	 	 $this->type = '_GET';
	 	 	 $this->request = $_GET;
		}else{

	 	 	 throw new InvalidArgumentException( '指定的请求类型有误' );
		}

		$this->filter = new filter();
	}
	 
	/**
	 * 获得请求值前，对用户数据进行验证
	 * 
	 * 只有$key指向的值满足$filter的条件才会返回之
	 * 否则返回空值,默认类型为'raw',不进行任何过滤
	 * 
	 * @param string $key 需要取出的值
	 * @param string $filter 指定过滤条件
	 */
	function get( $key , $cond = 'raw' ){

		//判断键是否存在
		if( !key_exists( $key , $this->request ) ){

			 return null;
		}
		return $this->filter->do_filter( $key , $cond , $this->request );
	}

	/**
	 * 设置相应的用户 request 的
	 * 相应值
	 *
	 * @param string $key 指定的键
	 * @param mixed $value 指定的值
	 * @param mixed $value 设置成功后返回指定的值
	 */
	function set( $key , $value ){
		 
		return $this->request[ $key ] = $value;
	}

	/**
	 * 委托 filter 对象中的相应方法
	 *
	 * @param string $var 变量名
	 * @param string $cond 指定条件
	 * @return string bool 
	 */
	function is_vaild( $var , $cond ){

		return $this->filter->is_vaild( $var , $cond );
	}
}

