


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.png">

    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="apple-touch-startup-image" href="/img/custom_icon_precomposed.png">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="img/custom_icon_precomposed.png">

    <script type="text/javascript">
      function OpenLink(theLink){
        window.location.href = theLink.href;
      }
    </script>
    
    <title>Contact | hackATL | Nov. 23-24</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
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
          <a class="navbar-brand" href="index.html" onclick="OpenLink(this); return false"><img src = "img/hackATLLogo2.png" atl = "hackATL" width = "60" height = "20"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="about.html" onclick="OpenLink(this); return false">About</a></li>
            <li><a href="schedule.html" onclick="OpenLink(this); return false">Schedule</a></li>
            <li><a href="faq.html" onclick="OpenLink(this); return false">FAQ</a></li>
            <li><a href="register.php" onclick="OpenLink(this); return false">Register</a></li>
            <li><a href="sponsor.html" onclick="OpenLink(this); return false">Sponsor</a></li>
            <li><a href="videos.html" onclick="OpenLink(this); return false">Videos</a></li>
            <li><a href="contact.html" onclick="OpenLink(this); return false">Contact</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="container">
    	<div class="page-header">
  			<h1>Contact the hack<text class="text-success">ATL</text> Team<br><small> &nbsp;send us a question. or two.</small></h1>
		</div>
	</div>

    <div class="container">
    	<div class="row">
        <div class="col-lg-8">
        	<br>
        	<form role="form" method=post onSubmit="return Validation_contact_form(this)" action="contact_form.php">
  				<div class="form-group">
    				<label for="exampleInputName1">Name</label>
    				<input type="name" class="form-control" id="exampleInputName1" name="name" placeholder="Name">
  				</div>
  				<div class="form-group">
    				<label for="exampleInputPassword1">Email</label>
    				<input type="email" class="form-control" id="exampleInputEmail1" name = "email"placeholder="Email">
  				</div>
  				<div class="form-group">
  				<label for="exampleInputComment1">Questions & Comments</label>
  				<textarea class="form-control" id="exampleInputComment1" name="comment" rows="5"></textarea>
  				<button type="submit" class="btn btn-default" name ="submit">Submit</button>
		</form>
        </div>
        <div class="col-lg-4">
          	<h3>Check out our pages!</h3>
          	<a href="http://www.facebook.com/hackatl"><img src="img/facebook.png" alt="Facebook" width="100" height="100"></a>&nbsp;&nbsp;<a href="http://www.twitter.com/hackatl"><img src="img/twitter.png" alt="Twitter" width="100" height="100"></a>
       	</div>
      	</div>
    	
    </div>
	
	<div class="container">
      <footer>
        <div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
      </footer>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    // <script src="function_js/validate.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>
