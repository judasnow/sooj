<?php
session_start();
require_once( "./db.php" );

if ( $_SESSION[ 'SOOJ_BUGS_INIT' ] != true ){
	 
	header( "Loaction: ./" );
}

$staff_id = $_POST[ 'username' ];
$passwd = md5( $_POST['password'] );

$sql = "select * from staff where `staff_id`='$staff_id' and `passwd`='$passwd'";

$res = mysqli_query( $db , $sql );
if( $res ){

	if( mysqli_num_rows( $res ) == 1){
	//登录成功 
		$_SESSION[ 'staff_info' ] = $staff_id;
		header( "Location: ./" );
	}else{
		 echo "Username or password is invalid . <a href='./?action=login'>Go back.</a>"; 
	}
}else{

	echo "Username or password is invalid . <a href='./?action=login'>Go back.</a>"; 	 
}
