<div id="bug-list" class="span-22 prepend-1"> 
<table> 
	 <tr> 
		 <th class="span-3">Bug 编号</th> 
		 <th class="span-3">提交时间</th> 
		 <th class="span-2">状态</th> 
	 	 <th class="span-5">简要描述</th> 
		 <th class="span-2">提交者</th>
		 <th class="span-2">截图</th> 
	 </tr> 

<?php
require_once( 'db.php' );
require_once( 'Pager.php' );

$sql = "select *
	from bugs
	order by `id` desc";

$res = mysqli_query( $db , $sql );
if( $res ){

	$i = 0;
	while( $row = mysqli_fetch_assoc( $res ) ){
	 	 
		//先全部保存在一个数组中
		foreach( $row as $key=>$value ){
		
			 $bugs[$i][$key] = $value;
		}
		$i++;
	}
}	

if( @empty( $bugs )){

	 echo "<span>There no bugs yet..... :-)</span>";
}else{

//分页处理
//此配置应该可以由配置文件读出
$params = array(
	'itemData' => $bugs,
	'perPage' => 10,
	'delta' =>8,             
	'append' => true,
	'clearIfVoid' => false,
	'urlVar' => 'entrant',
	'useSessions' => true,
	'closeSession' => true,
	'mode'  => 'Jumping',
);

$pager =& Pager::factory( $params );
$page_data = $pager->getPageData();
$links = $pager->getLinks();

foreach( $page_data as $key=>$row ){

	echo "<tr>";
	foreach( $row as $key=>$value ){
		$id = $row['id'];
		//对于截图进行处理
		if( $key == 'screenshot' ){
			
			if( @fopen( $value , 'r' ) ){
				
				echo "
<td><a href='$value' id='$id'>Bug 截图</a></td>
<script>
var modal = new Control.Modal($('$id'),{  
    overlayOpacity: 0.75,  
    className: 'modal',  
    fade: true  
});  
</script>";
				continue;
			}else{

				echo "<td>未提供</td>";
				continue;
			}
		}

		if( $key == 'status' ){

			echo "
<td><span class='$id'>$value</span>
<script>
new Ajax.InPlaceCollectionEditor( $$( 'span.$id' )[0] , 
	 './do_modify_bug_status.php?id=$id' , 
	{ okText:'修改' , 
	  cancelText:'取消' , 
	  savingText:'修改中...' , 
	  clickToEditText:'点击修改状态', 
	  collection:['处理中','已经修复','没有再现错误'] 
});
</script>	
				     ";
	 	 	continue; 
		} 
	
		echo "<td>$value</td>";
	}
	echo "</tr>";
}

?>

</table> 
</div>
<div id="pager">
<?php 
echo $pager->links; 
}
?>
</div>

