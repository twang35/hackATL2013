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

		if($Binfo['Team_no'] != 0)
		{
			$PJ_query = "SELECT * FROM Prelim_slots WHERE Team_no = ".$Binfo['Team_no'];
			$PJinfo = mysql_fetch_array(mysql_query($PJ_query));
		}

		if($Binfo[15] != 0)
		{
			$inT = 1;
			$Tinfo = mysql_fetch_array(mysql_query("SELECT * FROM Team_info WHERE Team_no = $Binfo[15]"));
		}
		else{ $inT = 0;}
	}
	else{ header('Location: /2013/login.html');}


	if(isset($_POST['profilechange'])){ header('Location: profilechange.php');}
	//if(isset($_POST['teamprojectupload'])){ header('Location: teamprojectupload.php');}
	if(isset($_POST['teamprofilechange'])){ header("Location: teamprofilechange.php");}
	//if(isset($_POST['roomreservation'])){ header("Location: roomreserve.php");}
	//if(isset($_POST['advisorreservation'])){ header("Location: advisorreserve.php");}
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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="">
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    	<link rel="apple-touch-startup-image" href="/../../../../img/hackATL_startup.jpg">
    	<meta name="apple-mobile-web-app-capable" content="yes" />
    	<link rel="shortcut icon" href="/../../../..img/favicon.png">
    	<link rel="apple-touch-icon-precomposed" href="/../../../..img/custom_icon_precomposed.png">
        <link rel="stylesheet" href="/dist/css/add2home_retina.css">
    	<script type="application/javascript" src="/dist/css/add2home.js"></script>
        <style>
        	.list-group a:hover{
        		cursor: pointer;
        	}
        </style>
        <script type="text/javascript">
      		function OpenLink(theLink){
        	window.location.href = theLink.href;
      	}
    	</script>
	</head>
	<body>
	<form id="form" method=post action="index.php">
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
	<!--	
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
	    </div>-->
	    <!-- header end-->

	    <div class="container">
	    <br>
	    <div class="bs-callout bs-callout-info">
		  <h3><?php //if($Binfo['Team_no'] == ) ?>Final judging will be announced between 12:30 - 12:40pm</h3>
		</div><br>
	    	<div class="col-md-6">
	    		<div class="row">
	    	<!-- <table class="table">
	    		<td class="col-md-6">
	    			<div class="row col-md-12"> -->
	    				<?php if($regno == 270) {
	    					print "<h3>Please collect your $10 refund from the Tech Support desk at Coca-Cola Commons.</h3>";
	    				} ?>

						<table class="table table-striped table-hover">
		                    <thead><tr><th colspan="2"><h3>Personal Information<!-- &nbsp; <a role="button" class="btn btn-primary btn-xs" href="QRcode_gen.php?<?php echo "id=".$Binfo[0];?>">View my QR Code</a>-->&emsp;&emsp;&emsp;<button onclick="window.location.href='http://hackatl.org/img/hackATLPacket.pdf'" type="button" class="btn btn-primary">hack<text class="text-success">ATL</text> informational packet</button></h3></th></tr></thead>
		                    <tbody>
							<tr>
								<td><strong>Registration #:</strong></td>
								<td><?php echo $Binfo[0]; ?></td>
								</tr>
								<tr>
									<td><strong>Registration type:</strong></td>
									<td><?php if($Binfo[16] == NULL){ echo "Not specified";}else{ if($Binfo[16] == 'C'){echo "Competitor";}else{echo "Workshop only";}} ?></td>
								</tr>
								<tr>
									<td><strong>Name:</strong></td>
									<td><?php echo $Binfo[1] . " " . $Binfo[2]; ?></td>
								</tr>
								<tr>
									<td><strong>Gender:</strong></td>
									<td><?php if($Binfo[4] == 'M'){echo "Male";}else{echo "Female";}?></td>
								</tr>
								<tr>
									<td><strong>Age:</strong></td>
									<td><?php echo $Binfo[5]; ?></td>
								</tr>
								<tr>
									<td><strong>School:</strong></td>
									<td><?php echo $Binfo[6]; ?></td>
								</tr>
								<tr>
									<td><strong>Hometown:</strong></td>
									<td><?php echo $Binfo[7]; ?></td>
								</tr>
								<tr>
									<td><strong>Phone number:</strong></td>
									<td><?php echo substr($Binfo[8], 0, -7) . "-" . substr($Binfo[8], 3, -4) . "-" . substr($Binfo[8], -4); ?></td>
								</tr>
								<tr>
									<td><strong>T-shirt size:</strong></td>
									<td><?php if($Binfo[17] == NULL){ echo "Not specified";}else{ echo $Binfo[17];} ?></td>
								</tr>
								<tr>
									<td><strong>Email:</strong></td>
									<td><?php echo $Binfo[9]; ?></td>
								</tr>
								<!--
								<tr>
									<td><strong>Dietary restriction:</strong></td>
									<td><?php echo $Binfo[13]; ?></td>
								</tr>
								-->
								<tr>
									<td><strong>Overnight stay(s):</strong></td>
									<td><?php if($Binfo[21] == NULL){ echo "None";}
											  else{ if(strpos(" ".$Binfo[21], '5') == true){ echo "Friday (2013/11/22)"; print "<br>";} 
													if(strpos(" ".$Binfo[21], '6') == true){ echo "Saturday (2013/11/23)";}} ?>
									<br><small>Only if you are working overnight. We will not be able to provide formal overnight accomodations.</small></td>
								</tr>
								<tr>
									<td><strong>Photo:</strong></td>
									<td><?php if($Binfo[18] != NULL){ print "<a href=\"photos/".$Binfo[18]. "\" target=\"_blank\">Uploaded</a>";}else{ echo "Not yet uploaded";}?></td>
								</tr>
								<tr>
									<td><strong>Brief Bio:</strong></td>
									<td width="300px"><?php if($Binfo[19] == NULL){ echo "None";}else{ echo $Binfo[19];} ?></td>
								</tr>
								<tr>
									<td><strong>Resume:</strong></td>
									<td><?php if($Binfo[20] != NULL){ print "<a href=\"resumes/".$Binfo[20]. "\" target=\"_blank\">Uploaded</a>";}else{ echo "Not yet uploaded";}?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<br>
					<div class="row">
					<!-- <div class="row col-md-12"> -->
						<table class="table table-striped table-hover">
							<thead><tr><th colspan="2"><h3>hack<text class="text-success">ATL</text> Information</h3></th></tr></thead>
                    		<tbody>
								<tr>
		            				<td class="col-md-3"><strong>Team leader:</strong></td>
		            				<td class="col-md-4"><?php if($Binfo[14] == 1){echo "Yes";}else{echo "No";} ?></td>
		            			</tr>
		            			<tr>
		            				<td><strong>Team name:</strong></td>
		            				<td><?php if($inT == 1){ echo $Tinfo[2];}else{ echo "None";} ?></td>
		            			</tr>
								<?php 
									if($Binfo[14] == 1)
									{
										print "<tr>";
										print "<td><strong>Team identification code:</strong></td>";
										print "<td>" . $Tinfo[1] . "</td>";
										print "</tr>";
									}
								?>
								<tr>
									<td><strong>Specialty:</strong></td>
									<td><?php 
										if(strpos(" ".$Binfo[12], 'DH') == true){ echo "Developer/Hacker"; print "<br>";}
										if(strpos(" ".$Binfo[12], 'BS') == true){ echo "Business Development/Sales"; print "<br>";}
										if(strpos(" ".$Binfo[12], 'DUU') == true){ echo "Design/UI/UX"; print "<br>";}
										if(strpos(" ".$Binfo[12], 'M') == true){ echo "Marketing";}
									?></td>
								</tr>
								<tr>
									<td><strong>Preliminary judging details:</strong></td>
									<td><?php 
										if($PJinfo['Room'] != null && $PJinfo['Time'] != null)
										{
											echo "Room " . $PJinfo['Room']. " at <strong>" . $PJinfo['Time']."</strong>";
										}
										else{ echo "Not available now";}
									?></td>
								</tr>	
								<?php 
									if($inT == 1)
									{
										print "<tr>";
										print "<td><strong>Team member(s):</strong></td>";
										print "<td>";

										$i = 0;
										$Tmemberno = explode(" ", $Tinfo[4]);

										while($Tmemberno[$i] != NULL)
										{
											$Firstname = mysql_result(mysql_query("SELECT First_name FROM Basic_info WHERE Registration_no = $Tmemberno[$i]"), 0); 
											echo $Firstname;
											print "&nbsp;";
											$Lastname = mysql_result(mysql_query("SELECT Last_name FROM Basic_info WHERE Registration_no = $Tmemberno[$i]"), 0);
											echo $Lastname;
											print "&emsp;";
											echo mysql_result(mysql_query("SELECT Email FROM Basic_info WHERE Registration_no = $Tmemberno[$i]"), 0);
											print "<br>&emsp;";
											$Resumeurl = mysql_result(mysql_query("SELECT Resume FROM Basic_info WHERE Registration_no = $Tmemberno[$i]"), 0);
											if($Resumeurl != NULL){ print "<a href=\"resumes/".$Resumeurl."\" target=\"_blank\">".$Firstname."_".$Lastname."_Resume"."</a>";}
											else{ echo "Not yet uploaded";}
											if($Tmemberno[$i+1] != NULL){ print "<br>";}
											$i++;
										}

										print "</td>";
										print "</tr>";
									
										/*print "<tr>";
										print "<td><strong>Room reservation:</strong></td>";
										print "<td>";

										if($Tinfo[5] == NULL){ echo "None";}
										else
										{
											$CurrentRoominfo = explode("\n", $Tinfo[5]);
											$Reservedtime = count($CurrentRoominfo)-1;
											if($Reservedtime == 1)
											{ 
												$temp = explode(" ", $CurrentRoominfo[0]);
												echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp[0]'"), 0);
												echo " " . $temp[1] . ":00-" . ((int)$temp[1]+1) . ":00";
											}
											else if($Reservedtime == 2)
											{ 
												$temp1 = explode(" ", $CurrentRoominfo[0]); 
												$temp2 = explode(" ", $CurrentRoominfo[1]);
									
												if($temp1[1] < $temp2[1])
												{
													echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp1[0]'"), 0);
													echo " " . $temp1[1] . ":00-" . ((int)$temp1[1]+1) . ":00";
													print "<br>";
												
													echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp2[0]'"), 0);
													echo " " . $temp2[1] . ":00-" . ((int)$temp2[1]+1) . ":00";
												}
												else
												{
													echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp2[0]'"), 0);
													echo " " . $temp2[1] . ":00-" . ((int)$temp2[1]+1) . ":00";
													print "<br>";
												
													echo mysql_result(mysql_query("SELECT Room_name FROM Room_info WHERE Room_no = '$temp1[0]'"), 0);
													echo " " . $temp1[1] . ":00-" . ((int)$temp1[1]+1) . ":00";
												}
											}
										}
										print "</td>";
										print "</tr>";

										print "<tr>";
										print "<td><strong>Advisor reservation:</strong></td>";
										print "<td>";

										if($Tinfo[6] == NULL){ echo "None";}
										else
										{
											$CurrentAdvisorinfo = explode("\n", $Tinfo[6]);
											$Reservedtime = count($CurrentAdvisorinfo)-1;
											
												$temp = explode(" ", $CurrentAdvisorinfo[0]);
												echo "<strong>".mysql_result(mysql_query("SELECT Advisor_name FROM Advisor_info WHERE Advisor_no = '$temp[0]'"), 0).":</strong>";
												echo " Saturday ";
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
												
										}
										print "</td>";
										print "</tr>";	*/
									}

									print "<tr>";
									print "<td><strong>Team description:</strong></td>";
									print "<td>";
										echo $Tinfo['Team_description'];
									print "</td>";
									print "</tr>";
								?>
							</tbody>
						</table>
					</div>
					<br>
					<div class="row">
					<!-- <div class="row col-md-12"> -->
					<?php
					if($Binfo[14] == 1)
					{?>
						<table class="table" style="visibility:hidden;">
							<thead><tr><th colspan="2"><h3>Team functions:</h3></th></tr></thead>
                    		<tbody >
								<INPUT style="visibility:hidden;" TYPE = "submit"  id="team_project_upload" Name = "teamprojectupload" VALUE = "Team Project Upload">
								<INPUT style="visibility:hidden;" TYPE = "submit"  id="team_profile_change" Name = "teamprofilechange" VALUE = "Team Profile Change">
								<!--<INPUT style="visibility:hidden;" TYPE = "submit"  id="room_reservation" Name = "roomreservation" VALUE = "Room Reservation">
								<INPUT style="visibility:hidden;" TYPE = "submit" id="advisor_reservation" Name = "advisorreservation" VALUE = "Advisor Reservation">-->
							</tbody>
						</table>
					<?php } ?>
					</div>
				</div>



		<!-- personal function -->
		<?php
			if($inT == 0 && $Binfo[14] == 0)
			{
				print "<input type=\"hidden\" id=\"confirm\" name=\"leaderB\">";
				print "<input type=\"hidden\" id=\"Teamname\" name=\"teamname\">";
				//print "&emsp;<INPUT id=\"create_team\" TYPE = \"submit\" style=\"visibility:hidden;\" Name = \"confirmleader\" VALUE = \"Create team\" onclick=\"document.getElementById('Teamname').value = prompt('Please enter the name of your team', '');\">";
				$teamname = $_POST['teamname'];
				
				if(isset($_POST['confirmleader']))
				{
					if(strlen(str_replace(' ', '', $teamname)) == 0)
					{
						print "<script type=\"text/javascript\">"; 
						print "alert('Please enter a valid team name.')"; 
						print "</script>";
					}
					else
					{
						$check = mysql_num_rows(mysql_query("SELECT * FROM Team_info WHERE Team_name = '$teamname'"));
						if($check == 0)
						{
							$countrow = mysql_num_rows(mysql_query("SELECT * FROM Team_info")) + 1;
							mysql_query("UPDATE Basic_info SET Team_leader_B = true WHERE Registration_no = '$regno'");
						
							$Tidno = '';
							$characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ@#$%&';
    						for ($i = 0; $i < 5; $i++) { $Tindo .= $characters[rand(0, strlen($characters) - 1)];}

							$teamregister = mysql_query("INSERT INTO Team_info (Team_no, Team_id_no, Team_name, Team_leader_no, Team_member_no)
																VALUES ('$countrow', '$Tindo', '$teamname', '$Binfo[0]', '$Binfo[0]')");
							$profilechangeB = mysql_query("UPDATE Basic_info SET Team_leader_B = 1 AND SET Team_no = '$countrow'  WHERE Registration_no ='$Binfo[0]'");
							$profilechangeB = mysql_query("UPDATE Basic_info SET Team_no = '$countrow'  WHERE Registration_no ='$Binfo[0]'");
							$profilechangeB = mysql_query("UPDATE Login_info SET Team_leader_B = 1  WHERE Registration_no ='$Binfo[0]'");
						
							print "<script type=\"text/javascript\">"; 
							print "location.href=\"teamprofilechange.php\";";
							print "</script>";
						}
						else if($check != 0)
						{
							print "<script type=\"text/javascript\">"; 
							print "alert('Sorry! The team name you chose has been taken.')"; 
							print "</script>";
						}
					}
				}
				else if(isset($_POST['confirmleader']) && $teamname != NULL)
				{
					print "<script type=\"text/javascript\">"; 
					print "alert('Please enter a valid team name.')"; 
					print "</script>";
				}		

				print "<input type=\"hidden\" id=\"teamidno\" name=\"teamidno\">";
				//print "<INPUT id=\"join_team\" TYPE = \"submit\" style=\"visibility:hidden;\" Name = \"joinateam\" VALUE = \"Join a Team\" onclick=\"document.getElementById('teamidno').value = prompt('Please enter team identification code:', '');\"><br>";
				$Tidno = $_POST['teamidno'];
				$Tno = mysql_result(mysql_query("SELECT Team_no FROM Team_info WHERE Team_id_no = '$Tidno'"), 0);

				if(isset($_POST['joinateam']) && $Tno != NULL)
				{
					mysql_query("UPDATE Basic_info SET Team_no = '$Tno' WHERE Registration_no = '$regno'");
					mysql_query("UPDATE Team_info SET Team_member_no = CONCAT(Team_member_no, ' $regno') WHERE Team_no = '$Tno'");

					print "<script type=\"text/javascript\">"; 
					print "location.href=\"index.php\";";
					print "</script>";
				}
				else if(isset($_POST['joinateam']) && $_POST['teamidno'] != NULL)
				{
					print "<script type=\"text/javascript\">"; 
					print "alert('Wrong team identification code!')"; 
					print "</script>";
				}

				print "<INPUT id=\"find_team\" TYPE = \"submit\" style=\"visibility:hidden;\" Name = \"findateam\" VALUE = \"Find Team\"><br>";
			}
			else if($inT == 1 && $Binfo[14] != 1)
			{
				print "<input type=\"hidden\" id=\"confirmleaving\" name=\"leavingB\">";
				//print "<INPUT id=\"leave_team\" TYPE = \"submit\" style=\"visibility:hidden;\" Name = \"leaveteam\" VALUE = \"Leave team\" onclick=\"document.getElementById('confirmleaving').value = confirm('Are you sure you want to leave the team?');\">";
				$leavingB = $_POST['leavingB'];

				if(isset($_POST['leaveteam']) &&  $leavingB == "true")
				{
					mysql_query("UPDATE Basic_info SET Team_no = '0' WHERE Registration_no = '$regno'");
					mysql_query("UPDATE Team_info SET Team_member_no = REPLACE(Team_member_no, ' $regno', '') WHERE Team_no = '$Binfo[15]'");
					
					print "<script type=\"text/javascript\">"; 
					print "location.href=\"index.php\";";
					print "</script>";
				}
			}
			else if($inT == 1 && $Binfo[14] == 1)
			{
				print "<input type=\"hidden\" id=\"confirmleavingleader\" name=\"leavingleaderB\">";
				//print "<INPUT id=\"leave_team_leader\" TYPE = \"submit\" style=\"visibility:hidden;\" Name = \"leaveteamleader\" VALUE = \"Leave team\" onclick=\"document.getElementById('confirmleavingleader').value = confirm('Are you sure you want to leave the team?');\">";
				$leavingleaderB = $_POST['leavingleaderB'];

				if(isset($_POST['leaveteamleader']) &&  $leavingleaderB == "true")
				{
					$Tmemberno = explode(" ", $Tinfo[4]);
					if($Tmemberno[1] == NULL)
					{
						mysql_query("UPDATE Basic_info SET Team_leader_B = 0, Team_no = 0 WHERE Registration_no = '$regno'");
						mysql_query("UPDATE Login_info SET Team_leader_B = 0 WHERE Registration_no = '$regno'");
							
						if($Tinfo[5] != NULL)
						{
							$CurrentRoominfo = explode("\n", $Tinfo[5]);
							$Reservedtime = count($CurrentRoominfo)-1;
							for($i = 0; $i < $Reservedtime; $i++)
							{
								$temp = explode(" ", $CurrentRoominfo[$i]);
								$query_Room = "UPDATE Room_info SET " . "T" . $temp[1] . " = 0 WHERE Room_no = " . $temp[0];
								$check_Room = mysql_query($query_Room);
							}
						}

						if($Tinfo[6] != NULL)
						{
							$CurrentAdvisorinfo = explode("\n", $Tinfo[6]);
							$Reservedtime = count($CurrentAdvisorinfo)-1;
							for($i = 0; $i < $Reservedtime; $i++)
							{
								$temp = explode(" ", $CurrentAdvisorinfo[$i]);
								$query_Advisor = "UPDATE Advisor_info SET " . "T" . $temp[1] . " = 0 WHERE Advisor_no = " . $temp[0];
								$check_Adviosr = mysql_query($query_Advisor);
							}
						}

						mysql_query("UPDATE Team_info SET Team_id_no = 'xxx', Team_name = 'xxx', Team_leader_no = '0', Team_member_no = '0', Room_reserve = '', Advisor_reserve = '', Team_description = '' WHERE Team_no = '$Tinfo[0]'");
						print "<script type=\"text/javascript\">"; 
						print "location.href=\"index.php\";";
						print "</script>";
					}
					else if($Tmemberno[1] != NULL)
					{
						print "<script type=\"text/javascript\">"; 
						print "alert('You cannot leave the team if you have any teammates.')"; 
						print "</script>"; 
					}
				}
			}
		?>
		<INPUT id="find_teammate" TYPE = "submit" style="visibility:hidden;" Name = "findteammate" VALUE = "Find Teammates">
		<input id="profile_change" TYPE = "submit" style="visibility:hidden;" Name = "profilechange" value="Profile Change">
		<!-- </td> -->

	    <!-- <td class="col-md-1"></td>
	    <td class="col-md-3" style="position:fixed; "> -->
	    <div class="col-md-2"><br></div>
	    <div class="col-md-4 pull-right">
	        <br><!-- <br> -->
	        <div class="sidebar-offcanvas" id="sidebar" role="navigation">
	            <div class="list-group">
		            <span href="#" class="list-group-item active">Personal Functions</span>		            
		            <script>
			            /*if ($( "#create_team" ).length){
			            	document.write("<a id=\"create_team_sidebar\" class=\"list-group-item\">Create Team</a>");
			            }
			            if ($( "#join_team" ).length){
			            	document.write("<a id=\"join_team_sidebar\" class=\"list-group-item\">Join Team</a>");
			            }*/
			            if ($( "#find_team" ).length){
			            	document.write("<a id=\"find_team_sidebar\" class=\"list-group-item\">Find Team</a>");
			            }
			            if ($( "#find_teammate" ).length){
			            	document.write("<a id=\"find_teammate_sidebar\" class=\"list-group-item\">Find Teammates</a>");
			            }
			            /*if ($( "#leave_team" ).length){
			            	document.write("<a id=\"leave_team_sidebar\" class=\"list-group-item\">Leave Team</a>");
			            }
			            if ($( "#leave_team_leader" ).length){
			            	document.write("<a id=\"leave_team_leader_sidebar\" class=\"list-group-item\" >Leave Team</a>");
			            }*/
		            </script>
		            <a id="profile_change_sidebar" class="list-group-item">Profile Change</a>
	        	</div>
	    	</div>
	    	<?php
				if($Binfo[14] == 1)
			{?>
	    	<div class="sidebar-offcanvas" id="sidebar" role="navigation">
	            <div class="list-group">
		            <span href="#" class="list-group-item active">Team Functions</span>
	            	<a id="team_project_upload_sidebar" class="list-group-item">Team Project Upload</a>
	            	<a id="team_profile_change_sidebar" class="list-group-item">Team Profile Change</a>
	            <!--<a class="list-group-item" >Room Reservation &nbsp;&nbsp;&nbsp;<small>Not Open</small></a>
	            	<a class="list-group-item">Advisor Reservation &nbsp;&nbsp;&nbsp;<small>Not Open</small></a>
	        		<a id="room_reservation_sidebar" class="list-group-item" >Room Reservation</a>
	            	<a id="advisor_reservation_sidebar" class="list-group-item">Advisor Reservation</a> -->
	        	</div>
	    	</div>

	    	<?php
	    		}
			?>
			<hr>
	        <h3>Team Building</h3>
	        <p>If you have an idea/want to form your own team and assume the role of the team leader, click <text class="text-success">Create Team</text> and enter in a brief team description. Once your team is created, you can use the <text class="text-success">Find Teammates</text> function to browse potential teammates. To add members to your team, you must personally provide them with your team identification code.</p>
	        <p>If you want to join an existing team, check out the <text class="text-success">Find Team</text> function, explore teams and their descriptions, and contact a team leader to request his or her identification code.</p>
	        <p>If you do not have a team <text class="text-success">by midnight</text> on Friday(2013/11/22), the system will <text class="text-success">automatically</text> assign you with a team.</p>
	        <p>Team members can leave a team using the <text class="text-success">Leave Team</text> function until 12:00 PM, Saturday morning. Team leaders cannot leave a team unless all their members have already left the team. Once the team leader leaves the team, the team will be destroyed.</p>
	        <p>If you have any question for hack<text class="text-success">ATL</text> 2013,<br>please feel free to email: <br>&nbsp;<a href="mailto:emoryevm@gmail.com"><strong>emoryevm@gmail.com</a> for questions</strong> <br>&nbsp;<strong><a href="mailto:emoryevm@gmail.com">tech.eevm@gmail.com</a> for tech support </strong></p> 
	    <!-- </td>
	</table> -->
	</div>
	</div>
	</form>

	<hr>

	<div class="container">
  		<footer>
    		<div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
 		</footer>
   	</div>
	</body>
</html>

<script>
$( document ).ready(function() {
	//$( "#create_team_sidebar" ).on( "click", function() {
	//	$( "#create_team" ).trigger( "click" );
	//});
	//$( "#join_team_sidebar" ).on( "click", function() {
	//	$( "#join_team").trigger( "click" );
	//});
	$( "#find_team_sidebar" ).on( "click", function() {
		$( "#find_team").trigger( "click" );
	});
	$( "#find_teammate_sidebar" ).on( "click", function() {
		$( "#find_teammate" ).trigger( "click" );
	});
	//$( "#leave_team_sidebar" ).on( "click", function() {
	//	$( "#leave_team" ).trigger( "click" );
	//});
	//$( "#leave_team_leader_sidebar" ).on( "click", function() {
	//	$( "#leave_team_leader" ).trigger( "click" );
	//});	
	$( "#profile_change_sidebar" ).on( "click", function() {
		$( "#profile_change" ).trigger( "click" );
	});
	$( "#team_project_upload_sidebar" ).on( "click", function() {
		$( "#team_project_upload" ).trigger( "click" );
	});
	$( "#team_profile_change_sidebar" ).on( "click", function() {
		$( "#team_profile_change" ).trigger( "click" );
	});
	//$( "#room_reservation_sidebar" ).on( "click", function() {
	//	$( "#room_reservation" ).trigger( "click" );
	//});
	//$( "#advisor_reservation_sidebar" ).on( "click", function() {
	//	$( "#advisor_reservation" ).trigger( "click" );
	//});
} );
</script>

<script src="dist/js/bootstrap.min.js"></script>