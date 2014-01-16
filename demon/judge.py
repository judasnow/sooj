#!/bin/python
# -*- coding: UTF-8 -*- """ 
import os
import MySQLdb
import json
import commands
import subprocess
import memcache
import time
import linecache
from optparse import OptionParser
#from multipddrocessing import Process, Pipe

#set default value
result_info = {'mem_peak':'','run_time':''} 

#write code content into file
def write_code_content_into_file( code_no , lang , content ):
   	code_file_name = "/backup/soojd/code_file/%s.%s" % ( code_no , lang )
   	code_file = open( code_file_name , 'w' )
   	code_file.write( content )
   	code_file.close()
	return code_file_name 

def set_mem_peak(pid):
   	#process status file path 
	file_path = "/proc/%s/status" % pid 
	mem_peak = linecache.getline( file_path , 11 ).split( ':' )[1].strip()
	result_info['mem_peak'] = mem_peak 

#do test per one test case 
def do_test( one_test_case ):
   	#run times 
	#start count time
   	time.clock()
   	#start count time
	test_process = subprocess.Popen( '/backup/soojd/aout/%s' % code_no , stdin=subprocess.PIPE , stdout=subprocess.PIPE )
	#write into stdin
   	test_process.stdin.write( '%s\n\r' % one_test_case[u'input'] )
	run_time = time.clock()
   	print "TEST PID : %s" % test_process.pid
   	set_mem_peak(test_process.pid)
	if test_process.returncode != None:
		#sub process return so fast !
		#read result from stdout and if one test case fail ,
		#return wa
	   	print "TEST PROCESS SO FAST!"
		if test_process.stdout.read() != one_test_case[u'output']:
			result_info['res'] = "WA"
			print json.dumps( result_info )
			exit()
		else:
			result_info['res'] = "AC"
	else:	
		print "TEST PROCESS RUNING , NOW TIME : %s" % run_time
		#sub process so solw ..
		#wait subprocess 1000MS
		time.sleep(1-run_time)
		#test_process.wait()
   		run_time = time.clock()
   		result_info['run_time'] = run_time 
   		set_mem_peak(test_process.pid)

		if test_process.poll() != None:
		   	print "AT LAST..."
			if test_process.stdout.read() != one_test_case[u'output']:
   				result_info['res'] = "WA"
				print json.dumps( result_info )
				exit()
			else:
				result_info['res'] = "AC"
		else:
		  	
		  	print "TIME IS OUT\n"
			#time out , kill subprocess
		   	test_process.terminate()
   			result_info['res'] = "TLE"
			print json.dumps( result_info )
			exit()

#todo 
def do_test_2():
   	parent_conn, child_conn = Pipe()
  	test_process = Process(target=do_test, args=(child_conn,))
	p.start()
	p.join()

#get code no from user input
parser = OptionParser()
parser.add_option("-n" , dest="codeno" , help="code no.")
(options, args) = parser.parse_args()
code_no = options.codeno

if code_no is None:
	print "No code no input."
	exit()

#try get code infomation from memcache , if they have ...
memcache = memcache.Client([ '172.17.0.46:11212' ] , debug=0)
code_info = memcache.get(code_no)


if code_info is None:
#there have no cache in memory , so try get code infomation from db 
 	print "get code info from db"
	#try connect to db server
   	db = MySQLdb.connect( 
	      host="127.0.0.1" , 
	      port=3306 , 
	      user="test" , 
	      passwd="test" , 
	      db="sooj" )
	cursor = db.cursor()
	sql = "select * from code where no=%s" % code_no
   	cursor.execute( sql )
	res = cursor.fetchall()
   	content = res[-1][-1]
   	lang = res[-1][3]
   	problem_no = res[-1][1]
	result_info['lang'] = lang
	result_info['problem_no'] = "%s" % problem_no 
	result_info['user_id'] = "%s" % res[-1][2]
	code_file_name = write_code_content_into_file( code_no , lang , content )
else:
	code_info = json.loads( code_info )
	content = code_info[u'content']
	lang = code_info[u'language']
	problem_no = code_info[u'problem_no']
	code_file_name = write_code_content_into_file( code_no , lang , content )
	user_id = code_info['user_id']
   	result_info['user_id'] = "%s" % user_id 
   	result_info['lang'] = lang
	result_info['problem_no'] = "%s" % problem_no 

#now , try get test case from memcache 
test_case_info = memcache.get( str(problem_no) )
if test_case_info is None:
	#get test case from db
   	print "get test case from db"
   	db = MySQLdb.connect( 
	      host="127.0.0.1" , 
	      port=3306 , 
	      user="test" , 
	      passwd="test" , 
	      db="sooj" , 
	      cursorclass = MySQLdb.cursors.DictCursor )
	cursor = db.cursor()
	sql = "select * from `problem_test_case` where `problem_no`=%s" % problem_no
	cursor.execute( sql )
	test_case_info = cursor.fetchall()
else:
	test_case_info = json.loads( test_case_info )

#try compile
#but with -O2 have error 
compile_status,compile_error_info=commands.getstatusoutput( "gcc %s -o ./aout/%s" % ( code_file_name , code_no ) )

#set code file length
code_file_length = os.path.getsize( code_file_name )
result_info['length'] = code_file_length

if compile_status != 0 or compile_error_info != '' :
	#compile error has occur
	result_info['res'] = 'CE' 
        result_info['compile_error_info'] = compile_error_info
   	print json.dumps( result_info )
	exit()

#try run
[ do_test(elem) for elem in test_case_info ]

#get result 
print json.dumps( result_info )
