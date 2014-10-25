<?php
	$regno=$_POST['regno'];
   	$email=$_POST['email'];
   	$json = array();
   	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	  {	  	
	  	$json['error'] = 1;
	  	echo json_encode($json);
	  } else {
	  	$json['error'] = 0;
		$_SESSION['session']=1; 

		$link = mysql_connect ('localhost', 'eevm', 'eventfeed1990', 'hackatl_Internal') 
		or die (mysql_error()); 

		if (!@mysql_select_db('hackatl_Internal', $link)) 
		{    
	     	echo "<p>This is the error message: System cannot connect to database.</p>"; 
	     	echo "<p><strong>" . mysql_error() . "</strong></p>"; 
	     	echo "Please email eevm@eevm.org for support."; 
	    } 	   

	   mysql_query("INSERT INTO Fitmoo (regno, email) VALUES ('$regno', '$email')");
	   echo json_encode($json);
	}
?>