<?php
	session_start(); 
 
 	$_SESSION['session']=1; 

	$link = mysql_connect ('localhost', 'eevm', 'eventfeed1990', 'hackatl_Internal') 
	or die (mysql_error()); 

	if (!@mysql_select_db('hackatl_Internal', $link)) 
	{    
     	echo "<p>This is the error message: System cannot connect to database.</p>"; 
     	echo "<p><strong>" . mysql_error() . "</strong></p>"; 
     	echo "Please email eevm@eevm.org for support."; 
    } 

   if(isset($_COOKIE['regno']) && isset($_COOKIE['username']) && isset($_COOKIE['password']))
	{
		$regno = $_COOKIE['regno'];
		$Binfo = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = $regno"));
		if($Binfo[3] == NULL){ $Binfo[3] = $Binfo[1];}

		if($Binfo[15] != 0)
		{
			$inT = 1;
			$Tinfo = mysql_fetch_array(mysql_query("SELECT * FROM Team_info WHERE Team_no = $Binfo[15]"));
		}
		else{ $inT = 0;}
	}
	else{ header('Location: /2013/login.html');}


	if(isset($_POST['profilechange'])){ header('Location: profilechange.php');}
	if(isset($_POST['teamprofilechange'])){ header("Location: teamprofilechange.php");}
	if(isset($_POST['roomreservation'])){ header("Location: roomreserve.php");}
	if(isset($_POST['advisorreservation'])){ header("Location: advisorreserve.php");}
	if(isset($_POST['findateam'])){ header("Location: teamfinder.php");}
	if(isset($_POST['findteammate'])){ header("Location: teammatefinder.php");}

	if(isset($_POST['logout']))
	{
		setcookie('regno', NULL, false, '/2013/', '.hackatl.org');
		setcookie('username', NULL, false, '/2013/', '.hackatl.org');
    	setcookie('password', NULL, false, '/2013/', '.hackatl.org');
		header("Location: login.html");
	}




?> 


<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<title><?php echo $Binfo[1] . " " . $Binfo[2]; ?> - HackATL</title>
        <link href="dist/css/bootstrap.css" rel="stylesheet">
        <link href="jumbotron.css" rel="stylesheet">
        <meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <style>
        	.list-group a:hover{
        		cursor: pointer;
        	}
        </style>
	</head>
	<body>
		<form id="form" method=post action="index.php">
		<!-- header start-->
		<div class="navbar navbar-default navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="../../index.html" onclick="OpenLink(this); return false"><img src = "../img/hackATLLogo2.png" atl = "hackATL" width = "60" height = "20"></a>
	        </div>
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav">
	            <li><a href="index.php" onclick="OpenLink(this); return false">Home</a></li>
	            <li><a href="detailed_schedule.php" onclick="OpenLink(this); return false">Schedule</a></li>
	            <li><a href="comp_guidelines.php" onclick="OpenLink(this); return false">Guidelines</a></li>
	            <li><a href="sponsoredProject.php" onclick="OpenLink(this); return false">Sponsored Projects</a></li>
	            <li><a href="help.php" onclick="OpenLink(this); return false">Help</a></li>	            
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	          	<li class="hidden-sm hidden-xs"><a href="profilechange.php">Welcome <?php echo $Binfo[1] . " " . $Binfo[2]; ?>!</a></li>
	          	<li>
	          		<input type="submit" class="btn btn-danger"  Name = "logout" value="Log out" style="position:relative; margin-top:10px;"></input>
	          	</li>

              </ul>
	        </div>
	      </div>
	    </div>
	    <!-- header end-->
	    
	    	<div class="container">
    			<div class="page-header">
  			   <h1>Need help? <br><small> &nbsp;here are your resources.</small></h1>
		      </div>
    		</div> 
	    <div class="container">
	    	
	    	<h3>Help Desks</h3>
	    	<p>We have help desks located around Goizueta Business School to aid you with your projects and provide general event information.</p>
	    	<div class="col-md-4">
	    	<div class="panel panel-primary">
  				<div class="panel-heading">
    				<h3 class="panel-title">General Information</h3>
  				</div>
  				<div class="panel-body">
    			Come find us at the Coke Commons to talk to our team about the event. Most of the information is online, but we will be happy to assist in any way possible.  				
    			</div>
			</div>
			</div>
			<div class="col-md-4">
			<div class="panel panel-primary">
  				<div class="panel-heading">
    				<h3 class="panel-title">Tech Support</h3>
  				</div>
  				<div class="panel-body">
    			If you are having trouble with your internet, come to the Coke Commons and we will help you connect your device. 
  				</div>
			</div> 	 
			</div>
			<div class="col-md-4">	
			<div class="panel panel-primary">
  				<div class="panel-heading">
    				<h3 class="panel-title">Development Support</h3>
  				</div>
  				<div class="panel-body">
    			Our tech team is more than willing to help you work through any technical development issues you may have. Come stop by the Coke Commons and make sure to have a clear snippet of your code highlighted.  
  				</div>
			</div>
			</div>
			P.S. Coke Commons is located on the first floor of the Goizueta Business School. 	

			<h3>Directions + Map of GBS</h3>
			<div class="col-md-6">
	    		<p><strong>Goizueta Business School</strong><br>1300 Clifton Rd NE<br>Atlanta, GA 30322</p><p>Take Ponce de Leon, Briarcliff, then North Decatur off Interstate 75.</p>
	    		<iframe width="500" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Goizueta+Business+School,+Clifton+Road+Northeast,+Atlanta,+GA&amp;aq=0&amp;oq=goizeuta+business+&amp;sll=33.785157,-84.327141&amp;sspn=0.056356,0.10128&amp;ie=UTF8&amp;hq=Goizueta+Business+School,+Clifton+Road+Northeast,+Atlanta,+GA&amp;ll=33.789708,-84.322014&amp;spn=0.018546,0.032015&amp;t=m&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Goizueta+Business+School,+Clifton+Road+Northeast,+Atlanta,+GA&amp;aq=0&amp;oq=goizeuta+business+&amp;sll=33.785157,-84.327141&amp;sspn=0.056356,0.10128&amp;ie=UTF8&amp;hq=Goizueta+Business+School,+Clifton+Road+Northeast,+Atlanta,+GA&amp;ll=33.789708,-84.322014&amp;spn=0.018546,0.032015&amp;t=m" style="color:#0000FF;text-align:left">View Larger Map</a></small><br>
	    	</div>
	    	<div class="col-md-6">
	    		<h3>Floor Map</h3>
	    		<p>Here is a detailed floor map of Goizueta Business School's floor layout.<br><a href="Floor_plan_1to3.pdf" target="_blank">Event Floor Plan</a></p>
	    	</div>
	    </div>

	<hr>

	<div class="container">
  		<footer>
    		<div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
 		</footer>
   	</div>
	</body>
</html>
<script src="dist/js/bootstrap.min.js"></script>