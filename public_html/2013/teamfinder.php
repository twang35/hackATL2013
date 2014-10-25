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

  	if(!isset($_COOKIE['regno']) || !isset($_COOKIE['password']) || !isset($_COOKIE['username']))
	{ header('Location: login.html');}
	
	$numofT = mysql_num_rows(mysql_query("SELECT * FROM Team_info"));
	for($i = 1; $i < $numofT+1; $i++)
	{
		$row = mysql_fetch_array(mysql_query("SELECT * FROM Team_info WHERE Team_no = $i"));
		$Tinfo[$i-1] = $row;
	}
	if(isset($_COOKIE['regno']) && isset($_COOKIE['username']) && isset($_COOKIE['password']))
	{
		$regno = $_COOKIE['regno'];
		$Binfo = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = $regno"));
	}
	if(isset($_POST['return'])){ header("Location: index.php");}

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
		    <div class="container main">
		    	<div class="row col-md-12">
					
						<?php

							$flag=0;
							for($i = 0; $i < $numofT; $i++)
							{						
								if($Tinfo[$i][2] == "xxx"){ continue;}
								else if($flag==0){
											print "<table class=\"table\" style=\"font-size:13px;\">
						<thead><tr><th colspan=\"2\"><h3>Team lists</h3></th><th colspan=\"3\"></th></tr></thead>
						<tr><th>Team Number</th><th>Team name</th><th>Team size</th><th>Team Leader</th><th>Contact Email</th><th>Team Description</th></tr>";
											$flag=1;
										}
								print "<tr>";
								print "<td>"; echo $Tinfo[$i][0]; print "</td>";
								print "<td>"; echo $Tinfo[$i][2]; print "</td>";

									$ppl = count(explode(" ", $Tinfo[$i][4]));
								print "<td>"; echo $ppl; print "</td>";
									
									$fetch_query = "SELECT * FROM Basic_info WHERE Registration_no = " . $Tinfo[$i][3];
									$Leaderinfo = mysql_fetch_array(mysql_query($fetch_query));
								print "<td>"; echo $Leaderinfo[1]." ".$Leaderinfo[2]; print "</td>";
								print "<td>"; echo $Leaderinfo[9]; print "</td>";								
								print "<td>"; echo $Tinfo[$i][7]; print "</td>";
								print "</tr>";

								print "</tr>";
						} 
						if($flag==1){
							print"<tr>
							<td colspan=\"1\">
								<INPUT TYPE = \"submit\" class=\"btn btn-default btn-md\" Name = \"return\" VALUE = \"Return\"> &nbsp;
							</td>
						</tr>
					</table>";
						} 
						else{
							print "<div style=\"position:relative; top:30px;margin-bottom:50px;\">There is no team registered!&nbsp;</div>
							<div><INPUT TYPE = \"submit\" class=\"btn btn-default btn-md\" Name = \"return\" VALUE = \"Return\"></div>";
						}
					?>
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