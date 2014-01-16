<?php
/**
 * 返回指定模块的配置信息
 *
 * 直接在函数中包含配置文件
 * 在配置文件中定义了一个二维数组
 *
 * @see SOOJ_ROOT./config/sooj.config.php
 * @author <judasnow@gmail.com> 
 */

/**
 * 返回从配置文件中取出来的相应值
 *
 * @param string $mod 需要从配置文件中取出的属性
 * @return string $sooj[$mod] 传入属性对应的值
 */

//@todo 把这个函数加入到 app 类中 
function get_config( $mod ){

	//判断是否在测试模式
	if( defined( 'TEST' ) && TEST ){
	//测试模式
		require( SOOJ_ROOT.'/config/sooj.test_config.php' );
	}else{
	//生产环境下的配置
		require( SOOJ_ROOT.'/config/sooj.config.php' );
	}

	//配置文件中的sooj数组没有设置
	if( !isset( $sooj ) || !is_array( $sooj )){

		throw new LogicException( '读取配置文件错误。' );
	}

	//返回指定模块的配置信息
	return $sooj[$mod];
}

