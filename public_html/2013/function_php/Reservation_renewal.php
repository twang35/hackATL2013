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

  	if($_COOKIE['regno'] != 1 || !isset($_COOKIE['username']) || !isset($_COOKIE['password']))
	{ header('Location: login.html');}

	$TeamCount = mysql_num_rows(mysql_query("SELECT * FROM Team_info"));
	$RoomCount = mysql_num_rows(mysql_query("SELECT * FROM Room_info"));
	$AdviosrCount = mysql_num_rows(mysql_query("SELECT * FROM Advisor_info"));

	for($i = 1; $i = $TeamCount+1; $i++)
	{
		$query = "UPDATE Team_info SET Room_reserve = '', Advisor_reserve = '' WHERE Team_no = ".$i;
	}
	for($i = 1; $i = $RoomCount+1; $i++)
	{
		for($j = 0 ; $j < 14; $j++)
		{
			$query = "UPDATE Room_info SET T".($j+10)." = 0 WHERE Room_no = ".$i;
		}
	}
	for($i = 1; $i = $AdviosrCount+1; $i++)
	{
		for($j = 0 ; $j < 14; $j++)
		{
			$query = "UPDATE Advisor_info SET T".($j+10)." = 0 WHERE Room_no = ".$i;
		}
	}
?>