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

		$CurrentRoominfo = explode("\n", $Tinfo[5]);
		$Reservedtime = count($CurrentRoominfo)-1;
		if($Binfo[14] != 1)
		{ header('Location: index.php');}
	}
	else{ header('Location: login.html');}

	$count = mysql_query("SELECT * FROM Room_info");
	$Room = mysql_num_rows($count);
	for($i = 1; $i < $Room + 1; $i++)
	{
		$row = mysql_fetch_array(mysql_query("SELECT * FROM Room_info WHERE Room_no = $i"));
		$Rinfo[$i-1] = $row;
	}
	$reserve = $_POST['time'];

	if(isset($_POST['return'])){ header("Location: index.php");}
	if(isset($_POST['confirm']))
	{
		if($reserve != NULL)
		{
			if($Reservedtime < 2)
			{
				$Roominfo = explode(" ", $reserve);
				$roomnum = $Roominfo[0]; $time = $Roominfo[1];

				$query_Room = "UPDATE Room_info SET " . "T" . $time . " = " .$Binfo[15] . " WHERE Room_no = '$roomnum'";
				$query_Team = "UPDATE Team_info SET Room_reserve = CONCAT(Room_reserve, '" . $reserve . "\n') WHERE Team_no = '$Binfo[15]'";

				$check = mysql_query($query_Room);
				$check = mysql_query($query_Team);
			
				print "<script type=\"text/javascript\">"; 
				print "alert('Reserved sucessfully');"; 
				print "location.href=\"roomreserve.php\";";
				print "</script>";
			}
			else
			{
				print "<script type=\"text/javascript\">"; 
				print "alert('Your team has reached the limit hours for room reservation.');"; 
				print "location.href=\"roomreserve.php\";";
				print "</script>";
			}
		}
		else
		{
			print "<script type=\"text/javascript\">"; 
			print "alert('Please select a time slot for reservation.');"; 
			print "location.href=\"roomreserve.php\";";
			print "</script>";
		}
	}

	if(isset($_POST['cancel']))
	{
		if($_POST['currenttime'] == NULL)
		{
			print "<script type=\"text/javascript\">"; 
			print "alert('Please select reservation to cancel.');"; 
			print "location.href=\"roomreserve.php\";";
			print "</script>";
		}
		else
		{
			$cancel = $_POST['currenttime'];
			$canceltime = explode(" ", $cancel);
			
			echo $cancel;

			$query_Room = "UPDATE Room_info SET " . "T" . $canceltime[1] . " = 0 WHERE Room_no = '$canceltime[0]'";
			$query_Team = "UPDATE Team_info SET Room_reserve = REPLACE(Room_reserve, '" . $cancel . "\n" ."', '') WHERE Team_no = '$Binfo[15]'";

			$check_Room = mysql_query($query_Room);
			$check_Team = mysql_query($query_Team);

			header("Location: roomreserve.php");
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
		<form id="form" method=post action="roomreserve.php">
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
		    		<table class="table" style="font-size:13px;">
		    			<thead><tr><th colspan="5"><h3>Room Reservation System</h3><br><strong>Room information (X = reserved):</strong></th></tr></thead>
						<tr class="active">
							<th>Room number</th><th>Room name</th><th>10:00-11:00</th><th>11:00-12:00</th><th>12:00-13:00</th><th>13:00-14:00</th><th>14:00-15:00</th><th>15:00-16:00</th><th>16:00-17:00</th><th>17:00-18:00</th><th>18:00-19:00</th><th>19:00-20:00</th><th>20:00-21:00</th><th>21:00-22:00</th><th>22:00-23:00</th><th>23:00-24:00</th>
						</tr>
						<?php
							for($i = 0; $i < $Room; $i++)
							{
								print "<tr>";
								for($j = 0; $j < 16; $j++)
								{
									print "<td>";
									if($j == 1 || $j == 0){ echo $Rinfo[$i][$j];}
									else if($Rinfo[$i][$j] != 0){ echo "X";}
									else{ print "<input type=\"radio\" name=\"time\" value=\"" . ($i+1) . " " . ($j+8) . "\">";}
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
					</table>
				</div>
				<br>
				<?php
					if($Tinfo[5] != NULL)
					{
						print "<div class=\"row col-md-3\"><table class=\"table table-striped\" style=\"font-size:13px;\">";
						print "<thead><tr><th><strong>Current Reservation:</strong></th></tr></thead>";
						if($Reservedtime == 1)
						{ 
							$temp = explode(" ", $CurrentRoominfo[0]);
							print "<tr><td>";
							print "<input type=\"radio\" name=\"currenttime\" value=\"" . $temp[0] . " " . $temp[1] . "\">";
							echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp[0]'"), 0);
							echo " " . $temp[1] . ":00-" . ((int)$temp[1]+1) . ":00";
							print "</td></tr>";
						}
						else if($Reservedtime == 2)
						{ 
							$temp1 = explode(" ", $CurrentRoominfo[0]); 
							$temp2 = explode(" ", $CurrentRoominfo[1]);
					
							if($temp1[1] < $temp2[1])
							{
								print "<tr><td>";
								print "<input type=\"radio\" name=\"currenttime\" value=\"" . $temp1[0] . " " . $temp1[1] . "\">";
								echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp1[0]'"), 0);
								echo " " . $temp1[1] . ":00-" . ((int)$temp1[1]+1) . ":00";
								print "</td></tr>";
								print "<tr><td>";
								print "<input type=\"radio\" name=\"currenttime\" value=\"" . $temp2[0] . " " . $temp2[1] . "\">";
								echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp2[0]'"), 0);
								echo " " . $temp2[1] . ":00-" . ((int)$temp2[1]+1) . ":00";
								print "</td></tr>";
							}
							else
							{
								print "<tr><td>";
								print "<input type=\"radio\" name=\"currenttime\" value=\"" . $temp2[0] . " " . $temp2[1] . "\">";
								echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp2[0]'"), 0);
								echo " " . $temp2[1] . ":00-" . ((int)$temp2[1]+1) . ":00";
								print "</td></tr>";
								print "<tr><td>";
								print "<input type=\"radio\" name=\"currenttime\" value=\"" . $temp1[0] . " " . $temp1[1] . "\">";
								echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp1[0]'"), 0);
									echo " " . $temp1[1] . ":00-" . ((int)$temp1[1]+1) . ":00";
								print "</td></tr>";							
							}
						}
						print "<tr><td width=\"50%\">";
						print "<INPUT Type = \"submit\" class=\"col-md-11 col-sm-11 col-xs-11 btn btn-default btn-md\" Name = \"cancel\" Value = \"Cancel reservation\">";
						print "</td></tr>";
						print "</table></div>";
						
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