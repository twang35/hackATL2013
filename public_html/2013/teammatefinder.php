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
		$Cinfo = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = $regno"));
	}
	
	$numofP = mysql_num_rows(mysql_query("SELECT * FROM Basic_info"));
	for($i = 1; $i < $numofP+1; $i++)
	{
		$row = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = $i"));
		$Binfo[$i-1] = $row;
	}

	if(isset($_POST['return'])){ header("Location: index.php");}
	if(isset($_POST['logout'])){
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
		<title><?php echo $Binfo[$regno-1][1] . " " . $Binfo[$regno-1][2]; ?> - HackATL</title>
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
	          	<li class="hidden-sm hidden-xs"><a href="profilechange.php">Welcome <?php echo $Binfo[$regno-1][1] . " " . $Binfo[$regno-1][2]; ?>!</a></li>
	          	<li>
	          		<input type="submit" class="btn btn-danger"  Name = "logout" value="Log out" style="position:relative; margin-top:10px;"></input>
	          	</li>

              </ul>
	        </div>
	      </div>
	    </div>
	    <!-- header end-->
		    <div class="container main">

			<table class="table" style="font-size:13px;">
		    	<thead><tr><th colspan="2"><h3>Registrant List</h3></th>
			    	<th colspan="1"><INPUT TYPE = "submit" class="col-md-8 col-sm-8 col-xs-8 btn btn-default btn-md" Name = "return" VALUE = "Return"></th>
			    	<th colspan="3"></th>
		    	</tr></thead>
				<tr><th>Name</th><th>Preferred name</th><th>Contact email</th><th>Speciality</th><th>Description</th></tr>
				<?php
					for($i = 0; $i < $numofP; $i++)
					{	
						if($Binfo[$i][15] != 0){ continue;}
						if($Binfo[$i]['checkedin'] == 0){ continue;}
						if($Binfo[$i]['Type'] == 'W'){ continue;}
						print "<tr>";
						for($j = 0; $j < 20; $j++)
						{
							if($j == 0 || $j == 2 || $j == 4 || $j == 5 || $j == 6 || $j == 7 || $j == 8 || $j == 10 || $j == 11 || $j == 13 || $j == 14 || $j == 15 || $j == 16 || $j == 17 || $j == 18 || $j == 20){ continue;}
							
							if($j == 1){ print "<td>"; echo $Binfo[$i][1]." ".$Binfo[$i][2]; print "</td>";}
							else if($j == 3){ print "<td>"; if($Binfo[$i][3] == NULL){ echo "None";}else{ echo $Binfo[$i][3];}  print "</td>";}
							else if($j == 12)
							{ 
								print "<td>";
								if($Binfo[$i][12] == NULL){ echo "Not yet specified";}
								if(strpos(" ".$Binfo[$i][12], 'DH') == true){ echo "Developer/Hacker"; print "<br>";}
								if(strpos(" ".$Binfo[$i][12], 'BS') == true){ echo "Business Development/Sales"; print "<br>";}
								if(strpos(" ".$Binfo[$i][12], 'DUU') == true){ echo "Design/UI/UX"; print "<br>";}
								if(strpos(" ".$Binfo[$i][12], 'M') == true){ echo "Marketing";} 
								print "</td>";
							}
							elseif($j == 19){ print "<td>"; if($Binfo[$i][19] == NULL){ echo "None";}else{ echo $Binfo[$i][19];}  print "</td>";}
							else { print "<td>"; echo $Binfo[$i][$j]; print "</td>";}
						}
						print "</tr>";
					}					
				?>
				<td colspan="1">
					<INPUT TYPE = "submit" class="col-md-11 col-sm-11 col-xs-11 btn btn-default btn-md" Name = "return" VALUE = "Return"> &nbsp;
				</td>
			</table>
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