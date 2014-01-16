<?php
/**
 * 初始化smarty类，设置相应的属性。
 *
 * 各选项功能请查看smarty文档。 
 *
 * @auther 纹身特湿 <judasnow@gmail.com>
 */
require_once( './path.php' ); 
//是用版本为Smarty-2.6.26 ( 3.0版本有兼容性问题 )
require_once( SOOJ_ROOT.'/include/lib/Smarty-2.6.26/libs/Smarty.class.php' );

class custom_smarty extends Smarty{

	public function __construct(){

		$this->template_dir = SOOJ_ROOT.'/view/template/';
		$this->compile_dir = SOOJ_ROOT.'/view/template_c/';
		//smarty配置文件所在目录
		$this->config_dir = SOOJ_ROOT.'/config/';
		$this->cache_dir = SOOJ_ROOT.'/view/cache/';
		//注意smarty标签在此处已被替换为'{?'以及'?}'
		$this->left_delimiter = '{?';
		$this->right_delimiter = '?}';		
	 	 
		//未打开缓存
		$this->caching = false;
		$smarty->cache_lifetime=60;
	}
}

