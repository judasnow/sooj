<?php
/**
 * 定义系统根目录,系统中的每一个文件夹都应该包含该文件.
 * 
 * 根据不同层次的文件夹,其后的'../'应该有相应的不同层次.
 * 如:在'/sooj/controller/account/'目录下就应该使用'/../../'
 * 使得SOOJ_ROOT被定义为'/sooj/'
 *
 * @author 纹身特湿 <judasnow@gmail.com>
 */
define("SOOJ_ROOT", realpath( dirname(__FILE__) . "/../../") );
