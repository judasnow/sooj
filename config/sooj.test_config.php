<?php
/**
 * sooj系统的配置文件(测试用)
 *
 * 与生产环境的配置文件的区别在于使用的数据库不同
 *
 * @author <judasnow@gmail.com>
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
$sooj['db']['name'] = 'test';

/**
 * 数据库系统名称
 */
$sooj['db']['dbms'] = 'mysql';

/**
 * 缓存服务器的地址
 */
$sooj['cache']['servers'] = array( "172.17.0.46"=>'11213' );

