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

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(isset($_POST['Submit1']))
	{
		if($username == NULL || $password == NULL)
		{
			print "<script type=\"text/javascript\">"; 
			print "alert('Please enter your login information.');"; 
			print "location.href=\"login.html\";";
			print "</script>";  
		}
		else
		{
			if($username == "Admin@hackatl.org" && $password == "hackatl2013")
			{
				setcookie('username', "Admin@hackatl.org", time()+3600, '/2013/', '.hackatl.org');
       			setcookie('password', md5("hackatl2013"), time()+3600, '/2013/', '.hackatl.org');
      			
      			header("Location: Admin.php");
			}

			$usernameB = mysql_num_rows(mysql_query("SELECT Username FROM Login_info WHERE Username = '$username'"));
			if($usernameB == 1)
			{
				$searchresult = mysql_query("SELECT Password FROM Login_info WHERE Username = '$username'");
				$search = mysql_query("SELECT Loginedtime FROM Login_info WHERE Username = '$username'");

				if(mysql_result($searchresult, 0) == NULL && mysql_result($search, 0) == 0)
				{
					$newpassword = md5($password);
					$check = mysql_query("UPDATE Login_info SET Password = '$newpassword' WHERE Username = '$username'");

					print "<script type=\"text/javascript\">"; 
					print "alert('First time log in confirmed. Please log in again!');"; 
					print "location.href=\"login.html\";";
					print "</script>";
				}
				else if(md5($password) == mysql_result($searchresult, 0))
				{ 
					$regno = mysql_result(mysql_query("SELECT Registration_no FROM Login_info WHERE Username = '$username'"), 0);
							
					$loginedtime = mysql_result(mysql_query("SELECT Loginedtime FROM Login_info WHERE Username = '$username'"), 0);
					$check = mysql_query("UPDATE Login_info SET Loginedtime = loginedtime + 1 WHERE Username = '$username'");

					setcookie('regno', $regno, time()+3600, '/2013/', '.hackatl.org');
					setcookie('username', $_POST['username'], time()+3600, '/2013/', '.hackatl.org');
       				setcookie('password', md5($_POST['password']), time()+3600, '/2013/', '.hackatl.org');

					header("Location: index.php");
				}
				else
				{
					print "<script type=\"text/javascript\">"; 
					print "alert('Please enter the correct password.');"; 
					print "location.href=\"login.html\";";
					print "</script>";  
				}
						
			}
			else
			{
				print "<script type=\"text/javascript\">"; 
				print "alert('Please enter the correct username.');"; 
				print "location.href=\"login.html\";";
				print "</script>";  
			}
		}
	}
	else if(isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['regno']))
	{ header('Location: index.php');}
	else { header('Location: login.html');}
	
?>

	

