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
            <li><a href="winners.html" onclick="OpenLink(this); return false">Winners</a></li>
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
        <h1>Registration closed<br><small>Sorry! Free registration is now closed.</small></h1><br>If you would still like to participate in hackATL, you will have to pay a $10 late registration fee when you check-in.
    </div>
  </div>
  
  <div class="container">
      <footer>
        <div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
        <div class="pull-right">
          <a href="http://www.facebook.com/hackatl"><img src="img/facebook.png" alt="Facebook" width="50" height="50"></a>&nbsp;&nbsp;<a href="http://www.twitter.com/hackatl"><img src="img/twitter.png" alt="Twitter" width="50" height="50"></a></div>
        </div>
      </footer>
    </div> <!-- /container -->
        
      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    
  </body>
</html>
