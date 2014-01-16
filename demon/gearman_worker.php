<?php
$worker= new GearmanWorker(); 
$worker->addServer("172.17.0.46",4730);
 
$worker->addFunction("do_judge", "do_judge");
   
	while (1){
      	     
   		print "Waiting for job...\n";
	     	$ret= $worker->work();
		if ($worker->returnCode() != GEARMAN_SUCCESS)
			break;
	}

function do_judge($job){

	$workload= $job->workload();
	var_dump( $workload );
	echo "Received job: " . $job->handle() . "\n";
	echo "Workload: $workload\n";
        @$result=system("python judge.py -n$workload" );

	//将测试结果写入数据库中	
	return $result;
}
?>

