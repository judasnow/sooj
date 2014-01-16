<?php
/**
 * sooj系统的配置文件
 *
 * @author <judasnow@gmail.com>
 */

/**
 * 数据库服务器地址,默认为Localhost
 */
$sooj['db']['host'] = '172.17.0.46';

/**
 * 数据库用户名
 */
$sooj['db']['username'] = 'test';

/**
 * 数据库链接密码
 */
$sooj['db']['password'] = 'test';

/**
 * 数据库名字
 */
$sooj['db']['name'] = 'sooj';

/**
 * 数据库系统名称
 */
$sooj['db']['dbms'] = 'mysql';

/**
 * Gearmand 服务器地址
 */
$sooj['gearmand']['servers'][0] = array( '172.17.0.46'=>'4730' );
$sooj['gearmand']['servers'][1] = array( '172.17.0.46'=>'4731' );
$sooj['gearmand']['servers'][2] = array( '172.17.0.46'=>'4732' );

/**
 * Cache 设置
 */

/**
 * 缓存服务器的地址
 */
$sooj['cache']['servers'][0] = array( '172.17.0.46'=>'11211' );
$sooj['cache']['servers'][1] = array( '172.17.0.46'=>'11212' );

//默认缓存未开启
$sooj['cache']['switch'] = 'disable';


