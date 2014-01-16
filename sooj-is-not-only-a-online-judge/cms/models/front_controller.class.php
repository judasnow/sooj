<?php
//前端控制器
class front_controller{

	protected $_controller; 
	protected $_action;
	protected $_params;
	protected $_body;

	static $_instance;

	//实现单例
	public static function get_instance(){

		if( !self::$_instance instanceof self ){
		
			self::$_instance = new self();
		} 
		return self::$_instance;
	} 

	private function __construct(){

		//得到用户请求的uri
		$request_uri = $_SERVER['REQUEST_URI'];

		$splits = explode( '/' , trim( $request_uri , '/' ) );

		//得到控制器信息
		$this->_controller = !empty( $splits[2] )?$splits[2]:'index';
		//得到具体的操作信息
		$this->_action = !empty( $splits[3] )?$splits[3]:'index';
		if( !empty( $splits[4] ) && !empty( $splits[5] ) ){
		
			$keys = $values = array();
			for( $idx = 4 , $cnt = count( $splits ) ; $idx < $cnt ; $idx++ ){
			
				if( ( $idx % 2 )== 0 ){
					 
					 $keys[] = $splits[ $idx ];
				}else{
				
					 $values[] = $splits[ $idx ];
				}
			}
			$this->_params = array_combine( $keys , $values );
		}
	}

	public function route(){
	
		if( class_exists( $this->get_controller() ) ){
		
			$rc = new ReflectionClass( $this->get_controller() );
			
			if( $rc->implementsInterface( 'Icontroller' )){ 
					if( $rc->hasMethod( $this->get_action() ) ){
				
					$controller = $rc->newInstance();
					$method = $rc->getMethod( $this->get_action() );
					$method->invoke( $controller );
					}else{
				
						 throw new Exception( 'action not define' );
					}	 	 	
			}else{
			
				 throw new Exception( 'interface not define' );
			}
		}else{
			
			 throw new Exception( 'controller not define' );
		}
	}

	public function get_params(){
		 
		return $this->_params;
	}

	public function get_controller(){
	
	 	return $this->_controller;
	}

	public function get_action(){
	
		 return $this->_action;
	}

	public function get_body(){
	
		 return $this->_body;
	}

	public function set_body( $body ){
		 
		$this->_body = $body;
	}
}


