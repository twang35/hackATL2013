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
	else{ header('Location: login.html');}

	if(isset($_POST['return'])){ header('Location: index.php');}

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
		<title><?php echo $Binfo[1] . " " . $Binfo[2]; ?> - HackATL</title>
        <link href="dist/css/bootstrap.css" rel="stylesheet">
        <link href="jumbotron.css" rel="stylesheet">
        <meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
        	$(document).ready(function(){
    		$('#TextBoxId').keypress(function(e){
      		if(e.keyCode==13)
      		$('#linkadd').click();
    		});
		});</script>
        <style>
        	.list-group a:hover{
        		cursor: pointer;
        	}
        </style>
	</head>
	<body>
		<form id="form" method=post action="profilechange.php" enctype="multipart/form-data">
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
	          		<input type="button" class="btn btn-danger"  Name = "logout" value="Log out" style="position:relative; margin-top:10px;" onclick="location.href='logout.php'"></input>
	          	</li>

              </ul>
	        </div>
	      </div>
	    </div>
	    <!-- header end-->
	    
			<div class="container main">
				<div class="row col-md-7">
					<table class="table table-striped table-hover">
						<thead><tr><th colspan="2"><h3>Profile Change</h3></th></tr></thead>
						<tr>
							<td><strong>Type:</strong></td>
							<td><input type="radio" name="type" value="C" <?php if($Binfo[16] == "C"){ echo "checked=\"checked\"";}?>>Competitor<br>
						        <input type="radio" name="type" value="W" <?php if($Binfo[16] == "W"){ echo "checked=\"checked\"";}?>>Workshop Only</td>
						</tr>
						<tr>
							<td><strong>First Name:</strong></td>
							<td> <?php echo $Binfo[1]; ?></td>
						</tr>
						<tr>
							<td><strong>Last Name:</strong></td>
							<td><?php echo $Binfo[2]; ?></td>
						</tr>
						<tr>
							<td><strong>Preferred Name:</strong></td>
							<td><INPUT id="textfield" TYPE = "text" placeholder="Preferred Name" Name="preferredname" value="<?php echo htmlspecialchars($Binfo[3]); ?>"></td>
						</tr>
						<tr>
							<td><strong>Gender:</strong></td>
							<td><?php echo $Binfo[4]; ?></td>
						</tr>
						<tr>
							<td><strong>School:</strong></td>
							<td><INPUT id="textfield" TYPE = "text" placeholder="School" Name="school" value="<?php echo htmlspecialchars($Binfo[6]); ?>"></td>
						</tr>
						<tr>
							<td><strong>Hometown:</strong></td>
							<td><INPUT id="textfield" TYPE = "text" placeholder="Hometown" Name="hometown" value="<?php echo htmlspecialchars($Binfo[7]); ?>"></td>
						</tr>
						<tr>
							<td><strong>Phone number:</strong></td>
							<td><INPUT id="textfield" TYPE = "tel" placeholder="Phone number" Name="phonenumber" <?php echo 'value='.$Binfo[8]; ?>></td>
						</tr>
						<tr>
							<td><strong>Email (Username):</strong></td>
							<td><?php echo $Binfo[9]; ?></td>
						</tr>
						<tr>
							<td><strong>New Password(Optional):</strong><br><strong>Reenter New Password:</strong></td>
							<td><Input Type = "password" name = "newpassword" placeholder="New Password"><br><Input Type = "password" name = "repassword" placeholder ="Reenter password"></td>
						</tr>
						<tr>
							<td><strong>Specialty:</strong></td>
							<td><input type="checkbox" name="role1" value="DH" <?php if(strpos(" ".$Binfo[12], 'DH') == true){ echo "checked=\"checked\"";}?>>Developer/Hacker<br>
			                    <input type="checkbox" name="role2" value="BS" <?php if(strpos(" ".$Binfo[12], 'BS') == true){ echo "checked=\"checked\"";}?>>Business Development/Sales<br>
			                    <input type="checkbox" name="role3" value="DUU" <?php if(strpos(" ".$Binfo[12], 'DUU') == true){ echo "checked=\"checked\"";}?>>Design/UI/UX<br>
								<input type="checkbox" name="role4" value="M" <?php if(strpos(" ".$Binfo[12], 'M') == true){ echo "checked=\"checked\"";}?>>Marketing<br></td>
						</tr>
						<tr>
							<td><strong>T-shirt size:</strong></td>
							<td><input type="radio" name="size" value="S" <?php if($Binfo[17] == 'S'){ echo "checked=\"checked\"";}?>>Small<br>
								<input type="radio" name="size" value="M" <?php if($Binfo[17] == 'M'){ echo "checked=\"checked\"";}?>>Medium<br>
								<input type="radio" name="size" value="L" <?php if($Binfo[17] == 'L'){ echo "checked=\"checked\"";}?>>Large<br>
			                    <input type="radio" name="size" value="XL" <?php if($Binfo[17] == 'XL'){ echo "checked=\"checked\"";}?>>X-Large</td>
						</tr>
						<tr>
							<td><strong>Overnight Stay(s):</strong></td>
							<td>
								<input type="checkbox" name="overnightstay1" value='5' <?php if(strpos(" ".$Binfo[21], '5') == true){ echo "checked=\"checked\"";}?>>Friday (2013/11/22)<br>
								<input type="checkbox" name="overnightstay2" value='6' <?php if(strpos(" ".$Binfo[21], '6') == true){ echo "checked=\"checked\"";}?>>Saturday (2013/11/23)<br>
								1. For Competitors only.<br>
								2. Accommodations are not provided for overnight staying.
						</tr>
						<!--
						<tr>
							<td><strong>Dietary Restrictions:</strong></td>
							<td><input id="radio" type="radio" name="diet" value="None" <?php if($Binfo[13] == 'None'){ print "checked=\"checked\"";} ?> />None<br>
							<input type="radio" name="diet" value="Vegetarian" <?php if($Binfo[13] == 'Vegetarian'){ print "checked=\"checked\"";} ?>/>Vegetarian<br>
							<input type="radio" name="diet" value="Vegan" <?php if($Binfo[13] == 'Vegan'){ print "checked=\"checked\"";} ?>/>Vegan<br>
							<input type="radio" name="diet" value="Halal" <?php if($Binfo[13] == 'Halal'){ print "checked=\"checked\"";} ?>/>Halal<br>
							<input type="radio" name="diet" value="Other" <?php if($Binfo[13] != 'None' && $Binfo[13] != 'Vegetarian' && $Binfo[13] != 'Vegan' && $Binfo[13] != 'Halal'){ print "checked=\"checked\"";} ?> />Other&nbsp; <input type="text" name="otherdiet" placeholder="Please specify" <?php if($Binfo[13] != 'None' && $Binfo[13] != 'Vegetarian' && $Binfo[13] != 'Vegan' && $Binfo[13] != 'Halal' && $Binfo[13] != 'Other'){ echo "value=\"" . $Binfo[13] . "\"";}?>></td>
						</tr>
						-->
						<tr>
							<td><strong>Photo:</strong><br>This will overwrite the existing photo.</td>
							<td><input type="file" name="photo" style="display:inline;">
							<?php if($Binfo[18] != NULL){ print "<strong>Uploaded</strong>";}?></td>
						</tr>
						<tr>
							<td><strong>Brief Bio:</strong></td>
							<td><textarea rows="4" cols="50" name="bio" placeholder="Describe yourself"><?php if($Binfo[19] != NULL){ print $Binfo[19];}?></textarea></td>
						</tr>
						<tr>
							<td><strong>Resume:</strong><br>This will overwrite the existing resume.</td>
							<td><input type="file" name="resume" style="display:inline;">
								<?php if($Binfo[20] != NULL){
									print "<strong>Uploaded</strong>";}
								?>
							</td>
						</tr>
					</table>
				</div>
				<div class="row col-md-3"></div>
				<br>
				<div class="row col-md-7">
					If the information you wish to change is not available,<br>please feel free to email hackATL Tech Support tech.eevm@gmail.com.<br><br>
					<strong>Please enter your current password to confirm the changes:</strong>
					<Input Type = "password"class="form-control" style="width:50%;" name = "oldpassword" placeholder="Current Password"><br>
				</div>
				<div class="row col-md-7">
				<table width="80%">
					<tr>
						<td width="33%">
							<INPUT TYPE = "submit" class="col-md-11 col-sm-11 col-xs-11 btn btn-primary btn-md" Name = "submit" VALUE = "Submit"> &nbsp;
						</td>
						<td width="33%">
							<INPUT TYPE = "reset" class="col-md-11 col-sm-11 col-xs-11 btn btn-default btn-md" onClick="return confirm('Are you sure you want to reset the form?')"> &nbsp;
						</td>
						<td width="33%">
							<INPUT TYPE = "submit" class="col-md-11 col-sm-11 col-xs-11 btn btn-default btn-md" Name = "return" VALUE = "Return">
						</td>
					</tr>
				</table>
			</div>
			<?php
			if(isset($_POST['submit']))
			{
   				switch($_FILES['photo']['type'])
   				{
   					case 'image/gif': $photo_type = ".gif"; break;
   					case 'image/jpeg': $photo_type = ".jpg"; break;
   					case 'image/png': $photo_type = ".png"; break;
   					case 'image/bmp': $photo_type = ".bmp"; break;
   					default: $photo_type = false;
   				}
   				switch($_FILES['resume']['type'])
      			{
      				case 'application/pdf': $resume_type  = ".pdf"; break;
      				case 'application/msword': $resume_type  = ".doc"; break;
      				case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document': $resume_type  = ".docx"; break;
      				default: $resume_type = false;
   				}

				$type = $_POST['type'];
				$preferredname = $_POST['preferredname'];
				$school = $_POST['school'];
				$hometown = $_POST['hometown'];
				$phonenumber = $_POST['phonenumber'];
				$oldpassword = $_POST['oldpassword'];
				$newpassword = $_POST['newpassword'];
				$repassword = $_POST['repassword'];
				//$diet = $_POST['diet'];
				//$otherdiet = $_POST['otherdiet'];
				$size = $_POST['size']; 
				$bio = $_POST['bio'];

				if(isset($_POST['role1'])){ $role .= "DH ";}
        		if(isset($_POST['role2'])){ $role .= "BS ";}
        		if(isset($_POST['role3'])){ $role .= "DUU ";}
        		if(isset($_POST['role4'])){ $role .= "M";}

        		if(isset($_POST['overnightstay1'])){ $overnightstay .= "5 ";}
        		if(isset($_POST['overnightstay2'])){ $overnightstay .= "6";}

				$phonenumber = str_replace('+', '', $phonenumber);
      			$phonenumber = str_replace('(', '', $phonenumber);
      			$phonenumber = str_replace(')', '', $phonenumber);
      			$phonenumber = str_replace('-', '', $phonenumber);
      			$phonenumber = str_replace(' ', '', $phonenumber);
      			if(substr($phonenumber, 0, 1) == '1' && strlen($phonenumber) == 11){ $phonenumber = substr($phonenumber, 1);}

      			$enrptedoldpassword = md5($oldpassword);
      			if($Binfo[0] == mysql_result(mysql_query("SELECT Registration_no FROM Login_info WHERE Password = '$enrptedoldpassword'"), 0))
      			{
      				if($school == NULL || $hometown == NULL || strlen($phonenumber)!= 10 || $role == NULL || $type == NULL || $size == NULL)
      				{
      					print "<script type=\"text/javascript\">"; 
						print "alert('All fields are required or please enter acceptable format.')"; 
						print "</script>"; 
      				}
      				else if($newpassword != $repassword)
      				{
      					print "<script type=\"text/javascript\">"; 
						print "alert('Please make sure your new passords you entered match.')"; 
						print "</script>";
      				}
      				else if($_FILES['photo']['name'] != NULL && $photo_type == false || ($_FILES['photo']['size']/1024/1024) > 4)
					{
						print "<script type=\"text/javascript\">"; 
						print "alert('Please upload your photo in either .jpg, .gif, .png, or .bmp format. And the size must be less than 4 MB.');"; 
						print "</script>";
					}
      				else if($_FILES['resume']['name'] != NULL && $resume_type == false || ($_FILES['resume']['size']/1024/1024) > 1)
      				{
      					print "<script type=\"text/javascript\">"; 
						print "alert('Please upload your resume in either .pdf, .doc, or .docx format. And the size must be less than 1 MB.');"; 
						print "</script>";
      				}
      				else
      				{
      					$enrptedpassword = md5($newpassword);
      					
      					$check = mysql_query("UPDATE Basic_info SET Preferred_name = '$preferredname', School = '$school', Come_from = '$hometown', Phone_no = '$phonenumber', Role = '$role', Type = '$type', Tshirt_size = '$size', Overnight_stay = '$overnightstay' WHERE Registration_no = '$Binfo[0]'");
      					if($newpassword != NULL && $repassword != NULL && $newpassword == $repassword)
      					{
      						$check = mysql_query("UPDATE Login_info SET Password = '$enrptedpassword' WHERE Registration_no = '$Binfo[0]'");
      					}

      					if($_FILES['photo']['name'] != NULL)
      					{ 
      						if($Binfo[18] == NULL)
      						{ move_uploaded_file($_FILES['photo']['tmp_name'], ("photos/".md5($regno).$photo_type));}
      						else{ unlink("photos/".$Binfo[18]); move_uploaded_file($_FILES['photo']['tmp_name'], ("photos/".md5($regno).$photo_type));}
      						$query = "UPDATE Basic_info SET photo = '". md5($regno).$photo_type ."' WHERE Registration_no = '$Binfo[0]'";
      						$check = mysql_query($query);
      					}

      					if(strcmp($bio, $Binfo[19])!= 0)
      					{
      						$query = "UPDATE Basic_info SET Bio = '$bio' WHERE Registration_no = '$Binfo[0]'";
      						$check = mysql_query($query);
      					}

      					if($_FILES['resume']['name'] != NULL)
      					{ 
      						if($Binfo[20] == NULL)
      						{ move_uploaded_file($_FILES['resume']['tmp_name'], ("resumes/".md5($regno).$resume_type));}
      						else{ unlink("resumes/".$Binfo[20]); move_uploaded_file($_FILES['resume']['tmp_name'], ("resumes/".md5($regno).$resume_type));}
      						$query = "UPDATE Basic_info SET resume = '". md5($regno).$resume_type ."' WHERE Registration_no = '$Binfo[0]'";
      						$check = mysql_query($query);
      					}
      				
      					print "<script language\"javascript\">{ 
							alert('Profile updated.');
							location.href=\"index.php\"; 
							self.focus(); 
							}</script>";
      				}
      			}
      			else
      			{
      				print "<script type=\"text/javascript\">"; 
					print "alert('Invalid Password.')"; 
					print "</script>";
      			}
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
<script src="dist/js/bootstrap.min.js"></script>