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

	if(isset($_COOKIE['regno']) && isset($_COOKIE['username']) && isset($_COOKIE['password']))
	{
		$regno = $_COOKIE['regno'];
		$Binfo = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = $regno"));
		$interest= mysql_fetch_array(mysql_query("SELECT * FROM Fitmoo WHERE regno = $regno"));
		
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
	          	<li><a href="profilechange.php">Welcome <?php echo $Binfo[1] . " " . $Binfo[2]; ?>!</a></li>
	          	<li>
	          		<input type="submit" class="btn btn-danger"  Name = "logout" value="Log out" style="position:relative; margin-top:10px;"></input>
	          	</li>

              </ul>
	        </div>
	      </div>
	    </div>
	    <!-- header end-->
		</form>
	    <div class="container main">
	    	<div class="row col-md-12">
	    		<div class="alert alert-success fade in" style="display:none; position:relative; margin-top:30px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Thank you for expressing interest!</strong> Fitmoo will reach out to you soon.</div>
	    		
				<div class="page-header">
		  			<h1>Fitmoo</h1>
				</div>
				<p>Fitmoo is creating the World’s Largest Social Fitness Marketplace by aggregating and socializing fitness, health and wellness on one platform.  Our high level goal is to make the world of health and fitness more interconnected, connecting active communities and active people from around the world.</p>
				<br>
				<p class="lead">Project Goal</p>
				<p>Help Fitmoo create the Largest Fitness Facility Database.  This database needs to include 5 key pieces of information: 
					<ol>
						<li>Facility Name</li>
						<li>Address</li>
						<li>Phone number</li>
						<li>URL</li>
						<li>email address</li>
					</ol>
				</p>
				<br>
				<p class="lead">You can start and even finish this project before hack<text class = "text-success">ATL</text>. &nbsp;Prize is $500</p>
				<a href="Fitmoo.pdf" target="_blank">Learn more about Fitmoo</a>&emsp;|&emsp;<a href="Fitmoo_database.zip" target="_blank">Sample database download</a>
				<br><br>
				<?php if(empty($interest)){?>
				<button id="int" class="btn btn-primary btn-md" data-toggle="modal" data-target="#join">
		            Interested?
		        </button>
		       
		        <?php } else {?>
		        	<p><b>Your request to join has been submitted!</b></p>
		        <?php } ?>
				<!-- Modal -->
				<div class="modal fade" id="join" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					  <h4 class="modal-title" id="myModalLabel">Request to join Fitmoo</h4>
				  </div>
				  <div class="modal-body">
					  <h5>I would like to be reached by the following email:</h5><br>
					  <INPUT id="email" placeholder="Email" Name="email" <?php echo 'value='.$Binfo[9]; ?>>
				  </div>
				  <div class="modal-footer">
				  	<button type="button" class="btn btn-primary" id="confirm">Confirm</button>
				  </div>
				</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			</div>
		</div>
		<br><br>
		<div class="container">
	  		<footer>
	    		<div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
	 		</footer>
		</div>
	</body>
</html>
<script src="dist/js/bootstrap.min.js"></script>
<script>
$('#confirm').click(function() {
	$.ajax({
            url: 'function.php',
            type: 'post',
            dataType: 'json',
            data: {"regno":"<?php echo $Binfo[0]; ?>", "email":$('#email').val()},
            beforeSend: function() {
                $('#confirm').attr('disabled', true);
                $('.err').remove();
            },
            complete: function() {
                $('#confirm').attr('disabled', false);
            },
            success: function(json) {
            	if(json['error']){
            		$('#email').after("<p class=\"err\" style=\"color: #b94a48;\">Please enter a valid email address!</p>");
            	} else {
	                $('.alert').fadeIn(1000);
	                $('#join').modal('hide');
	                $('#int').hide();
	                $('#int').after( "<p><b>Your request to join has been submitted!</b></p>" );
	                window.scrollTo(0,0);
            	}
            },
            error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        },
        });
	
});
</script>