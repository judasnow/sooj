<?php
require_once( SOOJ_ROOT.'/include/class/DatabaseException.class.php' );
/**
 * 实现ActionRecord
 *
 * 使用此类要求数据表必须有一个值唯一的主键
 *
 * @author <judasnow@gmail.com>
 */
abstract class db_obj{

	/**
	 * 存放数据库对象
	 * 派生类不参与数据库操作
	 *
	 * @access protected
	 * @var $db object of MDB2
	 */
	protected $db;

	/**
	 * 保存派生类相应的数据表的表名
	 *
	 * @access protected
	 * @var string
	 */
	private $table_name ;
	
	/**
	 * 存放派生类相应数据表的属性名集合
	 *
	 * @access private
	 * @var array 
	 */
	protected $properties = array();

	/**
	 * 表明当前记录是否是数据库中已经存在,而
	 * save()函数以此属性为依据决定是使用INSERT
	 * 还是UPDATE来保存当前的数据进入数据库中
	 * 
	 * @access private
	 * @var bool 
	 * @see load()
	 * @todo 当前此属性只能由load()函数在成功调用之后更改之
	 * 	 或有has_exists()函数显式的更改
	 */
	private $has_exists = false ;

	/**
	 * 保存数据库表的主键
	 *
	 * @access private
	 * @var string 
	 */
	private $primary_key ;

	//function __sleep(){}
	
	/**
	 * 反序列化时恢复数据库连接
	 *
	 */
	function __wakeup(){
		 
		$this->db = new db();
	}

	/**
	 * 构造函数,接受数据库连接对象以及派生类对应的数据表名和
	 * 派生类对应的数据表的主键名作为参数
	 *
	 * @access protected
	 * @param mixed $db 数据库对象
	 * @param string $table_name 子类代表的数据表的名称
	 * @param string $primary_key 数据表主键名
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
	 * @param mixed $request 保存有用户传入参数的requset对象
	 * @see class request
	 */
	protected function init( $request = null ){
	
		if ( !empty( $request ) ){
			
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
	 * @param string $key 键名
	 * @param string $default_value 该键对应的默认值
	 */
	protected function add( $key , $default_value ){
		
		$this->properties[$key] = $default_value ;
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
	 * @param string $k 想要取得值的键
	 * @return mixed $v 对应键的值 
	 */
	public function get( $k ){
	 	 
		return $this->properties[$k]['v'];
	}

	/**
	 * 返回当前对象对应数据表的名字
	 * 
	 * @return string 返回当前对象表示的数据表的名字
	 */
	public function get_table_name(){

		return $this->table_name; 
	}

	/**
	 * 判断所给键值对的记录是否已经存在于数据库之中
	 *
	 * @todo 未证明其存在的价值
	 */
	private function has_exists( $primary_key , $v ){

		$sql = "SELECT * FROM $this->table_name WHERE $primary_key ='$v'";
		$res = $this->db->query( $sql );
	
		if( $res->error ){

			return false  ;
		}
		
		if( $res->NumRows() == 1 ){

			$this->has_exists = true ;
			return true ;
		}
		if( $res->NumRows() == 0 ){

			return false ;
		}else{

			throw new DatabaseException( "数据库异常:记录不唯一:$sql:".$res->getMessage() );
		}
	}

	/**
	 * 查看传入参数是否为空，以及$k是否在数组properties中
	 *
	 */
	public function check_param( $k , $v ){
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
	 * @param bool $is_transactions 标志是否使用事务处理之
	 * @return bool 成功返回真，相应的失败返回假
	 */
	public function save( $is_transactions = false ){

		/*设置使用事务
		if( $is_transactions ){
			//测试当前使用的数据库驱动是否支持事务处理
			if ( !$this->supports('transactions') ) {
				throw new DatabaseException( 'this dbms is not support transactions.' );  
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
			@$values[] = "$k='" . $v["v"] . "'";
		}

		$values = join( ',' , $values );
		//只有两种可能,因此没有必要抽象之
		if( $this->has_exists ){

			$sql = "UPDATE $this->table_name SET $values
				WHERE $this->primary_key='" . $this->properties[$this->primary_key]['v']."'";
		}else{	

			$sql = "INSERT INTO $this->table_name SET $values";
		}

		@$res = $this->db->query( $sql );
		if( PEAR::isError( $res ) ){
			
			throw new DatabaseException( "数据库查询异常:$sql:".$res->getMessage() );
		}

		return true;
	}

	/**
	 * 根据传入的键值对，查寻数据库并返回相应的值
	 *
	 * @param string $primary_k 键名，默认为构造函数中指定的主键
	 * @param mixed $v 
	 * @return bool 成功返回真，相应的失败则返回假，或抛出异常
	 */
	public function load( $primary_k = 'no' , $v = false ){
			
		if ( !$this->check_param( $primary_k , $v ) ){

			throw new DatabaseException( "传入load()函数的参数格式不正确:( $primary_k , $v )" );	
		}

		$condition = "`$primary_k`='$v'";
		$sql = "SELECT * FROM `$this->table_name` WHERE $condition";
		$res = $this->db->query( $sql );
		
		if ( PEAR::isError( $res ) ){

			throw new DatabaseException( "数据库查询异常:".$sql.':'.$res->getMessage() );
		}

		if ( $res->numRows() == 0 ){

			//throw new DatabaseException( "数据库中无相应的记录:$sql:" );
			return false;
		}

		if ( $res->numRows() != 1 ){

			throw new DatabaseException( "数据库异常:主键不唯一:$sql" );
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
		return true;
	}
	
	/**
	 * 删除数据项
	 *
	 * 根据传入的键值对在数据表中删除相应的记录
	 *
	 * @param string $k
	 * @param mixed $v 
	 * @return bool 
	 */
	public function delete( $k , $v ){
	
		if ( !$this->check_param( $k , $v ) ){

			throw new DatabaseException( 'delete 参数错误' );	
		}

		$sql = "DELETE FROM `$this->table_name` WHERE `$k` = '$v' LIMIT 1" ;
		$res = $this->db->query( $sql );

		if ( PEAR::isError( $res ) ){

			throw new DatabaseException( "数据库查询错误:$sql:".$res->getMessage() ) ;
		}

		return true;
	}

	/**
	 * 重置以各表中的所有数据
	 *
	 * @return bool
	 */
	public function reset(){
		
		$sql = "TRUNCATE TABLE $this->table_name";
		return $res = $this->db->query( $sql );
	}

	//对于指定的值执行加1操作
	function plus( $key ){

		//转换成小写
		//数据库中命名都为小写切命名注意规则
		//名称_count 
		$key = strtolower( $key );
		$count = $this->get( $key.'_count' );
		$count += 1;
		$this->set( $key.'_count' , $count );

		return $this->save();
	}
}

