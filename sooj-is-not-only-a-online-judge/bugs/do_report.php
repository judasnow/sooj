<?php
require_once "HTTP/Upload.php";
require_once( "db.php" );

foreach( $_POST as $key => $value ){

	if( empty( $value ) ){

		//可以没有截图
		if( $key = "screenshot" ){
			 
			continue;
		}
		$error_info['empty'][$key] = true;
	}	 
}

$reporter = $_POST['reporter'];
$browser = $_POST['browser'];
$bug_des = $_POST['bug_des'];

//如果用户上传了图片
$upload = new HTTP_Upload( "en" );
$file = $upload->getFiles( "screenshot" );

if ( $file->isValid() ) {
$file->setName( "uniq" );
$moved = $file->moveTo( './screenshot' );
if ( !PEAR::isError($moved) ) {

	//设置url,写入数据库
	//@todo 暂定图片在统一服务器之上
	echo $url = './screenshot/'.$file->getProp( 'name' );
} else {

	echo $moved->getMessage();
}
} elseif ( $file->isMissing() ) {
 	 	 
	 echo "No file was provided.";
} elseif ($file->isError()) {
    	 	 
echo $file->errorMsg();
}

if( @!empty( $error_info ) ){

	 die( "请完整填写bug报告单" );
}

$report_time = date( "Y-m-d H:i:s",time()+8*60*60 );
$sql = "insert into bugs 
	set `report_time`='$report_time' , `des`='$bug_des' , `status`='未处理' , `reporter`='$reporter' , `screenshot`='$url';";
$res = mysqli_query( $db , $sql );

if( $res ){
	 
	echo "
	<b>Report ok, thanks you. :-)</b>
	<p>
	After 3 second the page will redict for Index page .
	<a href='./'>Go back.</a>
	</p>
	<script>
	sleep(3);
	location.replace('./');
	</script>
	";
	exit();
}else{
	echo mysqli_error( $db );
	die( "system fail" );
}

