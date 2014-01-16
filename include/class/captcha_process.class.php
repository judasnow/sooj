<?php
/**
 * 定义验证码相关处理的类
 *
 * @todo 若动态验证码影响速度，可实现静态一些
 * 验证图片随机显示之
 *
 * @author 纹身特湿 <judasnow@gmail.com>
 */
require_once 'Text/CAPTCHA.php';

class captcha_process{

	//图片保存路径
	private $path;
	//图片保存名称
	private $img_name;

	private $options;

	private $captcha;

	function __construct(){
		//验证码图片默认存放路径
		$this->path = SOOJ_ROOT.'/view/picture/captcha/';
		//默认的图片名称为session id
		if( isset( $_COOKIE["PHPSESSID"] ) ){
		
			$this->img_name = $_COOKIE[ 'PHPSESSID' ].'.jpg';
		}else{
			
			throw new RunTimeException( '无法获取 session id , 无法指定验证图片名称' );
		}
		//定义验证码中字体及字体大小
		$this->options = array( 'font_size'=>'30' ,
			'font_path'=>SOOJ_ROOT.'/view/font/' ,
			'font_file'=>'MONACO.TTF' );
		$this->captcha = Text_CAPTCHA::factory('Image');	
	}

	function set_path( $path ){

		$this->path = $path ;
		return true ;	
	}
	function set_img_name( $img_name ){

		$this->img_name = $img_name ;
		return true ;	
	}
	function get_path_and_img_name(){

		return 	$this->path.'/'.$this->img_name;
	}
	function set_option( $options ){			

		$this->options = $options ;
		return true ;
	}
	/**
	 * 设置验证码图片大小
	 * 
	 *
	 */
	function create_img( $width = 120  , $height = 60 ){

		$this->captcha->init( $width , $height , NULL, $this->options );  
		$image = $this->captcha->getCAPTCHAAsJPEG();  

		$handle = fopen( $this->path.$this->img_name , 'w' );  
		fwrite($handle, $image);  
		fclose($handle);  

		return true ;

	}
	 
	//得到验证码图片的字符内容
	function get_phrase(){

		return $this->captcha->getPhrase();  
	}

	//删除验证码图片
	//@todo 可实现异步删除
	static function delete_img( $captcha_img ){

		return unlink( $captcha_img ) ;
	}

}
?>
