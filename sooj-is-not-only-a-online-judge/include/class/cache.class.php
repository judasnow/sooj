<?php
/**
 * 定义sooj的缓存行为
 * 目前使用 memcache 作为 cache 解决方案
 *
 * @author <judasnow@gmail.com>
 */
class cache{

	 /**
	  * 保存的缓存服务器资源池
	  *
	  * @var mixed memcache 类的对象 
	  */
	 private $cache;
	 
	 /**
	  * 通过用户提供的缓存地址数组，建立一个缓存池
	  *
	  * @param array 缓存地址数组
	  */
	 function __construct( $servers ){
	 	 
		 $this->cache = new memcache;
		 //遍历所有的服务器地址,建立缓存池
		 foreach( $servers as $index => $server ){	 
		
			 foreach( $server as $address => $port ){
			
				 $this->cache->addServer( $address , $port );
			 }
		 }
	 }	
	 
	 /**
	  * 包装了 memcache 类的 add 方法
	  * 但是修改了默认的缓存失效时间
	  * 注意！仅当存储空间中不存在键相同的数据时才会被保存
	  *
	  * @param string $key 用于识别缓存的键值
	  * @param mixed $value 缓存需要保存的数据
	  * @param int $expire 缓存失效的时间(秒)
	  *
	  * @return bool 
	  */
	 function add( $key , $value , $expire = 30 ){
		 
		 return $this->cache->add( $key , $value , MEMCACHE_COMPRESSED , $expire );
	 }

	 /**
	  * 包装了 memcache 类的 add 方法
	  * 和add的区别在于，无论缓存中是否已经有相应的
	  * 键存在，均保存之.
	  *
	  * @see self::add
	  */
	 function set( $key , $value , $expire = 30 ){

		 return $this->cache->set( $key , $value , MEMCACHE_COMPRESSED , $expire );
	 }

	 /**
	  * 返回所给键值在缓存中对应的值
	  * 如果对应的值存在的话
	  *
	  * @return mixed 如果存在有效值则返回之，否则返回false
	  */
	 function get( $key ){
	
	 	 return $this->cache->get( $key );
	 }

	 /**
	  * 删除所给键值在缓存中对应的值
	  * 如果对应的键存在的话
	  *
	  * @return bool
	  */
	 function delete( $key ){
	
	 	 return $this->cache->delete( $key );
	 }
}

