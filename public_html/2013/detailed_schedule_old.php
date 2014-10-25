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
  else{ header('Location: /2013/login.html');}


  if(isset($_POST['profilechange'])){ header('Location: profilechange.php');}
  if(isset($_POST['teamprofilechange'])){ header("Location: teamprofilechange.php");}
  if(isset($_POST['roomreservation'])){ header("Location: roomreserve.php");}
  if(isset($_POST['advisorreservation'])){ header("Location: advisorreserve.php");}
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
              <li class="hidden-sm hidden-xs"><a href="profilechange.php">Welcome <?php echo $Binfo[1] . " " . $Binfo[2]; ?>!</a></li>
              <li>
                <input type="submit" class="btn btn-danger"  Name = "logout" value="Log out" style="position:relative; margin-top:10px;"></input>
              </li>

              </ul>
          </div>
        </div>
      </div>
      <!-- header end-->
    </form>

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
      <div class="page-header">
        <h1>hack<text class="text-success">ATL</text> Calendar of Events<br><small> &nbsp;three days of amazing.</small></h1>
      </div>
     </div>

    <div class="container">
      <div class="row">
        <div class="panel-group" id="accordion">
        <div class = "col-md-12">
        <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th colspan="2"><h2>Friday, November 22</h2></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <!-- <div class="panel panel-default"> -->
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      5:00 - 6:00 PM &nbsp;&nbsp; Registration / Check-in
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse out">
                  <div class="panel-body">
                    <b>Room: Coca-Cola Commons</b> 

                    <br><br>

                    Check-in with our team and receive your name tag, schedule, and t-shirt (t-shirts are first come first serve) 
                  </div>
                </div>
              <!-- </div> panel panel-default -->
     <!--        <td><font size="4">5:00-6:00 PM</font></td>
            <td><font size="4">Registration</font></td> -->

            </td>
          </tr>
          <tr>
            <td>
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    6:00 - 7:00 PM &nbsp;&nbsp; Dinner / Informal Networking
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse out">
                <div class="panel-body">
                  <b>Room: Coca-Cola Commons</b> 

                  <br><br>

                  Enjoy your dinner, sponsored by Twisted Taco, Willy's Mexicana Grill, Domino's, and Papa John's, as you mingle with other participants. 
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    7:00 - 8:00 PM &nbsp;&nbsp; Introduction to hack<text class="text-success">ATL</text>
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse out">
                <div class="panel-body">
                  <b>Room: Auditorium 130</b> 

                  <br><br>

                  Our team will introduce ourselves, give an overview of hack<text class="text-success">ATL</text>, go over the schedule, and give an example of what your team should have completed before you present on Sunday. Jeff Dyment of Fitmoo will speak about his company and the Fitmoo project.
                </div>
              </div>
            </td>
            <!-- <td class="span3">7:00-8:00 PM </td>  -->
            <!-- <td>Introduction to hackATL + Pitches</td> -->
            
          </tr>
          <tr>
            <td>
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                    8:00 - 10:00 PM &nbsp;&nbsp; Idea pitching and team formation
                  </a>
                </h4>
              </div>
              <div id="collapseFour" class="panel-collapse collapse out">
                <div class="panel-body">
                  <b>Room: Classroom 301, Classroom 304, Classroom 331, Classroom 338</b> 

                  <br><br>

                  This is your time to network! Meet your talented fellow participants, share your ideas, and find your teammates! If you came with an idea you want to work on, you will be able to briefly pitch your idea during our open-mic session to find people who want to help with your idea. 
                </div>
              </div>
            </td>
            <!-- <td class="span3">8:00-9:00 PM</td> -->
            <!-- <td>Form Teams</td> -->
            
          </tr>

          <tr>
            <td>
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFourB">
                    8:30 PM &nbsp;&nbsp; Team Registration Opens
                  </a>
                </h4>
              </div>
              <div id="collapseFourB" class="panel-collapse collapse out">
                <div class="panel-body">
                  <b>Coca-Cola Commons</b> 

                  <br><br>

                  Once you have formed your team, head over to our team registration table. We will officially register your team, your team members, and your project. Your team will also be able to reserve workrooms at this time. 
                </div>
              </div>
            </td>
            <!-- <td class="span3">8:00-9:00 PM</td> -->
            <!-- <td>Form Teams</td> -->
            
          </tr>

          <tr>
            <td>
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                    10:00 PM --  &nbsp;&nbsp; Hack away!
                  </a>
                </h4>
              </div>
              <div id="collapseFive" class="panel-collapse collapse out">
                <div class="panel-body">
                  <b>Room: Classroom 201, Classroom 204, Classroom 231, Classroom 234, Classroom 238, BR-109, BR-110, BR -114, BR-115</b> 

                  <br><br>

                  Get started! Get to know your team members, talk about your general ideas for your project, and start creating a detailed plan for your business idea. If you have questions or need help getting started, don't hesitate to talk to one of our team members or our mentors. 
                </div>
              </div>
            </td>
            <!-- <td class="span3">9:00-12:00 AM</td> -->
            <!-- <td>Hack away!</td> -->
            
          </tr>
        </tbody>
      </table>
    </div> <!-- class = "col-md-12" -->
      
    <div class = "col-md-12">
      <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th colspan="2"><h2>Saturday, November 23</h2></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                  9:00 - 10:00 AM &nbsp;&nbsp; Registration for New Teams Only
                </a>
              </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse out">
              <div class="panel-body">
                <!-- <b>Room:</b> 

                <br><br>

                Details: TBA -->
              </div>
            </div>
          </td>
     <!--      <td>9:00-10:00 AM</td>
          <td>Registration for New Teams Only</td> -->
        </tr>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                  10:00 - 11:00 AM &nbsp;&nbsp; Brunch
                </a>
              </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: Coca-Cola Commons</b> 

                <br><br>

                Good morning! Today is your big work day. Most of the day will be spent working with your teammates to develop your project as much as possible so that it will be ready to present tomorrow. Please enjoy the bagels, provided by Goizueta Business School's BBA Office, and get started on your work! 
              </div>
            </div>
          </td>
     <!--      <td class="span3">10:00 AM-12:00 PM</td> 
          <td>Brunch</td> -->
          
        </tr>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                  2:00 - 4:00 PM &nbsp;&nbsp; Workshops and Speaker Presentations
                </a>
              </h4>
            </div>
            <div id="collapseEight" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room:</b> 

                <br><br>

                Details: TBA<br><br>

                <b>Speakers:</b><br>

                  <!-- Button trigger modal -->
                  <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal2">
                  <!-- <img src="http://hackatl.org/public_html/Speakers/ReneeDye.jpg" alt="Renee Dye" class="img-thumbnail">
                  -->
                    Elliot Bendoly
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Elliot Bendoly</h4>
                      </div>
                      <div class="modal-body">
                      <h5>
                      <b>Title: </b>Associate Professor of Information Systems & Operations Management<br><br>
                      <b>Company: </b>Goizueta Business School<br><br>
                      <b>HackATL: </b>Advisor<br><br>
                      </h5>
                      <img src = "img/Speakers/bendoly.jpg">
                      <!-- <b>Biography: </b><p>
                      </p> -->
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                  
                  <br><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal4">
                    John Duisberg
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">John Duisberg</h4>
                      </div>
                      <div class="modal-body">
                      <h5>
                      <b>Title: </b>Co-Founder<br><br>
                      <b>Company: </b>Cooleaf<br><br>
                      <b>HackATL: </b>Speaker<br><br>
                      </h5>
                      <!-- <b>Biography: </b><p>
                      </p> -->
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
                </div><!-- panel body -->
              </div>
          </td>
          
      </td>
          
        </tr>
        
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
                  4:00 - 5:00 PM &nbsp;&nbsp; Entrepreneur Q&amp;A Panel
                </a>
              </h4>
            </div>
            <div id="collapseNine" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: Classroom 208</b> 

                <br><br>

                There will be several entrepreneurs to answer questions from the audience. They will be sharing their stories of starting their business and offering valuable advice that you don't want to miss! The panel includes Jonathan cone (Co-founder of Itzaflash.com), Mike Ames (CEO of bizgarage), Denver Rayburn (Founder of Posterfuse), Jesse Maddox (CEO of triplingo) and Dario. This event is also open to workshop-only participants. 
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#10">
                  4:00 - 5:00 PM &nbsp;&nbsp; Advisor Sessions
                </a>
              </h4>
            </div>
            <div id="10" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: BR - 109, BR - 110, BR - 114, BR - 115</b> 

                <br><br>

                During these advisor sessions, your team will be able to request a 15 minute one-on-one sessions with one of our four advisors. Sign-ups will be available online. Space is limited, so sign-up early if you wish to take advantage of this opportunity. 
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#11">
                  6:00 - 7:00 PM &nbsp;&nbsp; Dinner
                </a>
              </h4>
            </div>
            <div id="11" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: Coca-Cola Commons</b> 

                <br><br>

                Take a break from your hard work. Grab some pizza sponsored by Pizza Bella and tacos sponsored by Bad Dog Taqueria, relax, and get energized with some free energy drinks, sponsored by Redbull! 
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#22">
                  9:00 - 11:00 PM &nbsp;&nbsp; Pitch Practice
                </a>
              </h4>
            </div>
            <div id="22" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: Classroom - 208</b> 

                <br><br>

                Gain valuable input from mentors and fellow participants. You will have 5 minutes to pitch your idea and will have up to 5 minutes to receive feedback from the audience. While this pitch practice session is optional, getting other people to look over your project will provide you with fresh insight and areas to improve on before your actual presentation tomorrow. 
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#12">
                  11:00 PM -- &nbsp;&nbsp; Hack away!
                </a>
              </h4>
            </div>
            <div id="12" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: Classroom 201, Classroom 204, Classroom 231, Classroom 234, Classroom 238, BR-109, BR-110, BR -114, BR-115</b> 

                <br><br>

                Continue to work on your project. You are allowed to stay overnight if you wish to continue working through the night. We will also have showers available. Our team will be around if you need any help, and we will also be providing midnight snacks! 
              </div>
            </div>
          </td>
     <!--      <td class="span3">5:00 PM-12:00 AM </td> 
          <td>Hack away!</td> -->
          
        </tr>
        
      </tbody>
    </table>
    </div> <!-- class = "col-md-12" -->
      
     
    <div class = "col-md-12">
      <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th colspan="2"><h2>Sunday, November 24</h2></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#13-">
                  -- 10:00 AM &nbsp;&nbsp; Final Touches
                </a>
              </h4>
            </div>
            <div id="13-" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: Classroom 201, Classroom 204, Classroom 231, Classroom 234, Classroom 238, BR-109, BR-110, BR -114, BR-115</b> 

                <br><br>

                Almost there! This is your time to finalize your business plan and your presentation. Remember that you only have 5 minutes to pitch your idea, so practice a few times to make sure you effectively communicate your ideas to the judges. As always, mentors and team members will be around to help you. 
              </div>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#13">
                  10:00 AM &nbsp;&nbsp; Project Due!
                </a>
              </h4>
            </div>
            <div id="13" class="panel-collapse collapse out">
              <div class="panel-body">
                Submit your project presentation. You will only be allowed to use what you submitted during your pitch to the judges. 
              </div>
            </div>
          </td>
        </tr>
       
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#14">
                  11:00 - 12:00 PM &nbsp;&nbsp; Preliminary Judging
                </a>
              </h4>
            </div>
            <div id="14" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: Classroom - 201, Classroom 204, Classroom - 208, Classroom - 301, Classroom 331</b> 
                <br><br>

                Three judges will be reviewing your project for preliminary judging. The judges will be using a uniform, objective scoring rubric and this score will determine whether or not your team will make it to the final round of judging. 
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#15">
                  12:00 - 12:45 PM &nbsp;&nbsp; Lunch
                </a>
              </h4>
            </div>
            <div id="15" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: Coca-Cola Commons</b> 

                <br><br>

                Congratulations! You've survived. You have created a business in less than two days. Now, relax and enjoy the pasta catered from Saba and some shaved ice sponsored by SunO. We will announce the teams proceeding to the final round of judging at the end of lunch. 
              </div>
            </div>
          </td>
      <!--     <td>11:30 AM-1:00 PM</td>
          <td>Brunch</td> -->
        </tr>
        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">
                  1:00 - 2:30 PM &nbsp;&nbsp; Final Judging
                </a>
              </h4>
            </div>
            <div id="collapseEleven" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: W525 - Reception Space</b>

                <br><br>

                The top teams will pitch their projects in front of all of judges and participants. Each team will have 5 minutes to present and a maximum of 10 minutes to answer questions. You can also ask questions by submitting the questions via Twitter! 
                <br><br>

                <b>Judges:</b> <br>

                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#sp">
                Sanjay Parekh
                </button><br>

               <!-- Modal -->
                <div class="modal fade" id="sp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Sanjay Parekh</h4>
                    </div>
                    <div class="modal-body">
                    <h5>
                    <b>Title: </b>Founder<br><br>
                    <b>Company: </b>Startup Riot<br><br></h5>
                    <h5><b>Biography: </b></h5><p>Sanjay Parekh is the founder of Startup Riot and a co-founder of Shotput Ventures. Prior to his current efforts to build up the Atlanta area entrepreneurial community he was the Founder, CEO, Chief Strategy Officer, and member of the Board of Directors at Digital Envoy, a IP based geographic targeting technology company. He was also an American Marshall Memorial Fellow at German Marshall Fund of the United States, member at Young Entrepreneurs Organization, and a Technology Pioneer (2002 &amp; 2003) at World Economic Forum.</p><p>In 2003, he was named to the MIT Technology Review TR100 as one of the top 100 innovators in the world under the age of 35.</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->      
                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal1">
                <!-- <img src="http://hackatl.org/public_html/Speakers/ReneeDye.jpg" alt="Renee Dye" class="img-thumbnail">
                -->
                  Renee Dye
                </button><br>

                <!-- Modal -->
                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Renee Dye</h4>
                    </div>
                    <div class="modal-body">
                    <h5>
                    <b>Title: </b>Founder & CEO<br><br>
                    <b>Company: </b>Stratitect<br><br></h5>
                    <h5><b>Biography: </b></h5><p>Renee Dye is the Founder and Managing Member of Stratitect, a Strategy Consulting Firm.  
                    Prior to founding Stratitect, Renee served as a Senior Expert in Strategy for the Atlanta and London offices of 
                    McKinsey & Company from 1996-2012.  Renee has served clients across every industry on a range of strategy topics, 
                    with particular expertise in strategy development and strategic planning, war gaming, innovation and ideation, corporate 
                    strategy, and decision-making.  Renee has researched and published on a wide variety of strategy-related topics, and her 
                    articles have appeared in Fortune, Harvard Business Review, Advertising Age, and The McKinsey Quarterly.</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->          

                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal5">
                <!-- <img src="http://hackatl.org/public_html/Speakers/ReneeDye.jpg" alt="Renee Dye" class="img-thumbnail">
                -->
                  
                  Jon Birdsong
                </button><br>

                <!-- Modal -->
                <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Jon Birdsong</h4>
                    </div>
                    <div class="modal-body">
                    <h5>
                    <b>Title: </b>Founder and CEO<br><br>
                    <b>Company: </b>Rivalry<br><br>
                    <b>HackATL: </b>Judge<br><br>
                    <b>Biography: </b>
                    </h5>
                    <p>Jon Birdsong has B2B and B2C technology experience. Before starting Rivalry, Jon ran 
                    sales and marketing for SalesLoft (Atlanta Ventures portfolio company and TechStars 2012 company). Before 
                    SalesLoft, Jon lead marketing at OpenStudy, one of the Top 10 Most Innovative Companies In Education (Fast 
                    Company). Rivalry is a new sales process management software that helps drive competition among sales reps 
                    with the use of live leader boards and other real-time competitive tools so both team members and sales 
                    leaders can track performance.
                    </p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> 
                  <!-- Button trigger modal -->
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal3">
                <!-- <img src="http://hackatl.org/public_html/Speakers/ReneeDye.jpg" alt="Renee Dye" class="img-thumbnail">
                -->
                  Andrew Bate
                </button><br>

                <!-- Modal -->
                <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Andrew Bate</h4>
                    </div>
                    <div class="modal-body">
                    <h5>
                    <b>Title: </b>Founder and CEO<br><br>
                    <b>Company: </b>Safely Stay<br><br>
                    <b>HackATL: </b>Judge<br><br>
                    </h5>
                    <!-- <b>Biography: </b><p>
                    </p> -->
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                 
              <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal9">
                <!--<img src="http://hackatl.org/public_html/Speakers/ReneeDye.jpg" alt="Renee Dye" class="img-thumbnail">
                -->
                  Benn Konsynski
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Benn Konsynski</h4>
                    </div>
                    <div class="modal-body">
                    <h5>
                    <b>Title: </b>George S. Craft Distinguished University Professor of information Systems & Operations Management<br><br>
                    <b>Company: </b>Goizueta Business School<br><br>
                    <b>HackATL: </b>Judge<br><br>
                    </h5>

                    <b>Biography: </b><p>
                    Benn R. Konsynski arrived at Goizueta Business School following six years on the faculty at the Harvard Business School where he taught in the MBA program and several executive programs. Prior to arriving at HBS, he was a professor at the University of Arizona where he was a co-founder of the university's multi-million dollar group decision support laboratory. He holds a Ph.D. in Computer Science from Purdue University.

                    He has published in such diverse journals as Communications of the ACM, Harvard Business Review, IEEE Transactions on Communications, MIS Quarterly, Journal of MIS, Data Communications, Decision Sciences, Decision Support Systems, Information Systems, and IEEE Transactions on Software Engineering.<br><br>

                    <b>Areas of Specialization: </b> <br>
                    Electronic data interchange (EDI)<br>
                    Channel systems<br>
                    Electronic integration<br>
                    Information partnerships<br>
                    Digital Commerce<br>
                    Selected Consulting Clients<br>
                    IBM<br>
                    AT&T<br>
                    Northern Trust<br>
                    Texas Instruments<br>
                    U.S. Army<br>
                    Northwestern Mutual Life Insurance<br>
                    MicroAge<br>
                    Ernst and Young<br>
                    Bank of Montreal<br>
                    UPS<br>
                    Education<br>
                    Ph.D. Ph.D. in Computer Science, Purdue University, West Lafayette, IN/United States
                    </p> 
                    <img src = "/img/Speakers/konsynski.jpg">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              </div>
            </div> <!-- collapseEleven -->
          </td>
        </tr>

        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#16">
                  2:30 - 3:00 PM &nbsp;&nbsp; Keynote Speaker
                </a>
              </h4>
            </div>
            <div id="16" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: W525 - Reception Space</b>

                <br><br>

                As we wait for the scores to be tallied up, we will have a performance from Emory's acapella group, No Strings Attached. Then Sanjay Parekh, Start-up genius and venture capitalist, will be giving a short keynote speech. Finally, we will be giving out giftcards to random winners! 
              </div>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#17">
                  3:00 - 3:30 PM &nbsp;&nbsp; Prizes Awarded
                </a>
              </h4>
            </div>
            <div id="17" class="panel-collapse collapse out">
              <div class="panel-body">
                <b>Room: W525 - Reception Space</b>

                <br><br>

                We will award our top 3 winners with various prizes. We also have mini-awards to give out, so make sure to stick around in case your team wins! 
              </div>
            </div>
          </td>
        </tr>

      </tbody>
    </table>
    </div> <!-- class = "col-md-12" -->

    </div> <!-- panel group; id accordian-->
        
        

    </div> <!-- row -->

    </div> <!-- container -->      
    <br><br>
  
  <div class="container">
    <footer>
      <div class="pull-left"><p>&copy; 2013 hack<text class="text-success">ATL</text> | <a href="http://eevm.org">Emory Entrepreneurship & Venture Management</a> | <a href="http://emory.edu">Emory University</a></p></div>
      <div class="pull-right">
        <a href="http://www.facebook.com/hackatl"><img src="img/facebook.png" alt="Facebook" width="50" height="50"></a>&nbsp;&nbsp;<a href="http://www.twitter.com/hackatl"><img src="img/twitter.png" alt="Twitter" width="50" height="50"></a></div>
      
    </footer>
  </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>
