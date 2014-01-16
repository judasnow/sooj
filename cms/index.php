<?php
session_start();
require_once( './path.php' );

require_once( SOOJ_CMS_ROOT . '/models/front_controller.class.php' );
require_once( SOOJ_CMS_ROOT . '/models/Icontroller.interface.php' );
require_once( SOOJ_CMS_ROOT . '/models/view.class.php' );

//加载控制器
require_once( SOOJ_CMS_ROOT . '/controllers/index.php' );
require_once( SOOJ_CMS_ROOT . '/controllers/auth.php' );
require_once( SOOJ_CMS_ROOT . '/controllers/problem_manager.php' );
require_once( SOOJ_CMS_ROOT . '/controllers/contest_manager.php' );
require_once( SOOJ_CMS_ROOT . '/controllers/user_manager.php' );
require_once( SOOJ_CMS_ROOT . '/controllers/discuss_manager.php' );

$front = front_controller::get_instance();
$front->route();

echo $front->get_body();
