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


    $count = mysql_query("SELECT * FROM Sponsor_info");
	$regno = mysql_num_rows($count) + 1;
    $contactname = $_POST['contact_name'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $sponsor_amount = $_POST['sponsor_amount'];
    $comments = $_POST['comments'];

    $phonenumber = str_replace('.', '', $phonenumber);
    	$phonenumber = str_replace('+', '', $phonenumber);
    	$phonenumber = str_replace('(', '', $phonenumber);
    	$phonenumber = str_replace(')', '', $phonenumber);
    	$phonenumber = str_replace('-', '', $phonenumber);
    	$phonenumber = str_replace(' ', '', $phonenumber);
    $sponsor_amount = str_replace('$', '', $sponsor_amount);
    	$sponsor_amount = str_replace(',', '', $sponsor_amount);
    	$sponsor_amount = str_replace('-', '', $sponsor_amount);
    	$sponsor_amount = str_replace(' ', '', $sponsor_amount);
		$amount = (int)$sponsor_amount;
/*
	if(strlen($phonenumber) != 10)
    {
        print "<script type=\"text/javascript\">"; 
        print "alert('Sorry! Please enter your phone number in the correct length.')"; 
        print "window.location.href = '../../../../sponsor.html';";
        print "</script>";
        die;
    }

    if($contactname == NULL || $company == NULL)
    {
    	print "<script type=\"text/javascript\">"; 
        print "alert('Sorry! Please specify both your name and the sponsoring company.')"; 
        print "window.location.href = '../../../../sponsor.html';";
        print "</script>";
        die;
    }
*/
    $check = mysql_query("INSERT INTO Sponsor_info (No, Contact_name, Company, Email, Phone_no, Amount, Comment)
    										 VALUES('$regno', '$contactname', '$company', '$email', '$phonenumber', '$amount', '$comments')");

    print "<script type=\"text/javascript\">"; 
    print "alert('Thank you for your support! We will contact you as soon as possible.');";
    print "window.location.href = '../../../../index.html';";
    print "</script>";
?>