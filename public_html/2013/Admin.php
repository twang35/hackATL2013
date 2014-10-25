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

  	if(!isset($_COOKIE['username']) || !isset($_COOKIE['password']) || $_COOKIE['username'] != "Admin@hackatl.org" || $_COOKIE['password'] != md5("hackatl2013"))
	{ header('Location: login.html');}

	$count = mysql_query("SELECT * FROM Basic_info");
	$regno = mysql_num_rows($count);

	for($i = 1; $i < $regno+1; $i++)
	{
		$row = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = $i"));
		$Binfo[$i-1] = $row;
	}

	if(isset($_POST['logout']))
	{
		setcookie('username', NULL, false, '/2013/', '.hackatl.org');
    	setcookie('password', NULL, false, '/2013/', '.hackatl.org');
		header("Location: login.html");
	}
	if(isset($_POST['sponsorinfo']))
	{
		header("Location: Admin_sponsor.php");
	}
?>

<?php
if(isset($_POST['test'])){
	$to = "lara.lu211@gmail.com";
	$subject = "Test mail";
	$message = "Hello! This is a simple email message.";
	$from = "root@eevm.org";
	$headers = "From:" . $from;
	if(mail($to,$subject,$message,$headers)){
		echo "Mail Sent.";
	}
	else{
		echo "error";
	}
	
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>HackATL 2013 Admin page</title>
		<link href="dist/css/bootstrap.css" rel="stylesheet"/>
    	<link href="jumbotron.css" rel="stylesheet"/>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta name="description" content="">
    	<meta name="author" content="">
	</head>

	<body>
		<form id="form" method=post action=Admin.php>
		<!-- header start-->
		<div class="navbar navbar-default navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="index.html" onclick="OpenLink(this); return false"><img src = "../img/hackATLLogo2.png" atl = "hackATL" width = "60" height = "20"></a>
	        </div>
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav">
	            <li class="active"><a href="index.html" onclick="OpenLink(this); return false">Home</a></li>
	            <li><a href="bios.html" onclick="OpenLink(this); return false">Bios</a></li>
	            <li><a href="about.html" onclick="OpenLink(this); return false">About</a></li>
	            <li><a href="faq.html" onclick="OpenLink(this); return false">FAQ</a></li>
	            <li><a href="register.php" onclick="OpenLink(this); return false">Register</a></li>
	            <li><a href="sponsor.html" onclick="OpenLink(this); return false">Sponsor</a></li>
	            <li><a href="contact.html" onclick="OpenLink(this); return false">Contact</a></li>
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	          	<li><a href="profilechange.php">Welcome! Admin!</a></li>
	          	<li>
	          		<input type="submit" class="btn btn-danger"  Name = "logout" value="Log out" style="position:relative; margin-top:10px;"></input>
	          	</li>
              </ul>
	        </div>
	      </div>
	    </div>
	    <!-- header end-->

		<div class="container">
			<br><br>
			<div class="row col-md-6 col-sm-8 col-xs-8">
				<table class="table">
					<tr>
						<td width="25%"><strong>Sponsor data:</strong></td>
						<td width="25%"><INPUT TYPE = "submit" class="btn btn-primary"  Name = "sponsorinfo" VALUE = "Sponsor info"></td>
						<td width="25%"><strong>Number of registered:</strong></td>
						<td width="25%"><?php echo $regno; ?></td>
					<tr>
				</table>
			</div>
			<div class="row">
				<table class="table table-striped table-hover" style="font-size:13px;">
					<tr class="active">
						<th>No</th><th>First name</th><th>Last name</th><th>Preferred name</th><th>Gender</th><th>Age</th><th>School</th><th>Home town</th><th>Phone no</th><th>Email</th><th>Role</th><th>Diet</th><th>Type</th><th>Tshirt size</th>
					</tr>
					<?php 
						for($i = 0; $i < $regno; $i++)
						{
							print "<tr>";
							for($j = 0; $j < 18; $j++)
							{
								if($j == 15 || $j == 14 || $j == 11 || $j == 10){continue;}
								print "<td>";
								echo $Binfo[$i][$j];
								print "</td>";
							}
							print "</tr>";
						}
					?>
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