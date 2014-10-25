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
  
  $email=$_POST['email'];
  if(mysql_num_rows(mysql_query("SELECT * FROM Basic_info WHERE Email = '$email'")) == 1)
  {
    $newpassword = '';
    $characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ@#$%&';
    for ($i = 0; $i < 8; $i++) { $newpassword .= $characters[rand(0, strlen($characters) - 1)];}

    $query = "UPDATE Login_info SET Password = '". md5($newpassword). "' WHERE Username = '$email'";
    $check = mysql_query($query);

    $headers = "From: noreply@hackatl.org\r\n";
    //$headers .= "Content Type: text/plain; charset=UTF-8";
    //$headers .= "Content-Transfer-Encoding: quoted-printable";

    $to = $email;
    $subject = "hackATL Password Reset";

    $name = mysql_result(mysql_query("SELECT First_name FROM Basic_info WHERE Email = '$email'"), 0);
    $message .= 'Dear '.$name.', ';
    $message .= 'this is your new login password: '.$newpassword.' . Please login to your account at http://hackatl.org and change your password under \'Profile Change\'.';
  
    $check_email = mail($to, $subject, $message, $headers);

    print "<script type=\"text/javascript\">"; 
    print "alert('A new password has sent to your email.');"; 
    print "location.href=\"http://hackatl.org\";";
    print "</script>";
  }
  else
  {
    print "<script type=\"text/javascript\">"; 
    print "alert('Your email is not registered at hackATL. Please type in a registered email.');"; 
    print "location.href=\"http://hackatl.org/forgotpwd.html\";";
    print "</script>";
  }
?>