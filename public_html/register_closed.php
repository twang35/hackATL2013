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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.png">

    <script type="text/javascript">
      function OpenLink(theLink){
        window.location.href = theLink.href;
      }
    </script>

    <title>Register | hackATL | Nov. 23-24</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43828721-2', 'hackatl.org');
  ga('send', 'pageview');

  </script>

  </head>

  <body>

    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html" onclick="OpenLink(this); return false"><img src = "http://ecee981956945448fbaa-137b1647cd8bbf29b05687816fc93f23.r67.cf2.rackcdn.com/hackATLLogo2.png" atl = "hackATL" width = "60" height = "20"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="about.html" onclick="OpenLink(this); return false">About</a></li>
            <li><a href="schedule.html" onclick="OpenLink(this); return false">Schedule</a></li>
            <li><a href="faq.html" onclick="OpenLink(this); return false">FAQ</a></li>
            <li class="active"><a href="register.php" onclick="OpenLink(this); return false">Register</a></li>
            <li><a href="sponsor.html" onclick="OpenLink(this); return false">Sponsor</a></li>
            <li><a href="videos.html" onclick="OpenLink(this); return false">Videos</a></li>
            <li><a href="contact.html" onclick="OpenLink(this); return false">Contact</a></li>
          </ul>
 <!--          <form class="navbar-form navbar-right" method=post action="">
           <div class="form-group">
              <input type="text" placeholder="Email" class="form-control" name="username">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success" name="Submit1">Sign in</button></form>
-->
           
          <form class="navbar-form navbar-right" method=post action="">
            <!-- <button type="submit" class="btn btn-success" name="Submit1" -->
            <button onclick="window.location.href='http://hackatl.org/2013/login.php'" type="button" class="btn btn-default" id="signin">Log in</button>
            <!-- <a href="http://hackatl.org/2013/login.php"><button type="button" class="btn btn-default" id="signin">Log in</button></a> -->
            <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Our Apologies</h4>
      </div>
      <div class="modal-body">
        Login will be available on November 18, 2013
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script>
 
  $( document ).ready(function() {
    $('#myModal').bind('hidden.bs.modal', function () {
  $("html").css("margin-right", "0px");
});
$('#myModal').bind('show.bs.modal', function () {
  $("html").css("margin-right", "-15px");
});
  });
</script>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="container">
    <!-- <div class="bs-callout bs-callout-info">
      <h1>Free signup is back!</h1>
      <p>We're working to provide food and t-shirts for all participants</p>
    </div> -->
    	<div class="page-header">
  			<h1>Register for hack<text class="text-success">ATL</text><br><small> &nbsp;don't miss out.</small></h1>
		</div>
	</div>

    <div class="container">
    	 <div class="row">
          <div class="col-lg-12">
            <div class="well">
              <form class="bs-example form-horizontal" id="form" method=post action="register_closed.php">
                <fieldset>
                  <legend>Please fill out all fields.</legend>


                  <div class="form-group">
                    <label class="col-lg-2 control-label">Type</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="type" value="C" checked="checked">
                          Competitor
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="type" value="W">
                          Workshop Only
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="firstname" class="col-lg-2 control-label">First Name</label>
                    <div class="col-lg-10">
                      <input type="text" Name ="firstname"  class="form-control" id="firstname" placeholder="First Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lastname" class="col-lg-2 control-label">Last Name</label>
                    <div class="col-lg-10">
                      <input type="text" Name ="lastname"  class="form-control" id="lastname" placeholder="Last Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="prename" class="col-lg-2 control-label">Preferred Name</label>
                    <div class="col-lg-10">
                      <input Name="preferredname" type="text" class="form-control" id="prename" placeholder="Preferred Name">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-lg-2 control-label">Gender</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="gender" value="M" checked="checked">
                          Male
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="gender" value="F">
                          Female
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="age" class="col-lg-2 control-label">Age</label>
                    <div class="col-lg-10">
                      <input Name="age" type="tel" class="form-control" id="age" placeholder="Age">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="bday" class="col-lg-2 control-label">Birthday</label>
                    <div class="col-lg-10">
                      <input Name="bday" type="date" class="form-control" id="bday">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="school" class="col-lg-2 control-label">School</label>
                    <div class="col-lg-10">
                      <input Name="school" type="text" class="form-control" id="school" placeholder="School">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="hometown" class="col-lg-2 control-label">Hometown</label>
                    <div class="col-lg-10">
                      <input Name="hometown" type="text" class="form-control" id="hometown" placeholder="Hometown">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="phnumber" class="col-lg-2 control-label">Phone number</label>
                    <div class="col-lg-10">
                      <input Name="phonenumber" type="tel" class="form-control" id="phnumber" placeholder="Phone Number">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email (Username)</label>
                    <div class="col-lg-10">
                      <input Name="email" type="text" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                      <input Name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="repass" class="col-lg-2 control-label">Re-enter Password</label>
                    <div class="col-lg-10">
                      <input Name="repassword" type="password" class="form-control" id="repass" placeholder="Re-enter your password">
                    </div>
                  </div>
<!--
                  <div class="form-group">
                    <label for="emname" class="col-lg-2 control-label">Emergency Name</label>
                    <div class="col-lg-10">
                      <input Name="emergencycontactname" type="text" class="form-control" id="emname" placeholder="Emergency Contact Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="emmumber" class="col-lg-2 control-label">Emergency Number</label>
                    <div class="col-lg-10">
                      <input Name="emergencycontactnumber" type="tel" class="form-control" id="emnumber" placeholder="Emergency Contact Number">
                    </div>
                  </div>
-->
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Speciality</label>
                    <div class="col-lg-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="role1" value="DH">
                          Developer/Hacker
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="role2" value="BS">
                          Business Development/Sales
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="role3" value="DUU">
                          Design/UI/UX
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="role4" value="M">
                          Marketing
                        </label>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <label class="col-lg-2 control-label">Dietary Restrictions</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="diet" value="None" checked="checked">
                          None
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="diet" value="Vegetarian">
                          Vegetarian
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="diet" value="Vegan">
                          Vegan
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="diet" value="Halal">
                          Halal
                        </label>
                      </div> -->
                    
                      <!-- <div class="radio">
                        <label>
                          <input type="radio" name="diet" value="Other">Other
                        </label>
                          &nbsp;<input type="text" class="form-control input-sm" name="otherdiet" placeholder="Other">
                        
                      </div> -->
                      <!--<div class="radio">
                      <div class="input-group">
                        
                        <input type="radio" name="diet" value="Other">
                        <label>Other<input type="text" class="form-control input-sm" name="otherdiet" placeholder="Please specify your restriction"></label>
                        
                      </div>
                      </div> -->
                    
                    
                  <!--</div> -->
                      <!-- <div class="input-group">
      					<span class="input-group-addon">
        				<input type="radio" name="diet" value="Other">
      					</span>
      					<input type="text" class="form-control" Name="otherdiet">
    				  </div> -->
                   <!--    <div class="radio">
                        <label>
                          <input type="radio" name="diet" value="Other">
                          Other
                        </label>
                      </div> -->
                    <!--   <div class="radio">
                        <label>
                          <input type="radio" name="diet" value="Other">
                          Other
                        </label>
                      <input Name="diet" type="text" class="form-control" id="diet" placeholder="Other">
                    </div>
                     -->


    <!-- /input-group -->
  <!-- /.col-lg-10 -->

                   <div class="form-group">
                    <label class="col-lg-2 control-label">T-Shirt Size</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="size" value="S" checked="checked">
                          Small
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="size" value="M">
                          Medium
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="size" value="L">
                          Large
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="size" value="XL">
                          X-Large
                        </label>
                      </div>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button type="reset" class="btn btn-default" onClick="return confirm('Are you sure you want to reset the form?')">Reset</button> 
                      <button type="submit" class="btn btn-primary" Name = "Submit" VALUE = "Submit">Submit</button> 
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
    	</div>
    </div>
    

	
      <hr>
	
	<div class="container">
      <footer>
        <div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
        <div class="pull-right">
          <a href="http://www.facebook.com/hackatl"><img src="img/facebook.png" alt="Facebook" width="50" height="50"></a>&nbsp;&nbsp;<a href="http://www.twitter.com/hackatl"><img src="img/twitter.png" alt="Twitter" width="50" height="50"></a></div>
        </div>
      </footer>
    </div> <!-- /container -->
    
    <?php

			$count = mysql_query("SELECT * FROM Basic_info");
			$regno = mysql_num_rows($count) + 1;
			
      $type = $_POST['type'];
      $size = $_POST['size'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$preferredname = $_POST['preferredname'];
			$gender = $_POST['gender'];
			$age = $_POST['age'];
			$school = $_POST['school'];
			$hometown = $_POST['hometown'];
			$phonenumber = $_POST['phonenumber'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$repassword = $_POST['repassword'];
			//$ecname = $_POST['emergencycontactname'];
			//$ecnumber = $_POST['emergencycontactnumber'];
      $diet = $_POST['diet'];
      $otherdiet = $_POST['otherdiet'];

      $phonenumber = str_replace('.', '', $phonenumber);
      $phonenumber = str_replace('+', '', $phonenumber);
      $phonenumber = str_replace('(', '', $phonenumber);
      $phonenumber = str_replace(')', '', $phonenumber);
      $phonenumber = str_replace('-', '', $phonenumber);
      $phonenumber = str_replace(' ', '', $phonenumber);
      $firstname = str_replace(' ', '', $firstname);
      $lastname = str_replace(' ', '', $lastname);

      if(isset($_POST['role1'])){ $role .= "DH ";}
      if(isset($_POST['role2'])){ $role .= "BS ";}
      if(isset($_POST['role3'])){ $role .= "DUU ";}
      if(isset($_POST['role4'])){ $role .= "M";}

      if(substr($phonenumber, 0, 1) == '1' && strlen($phonenumber) == 11){ $phonenumber = substr($phonenumber, 1);}

			if(isset($_POST['Submit']))
			{
				if($type == NULL || $firstname == NULL || $lastname == NULL || $age == NULL || $school == NULL || $role == NULL ||
			   		$hometown == NULL || $phonenumber == NULL || $email == NULL || $password == NULL)
				{
					print "<script type=\"text/javascript\">"; 
					print "alert('All fields are required. Please enter all required information.')"; 
					print "</script>";  
					die;
				}

        $usernameB = mysql_num_rows(mysql_query("SELECT Username FROM Login_info WHERE Username = '$email'"));
        if($usernameB >= 1)
        {
          print "<script type=\"text/javascript\">"; 
          print "alert('Sorry! The email you inputted has already been registered.')"; 
          print "</script>";
          die;
        }

        $nameB = mysql_num_rows(mysql_query("SELECT Registration_no FROM Basic_info WHERE First_name = '$firstname'AND Last_name = '$lastname'"));
        if($nameB >= 1)
        {
          print "<script type=\"text/javascript\">"; 
          print "alert('Sorry! The name you inputted has already been registered.')"; 
          print "</script>";
          die;
        }

        if(strpos($email, '@') == false || strpos($email, '.') == false)
        {
          print "<script type=\"text/javascript\">"; 
          print "alert('Sorry! Please enter your email in an acceptable format.')"; 
          print "</script>";
          die;
        }

        if(strlen($phonenumber) != 10)
        {
          print "<script type=\"text/javascript\">"; 
          print "alert('Sorry! Please enter your phone number in the correct length.')"; 
          print "</script>";
          die;
        }

				if($password != $repassword)
				{
					print "<script type=\"text/javascript\">"; 
					print "alert('Please make sure both passwords you entered are the same.')"; 
					print "</script>";  
					die;
				}

        if($diet == "Other" && $otherdiet != NULL) { $diet = $otherdiet;}
        else if($diet == "Other" && $otherdiet == NULL)
        {
          print "<script type=\"text/javascript\">"; 
          print "alert('Please make sure specify your dietary restriction if you chose \"Other\"')"; 
          print "</script>";  
          die;
        }

				$basicregister = mysql_query("INSERT INTO Basic_info (Registration_no, First_name, Last_name, Preferred_name, Gender, Age, School, Come_from, Phone_no, Email, Role, Diet, Type, Tshirt_size)	
 										 	                             VALUES ('$regno', '$firstname', '$lastname', '$preferredname','$gender', '$age', '$school', '$hometown', '$phonenumber', '$email','$role', '$diet', '$type', '$size')");
		
        $password = md5($password);

				$loginregister = mysql_query("INSERT INTO Login_info (Registration_no, Username, Password)
												                           VALUES ('$regno', '$email', '$password')");

				//mysql_query("UPDATE Basic_info SET Emergency_no = REPLACE(Emergency_no, '-', '') WHERE Registration_no = '$regno'");

        print "<script type=\"text/javascript\">"; 
        print "alert('Registered successfully! Welcome to HackATL 2013!');";
        print "window.location.href = 'http://hackatl.org/';";
        print "</script>";
      }
		?>
    
    	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    
  </body>
</html>
