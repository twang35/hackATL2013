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
		$Binfo = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = '$regno'"));
		$Tinfo = mysql_fetch_array(mysql_query("SELECT * FROM Team_info WHERE Team_no = '$Binfo[15]'"));

		if($Binfo[14] != 1)
		{ header('Location: index.php');}
	}
	else{ header('Location: login.html');}

	if(isset($_POST['submit']))
	{
		$Tno = $Tinfo[0];
		switch($_FILES['presentation']['type'])
   		{
   			case 'application/vnd.ms-powerpoint': $presentation_type = ".ppt"; break;
   			case 'application/vnd.openxmlformats-officedocument.presentationml.presentation': $presentation_type = ".pptx"; break;
   			case 'application/pdf': $presentation_type = ".pdf"; break;   			
   			default: $presentation_type = false;
   		}
   		if($_FILES['presentation']['name'] != null && $presentation_type != false)
   		{
   			$upload_check = glob("Project_upload/".$Tno.".*");
   			$upload_path = "Project_upload/".$Tno.$presentation_type;
   			if(file_exists($upload_check[0]) == true){ unlink($upload_check[0]);}
   			move_uploaded_file($_FILES['presentation']['tmp_name'], $upload_path);

   			print "<script type=\"text/javascript\">"; 
			print "alert('Project uploaded sucessfully.');"; 
			print "location.href=\"index.php\""; 
			print "</script>";
   		}
   		else
   		{
   			/*echo "<br><br><br><br><br><br><br><br><br>".$_FILES['presentation']['type'];*/
   			print "<script type=\"text/javascript\">"; 
			print "alert('Please upload your project presentation in either .ppt, .pptx, or .pdf format.');"; 
			print "location.href=\"teamprojectupload.php\""; 
			print "</script>";
		}
	}

	if(isset($_POST['logout']))
	{
		setcookie('regno', NULL, false, '/2013/', '.hackatl.org');
		setcookie('username', NULL, false, '/2013/', '.hackatl.org');
    	setcookie('password', NULL, false, '/2013/', '.hackatl.org');
		header("Location: login.html");
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
		<form id="form" method=post action="teamprojectupload.php" enctype="multipart/form-data">
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
		    <div class="container main">
			    <div class="row col-md-12">
					<table class="table" width="100%">
						<thead><tr><th colspan="3"><h3>Team Project Upload</h3></th></tr></thead>
						<tbody>
							<tr>
								<td><strong>Presentaion file(.ppt/.pptx/.pdf):</strong></td>
								<td><input type="file" name="presentation"></input></td>
								<td>
								<?php
									$checkifexist = glob("Project_upload/".$Tinfo[0].".*"); 
									if($checkifexist[0] != null){ print "<strong>Uploaded</strong>&emsp;(Upload new file will overwirte your previous file)";} 
								?>
								</td>
							</tr>
							</tbody>
					</table>
					<div class="pull-left">
					<INPUT TYPE = "submit" value="Submit your project" name="submit" class="btn btn-primary btn-md">&nbsp;&nbsp;&nbsp;
					<INPUT TYPE = "submit" value="Return" name="return" class="btn btn-default btn-md">
					</div>		
						
				</div>
			</div>

		</form>
		<br><br>
		<div class="container">
	  		<footer>
	    		<div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
	 		</footer>
		</div>
	</body>
</html>
<script src="dist/js/bootstrap.min.js"></script>
