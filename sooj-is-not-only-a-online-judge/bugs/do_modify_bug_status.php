<?php
session_start();
require_once( "./db.php" );

if ( $_SESSION[ 'SOOJ_BUGS_INIT' ] != true ){
	 
	header( "Loaction: ./" );
}

$bug_id = $_GET['id'];
$status = $_POST['value'];

if( !empty( $bug_id ) && !empty( $status ) ){

	$sql = "update bugs set `status`='$status' where `id`='$bug_id'";
	$res = mysqli_query( $db , $sql );

	if( $res ){
	
		 echo $status;
	}else{
	
		 echo "更新时发生错误,请刷新页面,重新尝试.";
	}
}
