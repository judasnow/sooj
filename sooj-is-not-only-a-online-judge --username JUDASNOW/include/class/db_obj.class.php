<?php
/**
 * 实现ORM
 *
 * 使用此类要求数据表必须有一个值唯一的主键
 *
 * @author 纹身特湿 <judasnow@gmail.com>
 */
abstract class db_obj{

	/**
	 * 存放数据库对象
	 * 派生类不参与数据库操作
	 *
	 * @access private
	 */
	private $db;

	/**
	 * 保存派生类相应的数据表的表名
	 *
	 * @access protected
	 */
	private $table_name ;
	
	/**
	 * 存放派生类相应数据表的属性名集合
	 *
	 * @access private 
	 */
	private $properties = array();

	/**
	 * 表明当前记录是否是数据库中已经存在,而
	 * save()函数以此属性为依据决定是使用INSERT
	 * 还是UPDATE来保存当前的数据进入数据库中
	 * 
	 * @acess private 
	 * @see load()
	 * @todo 当前此属性只能由load()函数在成功调用之后更改之
	 * 	 或有has_exists()函数显式的更改
	 */
	private $has_exists = false ;

	/**
	 * 保存数据库表的主键
	 *
	 * @access private 
	 */
	private $primary_key ;

	/**
	 * 构造函数,接受数据库连接对象以及派生类对应的数据表名和
	 * 派生类对应的数据表的主键名作为参数
	 *
	 * @access protected
	 */
	protected function __construct( $db , $table_name , $primary_key = 'no' ){

		$this->db = $db ;
		$this->table_name = $table_name ;
		$this->primary_key = $primary_key ;

	}

	/**
	 * 通过用户提交的数据来初始化对象
	 *
	 * @access protected
	 */
	protected function init( $request = null ){
	
		if ( !empty($request) ){
			
			foreach( $request as $k => $v ){
	
				$this->set( $k , $v ); 
			}
		}
	}
	/**
	 * 派生类在构造函数中使用此函数
	 * 将自己所代表的数据表的属性添加
	 * 进数组properties[]中,同时可以设置
	 * 相应属性的默认值
	 *
	 * @access protected 
	 */
	protected function add( $k , $default_v ){
		
		$this->properties[$k] = $default_v ;
	}

	/**
	 * 设置对象中相应属性的值,注意此方法并未改变数据库
	 *
	 * @access public 
	 * @todo 若对象中并无所请求的属性,抛出异常
	 *
	 * @version 1.3 改进不仅设置相应属性的值,还标记该属性的值已经改变
	 * 	        以免在save时进行不必要的操作
	 * 	        改变的记录在调用load函数之后会被清空 
	 */
	public function set( $k , $v ){

		$this->properties[$k] = array ( 'v' => $v , 'change' => true ) ;
		return true ;
	}
	/**
	 * 返回对象中相应属性的值,注意此值并不一定代表数据库中的情况
	 *
	 * @access public 
	 */
	public function get( $k ){

		return $this->properties[$k]['v'] ;
	}
	/**
	 *返回当前对象对应数据表的名字
	 *
	 *
	 */
	public function get_table_name(){

		return $this->table_name; 
	}

	/**
	 *判断所给键值对的记录是否已经存在于数据库之中
	 *
	 *
	 *@todo 未证明其存在的价值
	 */
	private function has_exists( $primary_key , $v ){

		$sql = "SELECT * FROM $this->table_name WHERE $primary_key ='$v'";
		$res = $this->db->query( $sql );
	
		if( PEAR::isError($res) ){

			return false  ;
		}
		
		if( $res->NumRows() == 1 ){

			$this->has_exists = true ;
			return true ;
		}
		if( $res->NumRows() == 0 ){

			return false ;
		}else{
			throw new Exception('数据库异常:记录不唯一.sql='.$sql);
		}
	}

	public function check_param( $k , $v ){
	//看是否为空,以及$k是否在数组properties中
		if ( !$v ){	
			//没有完整的参数,则没有办法保证结果的
			//唯一性,则应该期待返回异常
			return false ;

		}else{
			return true ;
		}
	}

	/**
	 * 唯一的写数据库操作函数
	 * 参数决定了是否使用事务
	 * 处理
	 *
	 * 
	 */
	public function save( $is_transactions = false ){

		/*设置使用事务
		if( $is_transactions ){
			//测试当前使用的数据库驱动是否支持事务处理
			if ( !$this->supports('transactions') ) {
				throw new Exception( 'this dbms is not support transactions.' );  
			}
			$res = $this->db->beginTransaction();	
		}
		 */

		foreach( $this->properties as $k => $v ){
			//如果是no之类的自动生成属性则跳过
			//若没有改变的属性也会跳过
			if ( $k == 'no' || @!$v['change']){
			
				continue ;
			}

			//@todo 为何此处会出现异常?
			@$values[] = "$k='".$v["v"]."'";
		}

		$values = join( ',' , $values );
		//只有两种可能,因此没有必要抽象之
		if( $this->has_exists ){

			$sql = "UPDATE $this->table_name SET $values
				WHERE $this->primary_key='".$this->properties[$this->primary_key]['v']."'" ;
		}else{	

			$sql = "INSERT INTO $this->table_name SET $values" ;
		}	

		$res = $this->db->query( $sql );
		if( PEAR::isError($res) ){
		
			throw new Exception("数据库查询异常:$sql".':'.$res->getMessage()) ;
		}
		
		return true ;
	}


	public function load( $primary_k = 'no' , $v = false ){
			
		if ( !$this->check_param( $primary_k , $v ) ){

			throw new Exception( "传入load()函数的参数格式不正确:($primary_k,$v)" );	
		}
		$condition = "`$primary_k`='$v'" ;

		$sql = "SELECT * FROM `$this->table_name` WHERE $condition" ;
		$res = $this->db->query( $sql );
		
		if (  PEAR::isError($res) ){

			throw new Exception("数据库查询异常:".$sql.':'.$res->getMessage()) ;
		}
		if ( $res->NumRows() == 0 ){

			throw new Exception('数据库中无相应的记录:sql=:'.$sql);
		}
		if ( $res->NumRows() != 1 ){

			throw new Exception('数据库异常:主键不唯一:'.$sql);
		}
		
		$rows = $res->fetchRow( MDB2_FETCHMODE_ASSOC );

		if ( !$rows ){
			
			return false ;
		}

		//将返回的值赋于该对象中
		foreach( $rows as $k => $v ){
			
			$this->properties[$k]['v'] = $v;
			$this->properties[$k]['change'] = false ;
		}

		$this->has_exists = true ;
		return true ;


	}
	
	//删除数据项 
	public function delete( $k , $v ){
		
		if ( !$this->check_param( $k , $v ) ){
			throw new Exception( '' );	
		}

		$sql = "DELETE FROM `$this->table_name` WHERE $k = '$v' LIMIT 1" ;
		$res = $this->db->query( $sql );
		if ( PEAR::isError($res) ){
			throw new Exception('数据库查询错误:'.$res->getMessage().':'.$sql) ;
		}

		return true ;
	}	

	public function reset(){
		
		$sql = "TRUNCATE TABLE $this->table_name";
		$res = $this->db->query( $sql );

		return true ;
	}
	
}
?>
