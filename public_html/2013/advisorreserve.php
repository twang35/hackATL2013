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

		$CurrentAdvisorinfo = explode("\n", $Tinfo[6]);
		$Reservedtime = count($CurrentAdvisorinfo)-1;
		//echo $Reservedtime;
		if($Binfo[14] != 1)
		{ header('Location: index.php');}
	}
	else{ header('Location: login.html');}

	$count = mysql_query("SELECT * FROM Advisor_info");
	$Advisor = mysql_num_rows($count);
	for($i = 1; $i < $Advisor + 1; $i++)
	{
		$row = mysql_fetch_array(mysql_query("SELECT * FROM Advisor_info WHERE Advisor_no = $i"));
		$Ainfo[$i-1] = $row;
	}

	$reserve = $_POST['time'];

	if(isset($_POST['return'])){ header("Location: index.php");}
	if(isset($_POST['confirm']))
	{
		if($reserve != NULL)
		{
			if($Reservedtime < 1)
			{
				$Advisorinfo = explode(" ", $reserve);
				$Advisornum = $Advisorinfo[0]; $time = $Advisorinfo[1];

				$query_Advisor = "UPDATE Advisor_info SET " . "T" . $time . " = " .$Binfo[15] . " WHERE Advisor_no = '$Advisornum'";
				$query_Team = "UPDATE Team_info SET Advisor_reserve = CONCAT(Advisor_reserve, '" . $reserve . "\n') WHERE Team_no = '$Binfo[15]'";

				$check = mysql_query($query_Advisor);
				$check = mysql_query($query_Team);
			
				print "<script type=\"text/javascript\">"; 
				print "alert('Reserved sucessfully');"; 
				print "location.href=\"advisorreserve.php\";";
				print "</script>";
			}
			else
			{
				print "<script type=\"text/javascript\">"; 
				print "alert('Your team can only reserve a session with an advisor.');"; 
				print "location.href=\"advisorreserve.php\";";
				print "</script>";
			}
		}
		else
		{
			print "<script type=\"text/javascript\">"; 
			print "alert('Please select a time slot for reservation.');"; 
			print "location.href=\"advisorreserve.php\";";
			print "</script>";
		}
	}

	if(isset($_POST['cancel']))
	{
		if($_POST['currenttime'] == NULL)
		{
			print "<script type=\"text/javascript\">"; 
			print "alert('Please select reservation to cancel.');"; 
			print "location.href=\"advisorreserve.php\";";
			print "</script>";
		}
		else
		{
			$cancel = $_POST['currenttime'];
			$canceltime = explode(" ", $cancel);
			
			echo $cancel;

			$query_Advisor = "UPDATE Advisor_info SET " . "T" . $canceltime[1] . " = 0 WHERE Advisor_no = '$canceltime[0]'";
			$query_Team = "UPDATE Team_info SET Advisor_reserve = REPLACE(Advisor_reserve, '" . $cancel . "\n" ."', '') WHERE Team_no = '$Binfo[15]'";

			$check_Advisor = mysql_query($query_Advisor);
			$check_Team = mysql_query($query_Team);

			header("Location: advisorreserve.php");
		}
	}

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
		<title>HackATL 2013 Advisor Reservation</title>
		<link href="dist/css/bootstrap.css" rel="stylesheet">
    	<link href="jumbotron.css" rel="stylesheet">
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="">
	</head>

	<body>
		<form id="form" method=post action=advisorreserve.php>
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
	          	<li><a href="profilechange.php">Welcome <?php echo $Binfo[1] . " " . $Binfo[2]; ?>!</a></li>
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
		    		<table class="table" style="font-size:13px;">
						<thead><tr><th colspan="5"><h3>Advisor Reservation System</h3><br><strong>Advisor information (X = reserved):</strong></th></tr></thead>
						<tbody>
							<tr class="active">
								<th>Advisor number</th><th>Advisor name</th><th>Room number</th><th>17:00-17:15</th><th>17:15-17:30</th><th>17:30-17:45</th><th>17:45-18:00</th>
							</tr>
							<?php
								for($i = 0; $i < $Advisor; $i++)
								{
									print "<tr>";
									for($j = 0; $j < 7; $j++)
									{
										print "<td>";
										if($j == 1 || $j == 0 || $j == 2){ echo $Ainfo[$i][$j];}
										else if($Ainfo[$i][$j] != 0){ echo "X";}
										else{ print "<input type=\"radio\" name=\"time\" value=\"" . ($i+1) . " " . ($j-2) . "\">";}
										print "</td>";
									}
									print "</tr>";
								}
							?>
							<tr>
								<td colspan="2">
									<INPUT TYPE = "submit" class="col-md-11 col-sm-11 col-xs-11 btn btn-primary btn-md" Name = "confirm" VALUE = "Confirm"> &nbsp;
								</td>
								<td colspan="2">
									<INPUT TYPE = "submit" class="col-md-11 col-sm-11 col-xs-11 btn btn-default btn-md" Name = "return" VALUE = "Return"> &nbsp;
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<br>
				<?php
					if($Tinfo[6] != NULL)
					{
						print "<div class=\"row col-md-3\"><table class=\"table table-striped\" style=\"font-size:13px;\">"; 
						print "<thead><tr><th><strong>Current Reservation:</strong></th></tr></thead>";
						
							$temp = explode(" ", $CurrentAdvisorinfo[0]);
							print "<tr><td>";
							print "<input type=\"radio\" name=\"currenttime\" value=\"" . $temp[0] . " " . $temp[1] . "\"> 	";
							echo mysql_result(mysql_query("SELECT Advisor_name FROM Advisor_info WHERE Advisor_no = '$temp[0]'"), 0);
							switch ($temp[1]) {
								case 1:
									echo " 17:00 - 17:15";
									break;
								case 2:
									echo " 17:15 - 17:30";
									break;
								case 3:
									echo " 17:30 - 17:45";
									break;
								case 4:
									echo " 17:45 - 18:00";
									break;
							}
							print "</td></tr>";

						print "<tr><td width=\"50%\">";
						print "<INPUT Type = \"submit\" class=\"col-md-11 col-sm-11 col-xs-11 btn btn-default btn-md\" Name = \"cancel\" Value = \"Cancel reservation\">";
						print "</td></tr>";
						print "</table></div>";
						print "</table>";
					}
				?>
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