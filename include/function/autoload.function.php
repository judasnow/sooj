<?php
/**
 * 生产环境中自动加载类的函数.
 * 
 * 包含此函数的脚本可以自动包含需要的类文件.
 *
 * @author <judasnow@gmail.com>
 */

//清除之前注册的加载类
spl_autoload_register( null , false );

//指明系统中类文件的特殊后缀
spl_autoload_extensions('.class.php');

function classLoader( $class ){

	$filename = strtolower( $class ).'.class.php';
	$file =SOOJ_ROOT.'/include/class/'.$filename;

	if ( !file_exists( $file ) ){

		return false;
	}
	require $file;
}

spl_autoload_register( 'classLoader' );

//@todo  移入app类中
//使能测试模式
define( "DEBUG" , true );
