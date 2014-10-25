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

	    </div>
	    	<div class="container">
      			<div class="page-header">
        			<h1>hack<text class="text-success">ATL</text> Guidelines<br><small> &nbsp;what to do and what not to do.</small></h1>
      			</div>
     		</div>
		<div class="container">
     		<div class="row">
     		<div class="col-md-12">
     			<h2>Presentation Guidelines</h2>
     			<p class="lead">Teams will finish at 10:00 AM on Sunday morning and will then present their progress in a preliminary judging round. Finalists will be decided based on this preliminary judging and will then have the opportunity to pitch their ideas to the full panel of judges.</p>
     		<!-- </div> -->
     		<!-- <div class="col-md-4"> -->
     			<div class="panel panel-default">
  					<div class="panel-heading">
    					<h3 class="panel-title">Preliminary Judging&emsp;&emsp;&emsp;<small><a href="JudgingCriteria.pdf" target="_blank">Judging Criteria</a></small></h3>
  					</div>
  					<div class="panel-body"><strong>Please follow all the following rules to ensure you will be considered as a competitor.</strong></div>
    					<ul class="list-group">
    						<li class="list-group-item">Each team will receive 3 minutes for their presentation and 1 minute for Q&amp;A</li>
    						<li class="list-group-item">The team will present in front of one judge</li>
  						</ul>
    					<!-- <ul>
    						<li>5 minute alotted time - includes presentation and Q&amp;A</li>
    						<li>Must prepare and submit pitch deck</li>
    						<li>May not use any visual aid besides pitch deck due to time constraints</li>
    					</ul> -->
  					<!-- </div> -->
				</div>
				<div class="panel panel-primary">
  					<div class="panel-heading">
    					<h3 class="panel-title">Final Judging</h3>
  					</div>
  					<div class="panel-body"><strong>The finalists will be given the opportunity to present again in the final round and be eligible for prizes.</strong></div>
    					<ul class="list-group">
    						<li class="list-group-item">Each team will receive 5 minutes of presentation time + 3 minute of Q&amp;A</li>
    						<li class="list-group-item">The team will present in front of a panel of judges</li>
    						<li class="list-group-item">All rules from preliminary judging apply, except a team may provide materials (brochures, flyers, business cards, etc.) to the judges.</li>
    					</ul>
  					<!-- </div> -->
				</div>
     		</div>
     		
     		</div>
     		<div class="row">
	    	<div class="col-md-12">
	    	<h3>Other Competition Rules</h3>
	    		<div class="list-group">
  				
  				<!-- <a class="list-group-item">Teams must include at least four members and at most eight members.</a> -->
  				<a class="list-group-item">If you use source code from third party APIs, please inform the judges.</a>
  				<a class="list-group-item">If any work was completed before hackATL, teams must indicate the level of work completed to the judges prior to their presentation.</a>
  				<a class="list-group-item">Keep name tags on at all times. The whole point is to network!</a>
				<a class="list-group-item">Keep valuable items with you – we are not responsible for lost or stolen items.</a>
				<a class="list-group-item">In case of emergency call Emory Police (404) 727-6111 or if life threatening, 911. Please inform us of any calls to Emory Police or 911.</a>
				<a class="list-group-item">Be respectful to other participants and teams.</a> 
				<a class="list-group-item">Don’t damage property - If you engage in any activity that threatens or damages the infrastructure of Emory University, including but not limited to damage to property, vandalism, (actual) hacking into the network, or the lives of any participant or staff, you will be held accountable for your actions and not be allowed back.</a>
				<a class="list-group-item">Check your email and this portal regularly – this is where important information and announcements will come out.</a>
				<a class="list-group-item">If you need assistance look for people in EE&amp;VM shirts.</a>
				<a class="list-group-item active">Have fun! Although the event is a competition, you should also be here to meet new people and have a great time.</a>
  				</div>
	    	</div>
	    	</div>	
	    </div>

	<div class="container">
  		<footer>
    		<div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
 		</footer>
   	</div>
	</body>
</html>
<script src="dist/js/bootstrap.min.js"></script>