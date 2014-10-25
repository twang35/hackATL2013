<?php

	include('QRcode_generator/qrlib.php');
	$id=$_GET['id'];
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
	$regno = $_COOKIE['regno'];
   if(isset($_COOKIE['regno']) && isset($_COOKIE['username']) && isset($_COOKIE['password']) && $id == $regno)
	{	
		$Binfo = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = $id"));
		
		$path_info = "QRcode/".$id."_I.png";
		$content_info = 'http://hackatl.org/2013/personalinfo.php?firstname='.$Binfo['First_name']."&lastname=".$Binfo['Last_name'];
		$path_resume = "QRcode/".$id."_R.png";
		$content_resume = 'http://hackatl.org/2013/resumes/'.$Binfo['resume'];
		if(!file_exists($path_info)){ QRcode::png($content_info, $path_info);}
		if(!file_exists($path_resume) && $Binfo['resume'] != NULL){ QRcode::png($content_resume, $path_resume);
	}
	if(isset($_POST['return'])){ header("Location: index.php");}

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
    </form>

      <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script>
 
  $( document ).ready(function() {
    $('#myModal').bind('hidden.bs.modal', function () {
  $("html").css("margin-right", "0px");
});
$('#myModal').bind('show.bs.modal', function () {
  $("html").css("margin-right", "-15px");
});
  });

</script>

		<!-- <div class="navbar navbar-default navbar-fixed-top">
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
	          	<li><a href="profilechange.php">Welcome <?php echo $Binfo[1] . " " . $Binfo[2]; ?>!</a></li>
	          	<li>
	          		<input type="submit" class="btn btn-danger"  Name = "logout" value="Log out" style="position:relative; margin-top:10px;"></input>
	          	</li>

              </ul>
	        </div>
	      </div>
	    </div> -->
	    <!-- header end-->


<div class="container">
<br>
<h3>Your QR Code</h3>
<p>Use the QR codes below to share your personal information and resume with other hackATL participants!</p>

<?php
		
		$checkinQR = "QRcode_checkin/".$Binfo[2]."-".$Binfo[1]."-".$Binfo[0].".png";
		print "<p><strong>Check-in</strong></p>";
    if(file_exists($checkinQR)){ print "<img src=\"". $checkinQR ."\"><br><br>";}
    else "QR code not found.<br><br>";
		
		print "<p><strong>Personal information</strong></p>";
		print "<img src=\"". $path_info ."\"><br><br>";
		
		print "<p><strong>Resume</strong></p>";
		if($Binfo['resume'] == NULL){ echo "Not yet uploaded";}
		else{ print "<img src=\"". $path_resume ."\">";}
		
	}
	else{ header('Location: /2013/login.html');}
?>
<br><br><!--<INPUT TYPE = "submit" class="col-md-11 col-sm-11 col-xs-11 btn btn-default btn-md" Name = "return" VALUE = "Return">-->
</div>
<br><br>
<div class="container">
    <footer>
      <div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
      <div class="pull-right">
        <!--<a href="http://www.facebook.com/hackatl"><img src="img/facebook.png" alt="Facebook" width="50" height="50"></a>&nbsp;&nbsp;<a href="http://www.twitter.com/hackatl"><img src="img/twitter.png" alt="Twitter" width="50" height="50"></a></div>-->
      
    </footer>
  </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>