<?php
/**
 * 生产环境中自动加载类的函数.
 * 
 * 包含此函数的脚本可以自动包含需要的类文件.
 *
 * @author 纹身特湿 <judasnow@gmail.com>
 */
function __autoload ( $class_name ){

	require_once( SOJ_ROOT.'/include/class/'.$class_name.'.class.php' );
}
?>
