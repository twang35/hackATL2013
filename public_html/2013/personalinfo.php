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

   
	$firstname = $_GET['firstname'];
	$lastname = $_GET['lastname'];
	$Binfo = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE First_name = '$firstname' AND Last_name = '$lastname'"));
	if($Binfo[1] != $firstname || $Binfo[2] != $lastname)
	{
		print "<script type=\"text/javascript\">"; 
		print "alert('There is no information for the participant.')"; 
		print "location.href=\"http://hackatl.org\";";
		print "</script>";
	}
	if($Binfo[3] == NULL){ $Binfo[3] = $Binfo[1];}
?> 


<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<title><?php echo $firstname. " " . $lastname; ?> - HackATL</title>
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
		<form id="form" method=post action="personalinfo.php">

			<div class="navbar navbar-default navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <a class="navbar-brand" href="http://hackatl.org" onclick="OpenLink(this); return false"><img src = "../img/hackATLLogo2.png" atl = "hackATL" width = "60" height = "20"></a>
	        </div>
	      </div>
	    </div>

			<div class="container">
	    	<table class="table">
	    		<td class="col-md-6">
	    			<div class="row col-md-12">
						<table class="table table-striped table-hover">
		                    <thead><tr><th colspan="2"><h3>Participant Information </h3></th></tr></thead>
		                    <tbody>
								<tr>
									<td><strong>Registration type:</strong></td>
									<td><?php if($Binfo[16] == NULL){ echo "Not specified";}else{ if($Binfo[16] == 'C'){echo "Competitor";}else{echo "Workshop only";}} ?></td>
								</tr>
								<tr>
									<td><strong>Name:</strong></td>
									<td><?php echo $Binfo[1] . " " . $Binfo[2]; ?></td>
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
									<td><strong>Email:</strong></td>
									<td><?php echo $Binfo[9]; ?></td>
								</tr>
								<tr>
									<td><strong>Brief Bio:</strong></td>
									<td width="300px"><?php if($Binfo[19] == NULL){ echo "None";}else{ echo $Binfo[19];} ?></td>
								</tr>
								<tr>
									<td><strong>Resume:</strong></td>
									<td><?php if($Binfo[20] != NULL){ print "<a href=\"resumes/".$Binfo[20]. "\" target=\"_blank\">View</a>";}else{ echo "Not yet uploaded";}?></td>
								</tr>
							</tbody>
						</table>
					</div>





			<!--
			<thead><tr><th colspan="2"><h3>Personal Information</h3></th></tr></thead>
	        <table>
				<tr>
					<td><strong>Registration type:</strong></td>
					<td><?php if($Binfo[16] == NULL){ echo "Not specified";}else{ if($Binfo[16] == 'C'){echo "Competitor";}else{echo "Workshop only";}} ?></td>
				</tr>
				<tr>
					<td><strong>Name:</strong></td>
					<td><?php echo $Binfo[1] . " " . $Binfo[2]; ?></td>
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
					<td><strong>Email:</strong></td>
					<td><?php echo $Binfo[9]; ?></td>
				</tr>
				<tr>
					<td><strong>Brief Bio:</strong></td>
					<td width="300px"><?php if($Binfo[19] == NULL){ echo "None";}else{ echo $Binfo[19];} ?></td>
				</tr>
				<tr>
					<td><strong>Resume:</strong></td>
					<td><?php if($Binfo[20] != NULL){ print "<a href=\"resumes/".$Binfo[20]. "\" target=\"_blank\">View</a>";}else{ echo "Not yet uploaded";}?></td>
				</tr>
			</table>
			-->
		</form>
	</body>
</html>