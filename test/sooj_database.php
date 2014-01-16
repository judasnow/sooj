<?php
class create_table{
	 
	 private $sql = array(
"code"=>
"
CREATE TABLE IF NOT EXISTS `test`.`code` (
  `no` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `problem_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language` varchar(32) NOT NULL,
  `last_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` text NOT NULL,
  UNIQUE KEY `id` (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;
",
"contest"=>	
"
CREATE TABLE IF NOT EXISTS `test`.`contest` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `status` varchar(128) CHARACTER SET utf8 NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `summary` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  UNIQUE KEY `no` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;
",
"contest_problem"=>
"
CREATE TABLE IF NOT EXISTS `test`.`contest_problem` (
  `contest_id` int(11) NOT NULL,
  `problem_no` int(11) NOT NULL,
  `sorter` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
",
"cookie"=>
"
CREATE TABLE IF NOT EXISTS `test`.`cookie` (
  `cookie_hash` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expire` int(16) NOT NULL,
  PRIMARY KEY (`cookie_hash`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `user_id_2` (`user_id`),
  UNIQUE KEY `user_id_3` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
",
"judge_result"=>
"
CREATE TABLE IF NOT EXISTS `test`.`judge_result` (
  `no` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `problem_no` int(11) NOT NULL,
  `result` varchar(64) NOT NULL,
  `memory` int(11) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  `language` varchar(32) NOT NULL,
  `code_length` int(11) NOT NULL,
  `judge_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `no` (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;
",
"problem"=>
"
CREATE TABLE IF NOT EXISTS `test`.`problem` (
  `no` int(11) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `input` text COLLATE utf8_unicode_ci NOT NULL,
  `output` text COLLATE utf8_unicode_ci NOT NULL,
  `sample_input` text COLLATE utf8_unicode_ci NOT NULL,
  `sample_output` text COLLATE utf8_unicode_ci NOT NULL,
  `tip` text COLLATE utf8_unicode_ci,
  `source` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `time_limit` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `memory_limit` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `best_user` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`no`),
  UNIQUE KEY `no` (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
",
"problem_detail"=>
"
CREATE TABLE IF NOT EXISTS `test`.`problem_detail` (
  `problem_no` int(11) NOT NULL,
  `sb_count` int(11) DEFAULT '0',
  `ac_count` int(11) DEFAULT '0',
  `wa_count` int(11) DEFAULT '0',
  `tle_count` int(11) DEFAULT '0',
  `mel_count` int(11) DEFAULT '0',
  `re_count` int(11) DEFAULT '0',
  `ole_count` int(11) DEFAULT '0',
  `ce_count` int(11) DEFAULT '0',
  `se_count` int(11) DEFAULT '0',
  `ve_count` int(11) DEFAULT '0',
  `pe_count` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
",
"problem_test_case"=>
"
CREATE TABLE IF NOT EXISTS `test`.`problem_test_case` (
  `problem_no` int(11) NOT NULL,
  `input` varchar(1024) NOT NULL,
  `output` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
",
"ranklist"=>
"
CREATE TABLE IF NOT EXISTS `test`.`ranklist` (
  `rank` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `rank` (`rank`),
  UNIQUE KEY `username` (`user_id`),
  UNIQUE KEY `rank_2` (`rank`),
  KEY `rank_3` (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
",
"reply"=>
"
CREATE TABLE IF NOT EXISTS `test`.`reply` (
  `reply_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `topic_no` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `replyer_id` int(11) NOT NULL,
  `replyer_nick` varchar(128) NOT NULL,
  `reply_time` datetime NOT NULL,
  `useful` int(11) NOT NULL DEFAULT '0',
  `unuseful` int(11) NOT NULL DEFAULT '0',
  `status` varchar(16) NOT NULL DEFAULT '0',
  UNIQUE KEY `reply_no` (`reply_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;
",
"topic"=>
"
CREATE TABLE IF NOT EXISTS `test`.`topic` (
  `topic_no` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `problem_no` mediumint(9) NOT NULL,
  `title` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `poster_id` int(11) NOT NULL,
  `poster_nick` varchar(128) CHARACTER SET utf8 NOT NULL,
  `view_count` int(11) DEFAULT '0',
  `reply_count` int(11) DEFAULT '0',
  `post_time` datetime NOT NULL,
  `hot` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(44) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `topic_no` (`topic_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;
",
"user"=>
"
CREATE TABLE IF NOT EXISTS `test`.`user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(512) NOT NULL,
  `password` varchar(128) NOT NULL,
  `last_login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_ipadd` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;
",
"user_judge_statistics"=>
"
CREATE TABLE IF NOT EXISTS `test`.`user_judge_statistics` (
  `user_id` int(11) NOT NULL,
  `sb_count` int(11) DEFAULT '0',
  `ac_count` int(11) DEFAULT '0',
  `wa_count` int(11) DEFAULT '0',
  `tle_count` int(11) DEFAULT '0',
  `mel_count` int(11) DEFAULT '0',
  `re_count` int(11) DEFAULT '0',
  `ole_count` int(11) DEFAULT '0',
  `ce_count` int(11) DEFAULT '0',
  `se_count` int(11) DEFAULT '0',
  `ve_count` int(11) DEFAULT '0',
  `pe_count` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
",
"user_profile"=>
"
CREATE TABLE IF NOT EXISTS `test`.`user_profile` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `head_img` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motto` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_time` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;
"
);
	 private $db;

	 function __construct(){
	 	 
		$this->db = new db();
	 }

	 function create( $table ){
		 
		 $res = $this->db->query( $this->sql[$table] ); 
	 	 if (PEAR::isError($this->db)) {
    	 	 	 die($res->getMessage());
		 } 

		 return true;
	 }

	 function drop( $table ){
	
	 	 $drop_sql = "drop table `$table`";
		 $this->db->query( $drop_sql );
		 if (PEAR::isError($this->db)) {
    	 	 	 die($res->getMessage());
		 }

		 return true;
	}
}


