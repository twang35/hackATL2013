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
	$Tcount = mysql_num_rows(mysql_query("SELECT * FROM Team_info"));

	for($i = 1; $i < $regno+1; $i++)
	{
		$row = mysql_fetch_array(mysql_query("SELECT * FROM Basic_info WHERE Registration_no = $i"));
		$Binfo[$i-1] = $row;
	}

//Role ratio
	$DH = 0; $BS = 0; $DUU = 0; $M = 0;
	for($i = 0; $i < $regno; $i++)
	{
		if($Binfo[$i]['Type'] == 'C' && $Binfo[$i]['checkedin'] == 1){
		if($Binfo[$i]['Team_no'] == 0)
		{
			if($Binfo[$i]['Role'] != NULL)
			{
				$rolecount = 0;
				if(strpos($Binfo[$i]['Role'],'DH') !== false){ $rolecount++;}
				if(strpos($Binfo[$i]['Role'],'BS') !== false){ $rolecount++;}
				if(strpos($Binfo[$i]['Role'],'DUU') !== false){ $rolecount++;}
				if(strpos($Binfo[$i]['Role'],'M') !== false){ $rolecount++;}	

				switch ($rolecount) {
					case 1:
						$point = 1;
						if(strpos($Binfo[$i]['Role'],'DH') !== false){ $DH += $point;}
						if(strpos($Binfo[$i]['Role'],'BS') !== false){ $BS += $point;}
						if(strpos($Binfo[$i]['Role'],'DUU') !== false){ $DUU += $point;}
						if(strpos($Binfo[$i]['Role'],'M') !== false){ $M += $point;}
						break;
					case 2:
						$point = 0.5;
						if(strpos($Binfo[$i]['Role'],'DH') !== false){ $DH += $point;}
						if(strpos($Binfo[$i]['Role'],'BS') !== false){ $BS += $point;}
						if(strpos($Binfo[$i]['Role'],'DUU') !== false){ $DUU += $point;}
						if(strpos($Binfo[$i]['Role'],'M') !== false){ $M += $point;}
						break;
					case 3:
						$point = 0.33;
						if(strpos($Binfo[$i]['Role'],'DH') !== false){ $DH += $point;}
						if(strpos($Binfo[$i]['Role'],'BS') !== false){ $BS += $point;}
						if(strpos($Binfo[$i]['Role'],'DUU') !== false){ $DUU += $point;}
						if(strpos($Binfo[$i]['Role'],'M') !== false){ $M += $point;}
						break;
					case 4:
						$point = 0.25;
						if(strpos($Binfo[$i]['Role'],'DH') !== false){ $DH += $point;}
						if(strpos($Binfo[$i]['Role'],'BS') !== false){ $BS += $point;}
						if(strpos($Binfo[$i]['Role'],'DUU') !== false){ $DUU += $point;}
						if(strpos($Binfo[$i]['Role'],'M') !== false){ $M += $point;}
						break;
					
					default:
						break;
				}
			}
		}}
	}
	$sum = ($DH + $BS + $DUU + $M);
	$DH = $DH / $sum * 100;
	$BS = $BS / $sum * 100;
	$DUU = $DUU / $sum * 100;
	$M = $M / $sum * 100;

//Sort to specailty groups (according to role ratio)
	$GroupNone = array();
	$GroupDH = array();
	$GroupBS = array();
	$GroupDUU = array();
	$GroupM = array();
	for($i = 0; $i < $regno; $i++)
	{
		if($Binfo[$i]['Type'] == 'C' && $Binfo[$i]['checkedin'] == 1){
		if($Binfo[$i]['Team_no'] == 0 )
		{
			if($Binfo[$i]['Role'] != NULL)
			{
				$rolecount = 0;
				if(strpos($Binfo[$i]['Role'],'DH') !== false){ $rolecount++;}
				if(strpos($Binfo[$i]['Role'],'BS') !== false){ $rolecount++;}
				if(strpos($Binfo[$i]['Role'],'DUU') !== false){ $rolecount++;}
				if(strpos($Binfo[$i]['Role'],'M') !== false){ $rolecount++;}	

				switch ($rolecount) {
					case 1:
						if(strpos($Binfo[$i]['Role'],'DH') !== false){ $GroupDH[count($GroupDH)] = $Binfo[$i][0];}
						if(strpos($Binfo[$i]['Role'],'BS') !== false){ $GroupBS[count($GroupBS)] = $Binfo[$i][0];}
						if(strpos($Binfo[$i]['Role'],'DUU') !== false){ $GroupDUU[count($GroupDUU)] = $Binfo[$i][0];}
						if(strpos($Binfo[$i]['Role'],'M') !== false){ $GroupM[count($GroupM)] = $Binfo[$i][0];}
						break;
					case 2:
						$sum = 0; $DHC = false; $BSC = false; $DUUC = false; $MC = false;
						if(strpos($Binfo[$i]['Role'],'DH') !== false){ $sum += $DH; $DHC = true;}
						if(strpos($Binfo[$i]['Role'],'BS') !== false){ $sum += $BS; $BSC = true;}
						if(strpos($Binfo[$i]['Role'],'DUU') !== false){ $sum += $DUU; $DUUC = true;}
						if(strpos($Binfo[$i]['Role'],'M') !== false){ $sum += $M; $MC = true;}

						$rand = rand(0, ceil($sum));
						if($DHC == true && $BSC == true){ if($rand < $DH){$GroupDH[count($GroupDH)] = $Binfo[$i][0];}else{$GroupBS[count($GroupBS)] = $Binfo[$i][0];}}
						if($DHC == true && $DUUC == true){ if($rand < $DH){$GroupDH[count($GroupDH)] = $Binfo[$i][0];}else{$GroupDUU[count($GroupDUU)] = $Binfo[$i][0];}}
						if($DHC == true && $MC == true){ if($rand < $DH){$GroupDH[count($GroupDH)] = $Binfo[$i][0];}else{$GroupM[count($GroupM)] = $Binfo[$i][0];}}
						if($BSC == true && $DUUC == true){ if($rand < $BS){$GroupBS[count($GroupBS)] = $Binfo[$i][0];}else{$GroupDUU[count($GroupDUU)] = $Binfo[$i][0];}}
						if($BSC == true && $MC == true){ if($rand < $BS){$GroupBS[count($GroupBS)] = $Binfo[$i][0];}else{$GroupM[count($GroupM)] = $Binfo[$i][0];}}
						if($DUUC == true && $MC == true){ if($rand < $DUU){$GroupDUU[count($GroupDUU)] = $Binfo[$i][0];}else{$GroupM[count($GroupM)] = $Binfo[$i][0];}}	

						break;
					case 3:
						$sum = 0; $DHC = false; $BSC = false; $DUUC = false; $MC = false;
						if(strpos($Binfo[$i]['Role'],'DH') !== false){ $sum += $DH; $DHC = true;}
						if(strpos($Binfo[$i]['Role'],'BS') !== false){ $sum += $BS; $BSC = true;}
						if(strpos($Binfo[$i]['Role'],'DUU') !== false){ $sum += $DUU; $DUUC = true;}
						if(strpos($Binfo[$i]['Role'],'M') !== false){ $sum += $M; $MC = true;}

						$rand = rand(0, ceil($sum));
						if($DHC == true && $BSC == true && $DUUC == true){ if($rand < $DH){ $GroupDH[count($GroupDH)] = $Binfo[$i][0];}else if($rand < ($DH+$BS)){ $GroupBS[count($GroupBS)] = $Binfo[$i][0];}else{ $GroupDUU[count($GroupDUU)] = $Binfo[$i][0];}}
						if($DHC == true && $BSC == true && $MC == true){ if($rand < $DH){ $GroupDH[count($GroupDH)] = $Binfo[$i][0];}else if($rand < ($DH+$BS)){ $GroupBS[count($GroupBS)] = $Binfo[$i][0];}else{ $GroupM[count($GroupM)] = $Binfo[$i][0];}}
						if($DHC == true && $DUUC == true && $MC == true){ if($rand < $DH){ $GroupDH[count($GroupDH)] = $Binfo[$i][0];}else if($rand < ($DH+$DUU)){ $GroupDUU[count($GroupDUU)] = $Binfo[$i][0];}else{ $GroupM[count($GroupM)] = $Binfo[$i][0];}}
						if($BSC == true && $DUUC == true && $MC == true){ if($rand < $BS){ $GroupBS[count($GroupBS)] = $Binfo[$i][0];}else if($rand < ($BS+$DUU)){ $GroupDUU[count($GroupDUU)] = $Binfo[$i][0];}else{ $GroupM[count($GroupM)] = $Binfo[$i][0];}}

						break;
					case 4:
						$sum = $DH + $BS + $DUU + $M;
						$rand = rand(0, ceil($sum));
						if($rand < $DH){ $GroupDH[count($GroupDH)] = $Binfo[$i][0];}
						else if($rand < ($DH+$BS)){ $GroupBS[count($GroupBS)] = $Binfo[$i][0];}
						else if($rand < ($DH+$BS+$DUU)){ $GroupDUU[count($GroupDUU)] = $Binfo[$i][0];}
						else{ $GroupM[count($GroupM)] = $Binfo[$i][0];}

						break;
					
					default:
						break;
				}
			}
			else
			{
				$GroupNone[count($GroupNone)] = $Binfo[$i][0];
			}
		}
		}
	}

//Form Team
	$newteamc = 0;
	$newteam = array();
	$currentTeamnum = mysql_num_rows(mysql_query("SELECT * FROM Team_info"));
	$teampplno = 1;
	do{
		$DHP = floor($teampplno * $DH / 100);
		$BSP = floor($teampplno * $BS / 100);
		$DUUP = floor($teampplno * $DUU / 100);
		$MP = floor($teampplno * $M / 100);
		$teampplno++;
	}while($DHP == 0 || $BSP == 0 || $DUUP == 0 || $MP == 0);
	$teamsize = $DHP+$BSP+$DUUP+$MP;
	$totalppl = count($GroupNone)+count($GroupDH)+count($GroupBS)+count($GroupDUU)+count($GroupM);
	$numOfnewTeam = min(floor(count($GroupDH)/$DHP),floor(count($GroupBS)/$BSP),floor(count($GroupDUU)/$DUUP),floor(count($GroupM)/$MP));
	$pplleft = $totalppl-$numOfnewTeam*$teamsize;
	
	echo "Num of team = ".$numOfnewTeam." ppl left = ".$pplleft."<br>";	
	echo "Team size = ".($DHP+$BSP+$DUUP+$MP)."<br>";
	echo "People in each team: DH = ".$DHP." BS = ".$BSP." DUU = ".$DUUP." M = ".$MP."<br>";
	echo "GroupNone = ".count($GroupNone)."<br>";
	echo "GroupDH = ".count($GroupDH)."<br>";
	echo "GroupBS = ".count($GroupBS)."<br>";
	echo "GroupDUU = ".count($GroupDUU)."<br>";
	echo "GroupM = ".count($GroupM)."<br>";
	echo "Total count = ".(count($GroupNone)+count($GroupDH)+count($GroupBS)+count($GroupDUU)+count($GroupM))."<br>";

	$rangeDH = count($GroupDH)-1;
	$rangeBS = count($GroupBS)-1;
	$rangeDUU = count($GroupDUU)-1;
	$rangeM = count($GroupM)-1;

	for($i = 1; $i < $numOfnewTeam+1; $i++)
	{
		$teamno = $Tcount + $i;
		$teammember = '';
		for($j = 0; $j < $DHP; $j++){ 
			$rand = 0;
			do{
				$rand = rand(0, $rangeDH);
			}
			while($GroupDH[$rand] == 0 || $GroupDH[$rand] == null);
				$teammember .= $GroupDH[$rand]." ";
				unset($GroupDH[$rand]);
		}
		for($j = 0; $j < $BSP; $j++){
			$rand = 0;
			do{
				$rand = rand(0, $rangeBS);
			}
			while($GroupBS[$rand] == 0 || $GroupBS[$rand] == null);
				$teammember .= $GroupBS[$rand]." ";
				unset($GroupBS[$rand]);
		}
		for($j = 0; $j < $DUUP; $j++){ 
			$rand = 0;
			do{
				$rand = rand(0, $rangeDUU);
			}
			while($GroupDUU[$rand] == 0 || $GroupDUU[$rand] == null);
				$teammember .= $GroupDUU[$rand]." ";
				unset($GroupDUU[$rand]);
		}
		for($j = 0; $j < $MP; $j++){ 
			$rand = 0;
			do{
				$rand = rand(0, $rangeM);
			}
			while($GroupM[$rand] == 0 || $GroupM[$rand] == null);
				$teammember .= $GroupM[$rand]." ";
				unset($GroupM[$rand]);
		}
		$newteam[$newteamc] = $teamno." ".$teammember;
		$newteamc++;
		echo $teamno." ".$teammember."<br>";
	}

	$totalppl = count($GroupNone)+count($GroupDH)+count($GroupBS)+count($GroupDUU)+count($GroupM);
	$numOfleftTeam = floor($totalppl/$teamsize);
	$pplleft = $totalppl - $numOfleftTeam*$teamsize;
	$Groupleft = array_merge($GroupDH, $GroupBS);
	$Groupleft = array_merge($Groupleft, $GroupDUU);
	$Groupleft = array_merge($Groupleft, $GroupM);
	
	echo "<br># of ppl = ".$totalppl."<br>";
	echo "Num of team = ".$numOfleftTeam." ppl left = ".$pplleft."<br>";	
	
	$rangeleft = count($Groupleft)-1;

	for($i = 1; $i < $numOfleftTeam+1; $i++)
	{
		$teamno = $Tcount+$numOfnewTeam + $i;
		$teammember = '';
		for($j = 0; $j < $teamsize; $j++)
		{
			do
			{
				$rand = rand(0, $rangeleft);
			}
			while($Groupleft[$rand] == null);
			$teammember .= $Groupleft[$rand]." ";
			unset($Groupleft[$rand]);
		}
		$newteam[$newteamc] = $teamno." ".$teammember;
		$newteamc++;
		echo $teamno." ".$teammember."<br>";
	}
	while(count($Groupleft) > 0)
	{
		do{ $rand = rand(0, $rangeleft);}
		while($Groupleft[$rand] == null);
		$newteam[rand(0, count($newteam)-1)] .= " ".$Groupleft[$rand];
		unset($Groupleft[$rand]);
	}

	echo "Teams(".$teamsize."ppl)----------<br>";
	print_r($newteam);
	echo "<br>";

	for($i = 0; $i < count($newteam); $i++)
	{
		$characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ@#$%&';
    	$Tindo = '';
    	for ($j = 0; $j < 5; $j++) { $Tindo .= $characters[rand(0, strlen($characters) - 1)];}
    	
    	$newteaminfo = explode(" ", $newteam[$i]);

    	$teamleader = $newteaminfo[1];

    	$teammember = '';
    	for ($j = 1; $j < count($newteaminfo); $j++){ if($newteaminfo[$j] != null){ $teammember .= $newteaminfo[$j]." ";}}

		$query_team = "INSERT INTO Team_info (Team_no, Team_id_no, Team_name, Team_leader_no, Team_member_no) VALUES ('".$newteaminfo[0]."', '".$Tindo."', 'Team ".$newteaminfo[0]."', '".$teamleader."', '".$teammember."')";
		$update_team = mysql_query($query_team);
		echo $query_team." ".$update_team."<br>";
		for($j = 1; $j < count($newteaminfo); $j++)
		{
			if($j == 1)
			{
				$query_leader = "UPDATE Basic_info SET Team_leader_B = 1, Team_no = '".$newteaminfo[0]."' WHERE Registration_no = '".$newteaminfo[1]."'";	
				$update_leader = mysql_query($query_leader);
				echo $query_leader." ".$update_leader."<br>";
			}
			else if($newteaminfo[$j] != null)
			{
				$query_member = "UPDATE Basic_info SET Team_no = '".$newteaminfo[0]."' WHERE Registration_no = '".$newteaminfo[$j]."'";			
				$update_member = mysql_query($query_member);
				echo $query_member." ".$update_member."<br>";
			}
		}
		
	}
?>