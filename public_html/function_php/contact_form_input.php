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

      $count = mysql_query("SELECT * FROM Questions");
      $regno = mysql_num_rows($count) + 1;
      
      $name = $_POST['name'];
      $email = $_POST['email'];
      $comment = $_POST['comment'];

      date_default_timezone_set('America/New_York');
      $datetime = date('Y-m-d H:i:s');

        if($name == NULL ||$email == NULL || $comment == NULL)
        {
          print "<script type=\"text/javascript\">"; 
          print "alert('All fields are required. Please enter all required information.')"; 
          print "</script>";  
          die;
        }

        $commentadd = mysql_query("INSERT INTO Questions (Registration_no, Name, Email, Comment, Created_time)  
                                                   VALUES ('$regno', '$name', '$email','$comment', '$datetime')");
    
          
        print "<script type=\"text/javascript\">"; 
        print "alert('Thank you for your Questions and Comments! We will get back to you as soon as we can!');";
        print "window.location.href = 'http://hackatl.org/';";
        print "</script>";
?>