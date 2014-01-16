<?php
require_once( SOOJ_CMS_ROOT.'/models/Icontroller.interface.php' );
require_once( SOOJ_CMS_ROOT.'/models/view.class.php' );

class index implements Icontroller{

	public function index(){

		//@todo bug index 方法会被执行两次
		 
		header( 'Location: /sooj/cms/auth/' );
		exit;
	}
}
