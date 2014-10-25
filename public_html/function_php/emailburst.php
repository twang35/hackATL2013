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


  $count = mysql_query("SELECT * FROM Basic_info");
  $regno = mysql_num_rows($count);
  for($i = 1; $i < $regno+1; $i++)
  {
    $row = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = $i"));
    $Binfo[$i-1] = $row;
  }
  /*for($i = 0; $i < $regno; $i++) {
    echo $Binfo[$i]['First_name']." ".$Binfo[$i]['Last_name']." ".$Binfo[$i]['Email']."<br>";

  }*/
  


  $headers = "From: noreply@hackatl.org\r\n";
  $headers .= "Content Type: text/plain; charset=UTF-8";
  $headers .= "Content-Transfer-Encoding: quoted-printable";

  $to = "nihar06@gmail.com";
  $subject = "hackATL Registration Confirmation";
  /*$message = "Dear Nihar,\n";
  $message .=*/
  /*$message = '<html><body>';*/
  $message .= '<h3>Dear Nihar,</h3>';
  $message .= '<br><p>Thank you for registering for hackATL!</p>';
  $message .= '<p>hackATL is just one week away! We are really excited for an amazing weekend of networking, competition, and most importantly a great time. We are sure you are dying to learn a few more details about the event, and good news, our participant site is now open!</p>';
  $message .= '<p><strong>Login using your email and password at <a href=\"http://hackatl.org/\"><style=\"color: #FF9933\">http://hackatl.org</strong></style>.</p>';
  $message .= '<p>There, you will find a detailed schedule, competition and judges guidelines, and so much more. You can also begin creating teams using our team building functions.</p>';
  $message .= '<br><p><strong>See you all soon!</strong></p>';
  $message .= '<p><style=\"color: #FF9933\">The hackATL team.</style></p>';
  $message .= '<p><br><br><small>Please do not reply to this email. Forward all questions through the contact form on <a href=\"http://hackatl.org\">hackatl.org</a></style></p>';
  /*$message .= '</body></html>';*/
  
  $check_email = mail($to, $subject, $message, $headers);

  echo $check_email;

?>