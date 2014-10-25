<?php

$link = mysql_connect ('localhost', 'eevm', 'eventfeed1990', 'hackatl_Internal') 
	or die (mysql_error()); 

	if (!@mysql_select_db('hackatl_Internal', $link)) 
	{    
     	echo "<p>This is the error message: System cannot connect to database.</p>"; 
     	echo "<p><strong>" . mysql_error() . "</strong></p>"; 
     	echo "Please email eevm@eevm.org for support."; 
    } 
 
 $room = array("201", "204", "208", "301", "331", "334");
 $timing = array("11:00 AM","11:05 AM","11:10 AM","11:15 AM","11:20 AM","11:25 AM","11:25 AM","11:30 AM","11:35 AM");
 for ($i = 0; $i <= 5; $i++) 
 {
 	for ($j = 0; $j <= 8; $j++) 
 	{
 		
 		do 
 		{
 			$test = rand(1, 75);
 		} 
 		while (mysql_result(mysql_query("SELECT Team_no FROM Prelim_slots WHERE Team_no = '$test'"), 0) != null && mysql_result(mysql_query("SELECT Time FROM Prelim_slots WHERE Team_no = '$test'"), 0) == 0 && mysql_result(mysql_query("SELECT Room FROM Prelim_slots WHERE Team_id_no = '$test'"), 0) == 0);
 		
 		$query = "UPDATE Prelim_slots SET Room = '".$room[$i]."', Time = '".$timing[$j]."' WHERE Team_no = ".$test;
 		$check = mysql_query($query);
 		echo $query." ".$check."<br>";
 		
	}
}

 ?>