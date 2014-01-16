<?php
require_once( 'path.php' );
require_once( SOOJ_ROOT.'/test/test_header.php' );

class run_all_test extends TestSuite{

	function __construct(){

		parent::__construct( "run_test_all" );
	 	 
		$this->add_test_file( SOOJ_ROOT.'/test/test_function/' );
	}

	function add_test_file( $path ){
		if ( $handle = opendir( $path ) ){
			while ( false !== ( $file = readdir($handle) ) ){
				if( ereg("^test_.*php$", $file ) ){
					$this->addTestFile( $file );
				}
			}	 
			closedir($handle);
		}
	}
}

$test_all = new run_all_test();
$test_all->run( new HtmlReporter() );
