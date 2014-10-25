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

	$Acount = mysql_num_rows(mysql_query("SELECT * FROM Attendance"));
	for($i = 1; $i < $Acount+1; $i++)
	{
		$query = mysql_query("SELECT * FROM Attendance WHERE No = '$i'");
		$row = mysql_fetch_array($query);
		$Ainfo[$i-1] = $row;
		//print_r($Ainfo[$i-1]);
	}

	for($i = 0; $i < $Acount+1; $i++)
	{
		if($Ainfo[$i][3] == 1)
		{
			$query = "UPDATE Basic_info SET checkedin = 1 WHERE First_name = '".$Ainfo[$i][1]."' AND Last_name = '".$Ainfo[$i][2]."'";
			$update = mysql_query($query);
			if($update) { print "sucess<br>";}
			else {print "fail<br>";}
			//echo $query."<br>";
			//print $Ainfo[$i][1]." ".$Ainfo[$i][2]." ".$Ainfo[$i][3]."<br>";
		}
	}
	
?>