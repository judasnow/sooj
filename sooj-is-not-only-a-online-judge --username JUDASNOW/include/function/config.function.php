<?php
require_once('Config.php');

function get_setting(){

	$config = new Config();

	$config_root =& $config->parseConfig( SOJ_ROOT.'/soj_config.php', 'phparray', array('name' => 'soj'));
	
	if (PEAR::isError($config_root)) {
    		throw new Exception ('Error while reading configuration:' . $config_root->getMessage());
	}
	return $config_root; 
}
?>
