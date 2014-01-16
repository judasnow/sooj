import os
import gearman

#create a worker
worker = gearman.GearmanWorker(["127.0.0.1"])

def do_judge(code_no):
	#print os.system( "./python judge -n%s" % code_no )       
	print "I`s work!"

worker.register_task( "do_judge" , do_judge )
print worker.work()
