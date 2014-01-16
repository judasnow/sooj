<?php
session_start();
$_SESSION[ 'SOOJ_BUGS_INIT' ] = true;

//非工作人员
//进行功能路由
if( @!$_SESSION['staff_info'] ){

	 //普通用户只能进行登记bug操作
	 $action = "report";
}else{

	 $action = "bugs_list";
}

//如果用户请求登录
if( @$_GET['action'] == "login" ){
	 
	//判断用户是否已经登录
	if( @!$_SESSION['staff_info'] ){
		 
	 	 $action = "login";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<meta http-equiv="content-language" content="zh-CN" /> 
<meta name="robots" content="online judge, oj, poj, nankai oj, acm, icpc, sooj/>
<meta name="keywords" content="" /> 
<meta name="description" content="" /> 
<meta name="rating" content="general" /> 
<meta name="author" content="judasnow@gmail.com" /> 
<meta name="copyright" content="" /> 
<meta name="generator" content="" /> 
 
<link rel="shortcut icon" href="/sooj/view/picture/favicon.ico" type="image/x-icon"> 
 
<!-- Framework CSS --> 
<link rel="stylesheet" href="/sooj/view/css/lib/blueprint/screen.css" type="text/css" media="screen, projection"> 
<link rel="stylesheet" href="/sooj/view/css/lib/blueprint/print.css" type="text/css" media="print"> 
<!--[if lt IE 8]><link rel="stylesheet" href="../blueprint/ie.css" type="text/css" media="screen, projection"><![endif]--> 
<link rel="shortcut icon" href="/sooj/bugs/favicon.ico" /> 

<link rel="stylesheet" href="/sooj/view/css/bugs.css" type="text/css" media="screen, projection" />

<script language="javaScript" src="/sooj/view/js/lib/all.js"></script>
<script language="javaScript" src="/sooj/view/js/lib/prototype.js"></script>
<script language="javaScript" src="/sooj/view/js/lib/scriptaculous-js-1.8.3/scriptaculous.js"></script>

<title> Sooj Bug report </title>

<style>
body { font-family:verdana;overflow-y:scroll; } 
#header { color:#999;background:#deebf7;padding:10px;border-radius:10px;margin-bottom:10px;margin-top:3px;}
.title { color:#333;font-size:120%;font-weight:bold; }

#bug-list { color:#6f6f6f; }
#bug-list table{ padding:5px; }
#bug-list tr{}
#bug-list th{ color:#a6e0d5;border-bottom:5px solid #afafaf; }
#bug-list td{}
#bug-list .left-border{ border-right:2px dotted #ddd; }

#bug-detail { background:#eee; }

textarea{ border:2px solid #999;color:#6f6f6f; }
input[type="text"]{ border:1px solid #999;color:#6f6f6f;border-radius:5px; }
input[type="password"]{ border:1px solid #999;color:#6f6f6f;border-radius:5px; }
label{ font-size:110%;color:#4f4f4f; }
fieldset{ border:2px solid #999;border-radius:4px;background:#f7f7ed; }
h3{ color:#069;font-size:110%;font-weight:bold; }

#nav { clear:both;margin-left:10px;padding:5px;}
#nav a{ padding:3px;color:#fff;text-decoration:none;font-size:120%;background:#f99;border-radius:3px;margin:5px;}
#nav a:hover{ background:#faa; }

#pager{ text-align:center;color:#999;clear:both;padding-top:5px;border-top:2px dotted #aaa;}
#pager a{ color:#f99;font-size:120%; }
#pager a:hover{ color:#faa; }

#control_overlay {  
    background-color:#000;  
}
 
.modal {  
    background-color:#fff;  
    padding:10px;  
    border:1px solid #333;  
} 
 
.tooltip {  
    border:1px solid #000;  
    background-color:#fff;  
    height:25px;  
    width:200px;  
    font-family:"Lucida Grande",Verdana;  
    font-size:10px;  
    color:#333;  
} 
 
.simple_window {  
    width:250px;  
    height:50px;  
    border:1px solid #000;  
    background-color:#fff;  
    padding:10px;  
    text-align:left;  
    font-family:"Lucida Grande",Verdana;  
    font-size:12px;  
    color:#333;  
} 
 
.window {  
    background-image:url("/stylesheets/window_background.png");  
    background-position:top left;  
    -moz-border-radius: 10px;  
    -webkit-border-radius: 10px;  
    padding:10px;  
    font-family:"Lucida Grande",Verdana;  
    font-size:13px;  
    font-weight:bold;  
    color:#fff;  
    text-align:center;  
    min-width:150px;  
    min-height:100px;  
} 
 
.window .window_contents {  
    margin-top:10px;  
    width:100%;  
    height:100%;      
} 
 
.window .window_header {  
    text-align:center;  
} 
 
.window .window_title {  
    margin-top:-7px;  
    margin-bottom:7px;  
    font-size:11px;  
    cursor:move;  
} 
 
.window .window_close {  
    display:block;  
    position:absolute;  
    top:4px;  
    left:5px;  
    height:13px;  
    width:13px;  
    background-image:url("/stylesheets/window_close.gif");  
    cursor:pointer;  
    cursor:hand;  
}  
</style>

<script>

//styled examples use the window factory for a shared set of behavior  
var window_factory = function(container,options){  
    var window_header = new Element('div',{  
        className: 'window_header'  
    });  
    var window_title = new Element('div',{  
        className: 'window_title'  
    });  
    var window_close = new Element('div',{  
        className: 'window_close'  
    });  
    var window_contents = new Element('div',{  
        className: 'window_contents'  
    });  
    var w = new Control.Window(container,Object.extend({  
        className: 'window',  
        closeOnClick: window_close,  
        draggable: window_header,  
        insertRemoteContentAt: window_contents,  
        afterOpen: function(){  
            window_title.update(container.readAttribute('title'))  
        }  
    },options || {}));  
    w.container.insert(window_header);  
    window_header.insert(window_title);  
    window_header.insert(window_close);  
    w.container.insert(window_contents);  
    return w;  
};  
  
</script>

</head>

<body>
<div class="container"> 

<div id="header">
	<img src="/sooj/bugs/bug.jpg" />
	<span class="title"> Sooj bug trac system </span><br />
	<span> 感谢提交, 我们会及时修复Bug 。orz :-)</span> 
</div>

<div id="nav">
<?php
if( @!$_SESSION['staff_info'] ){
	//并且不是login页面
	if( @$_GET['action'] != 'login' ){

		echo  '<a href="?action=login">维护人员登录</a>';
	}
}else{

	echo  '<a href="do_logout.php">退出登录</a>';
}
	echo  '<a href="/sooj/controller/">回到Sooj主页</a>';
?>
</div>

<?php 
	 include( "./$action.php" );
?>

</div>

</body>

</html>

<?php
$_SESSION[ 'SOOJ_BUGS_INIT' ] = false;
?>

