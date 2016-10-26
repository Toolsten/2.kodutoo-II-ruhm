<?php

	require("functions.php");
	
	
	//kui ei ole kasutaja id'd
	if (!isset($_SESSION["userId"])){
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
	}
	
	
	//kui on ?logout aadressireal siis login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	$msg = "";
	if(isset($_SESSION["message"])){
		$msg = $_SESSION["message"];
		
		//kui ühe näitame siis kustuta ära, et pärast refreshi ei näitaks
		unset($_SESSION["message"]);
	}
	


	




	$scores = getAllScores();
	
	
	if  (isset($_POST["league"]) && 
		isset($_POST["hometeam"]) && 
		isset($_POST["awayteam"]) && 
		isset($_POST["homescore"]) && 
		isset($_POST["awayscore"]) &&  
		!empty($_POST["league"]) &&
		!empty($_POST["hometeam"]) && 		
		!empty($_POST["awayteam"]) && 
		!empty($_POST["homescore"]) && 
		!empty($_POST["awayscore"]) 
	)	{
		  
		saveScores(cleanInput($_POST["league"]), cleanInput($_POST["hometeam"]), cleanInput($_POST["awayteam"]), cleanInput($_POST["homescore"]), cleanInput($_POST["awayscore"]));

	  }





?>

<html>
<h2>SaveScore</h2>
<h2><a href="data.php"> < tagasi</a></h2>

<form method="POST">
	
	<label>League</label><br>
	<input name="league" type="text">
	<br><br>
	
	<label>Home Team</label><br>
	<input type="text" name="hometeam" >
	<br><br>
	
	<label>Away Team</label><br>
	<input name="awayteam" type="text">
	<br><br>
	
	<label>Home Score</label><br>
	<input name="homescore" type="text">
	<br><br>
	
	<label>Away Score</label><br>
	<input name="awayscore" type="text">
	<br><br>
	
	<input type="submit" value="Salvesta">
	
	
</form>
        <?php
            
    $html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>leaguename</th>";
		$html .= "<th>hometeam</th>";
		$html .= "<th>awayteam</th>";
		$html .= "<th>homescore</th>";
		$html .= "<th>awayscore</th>";
	$html .= "</tr>";
	
	
	foreach($scores as $s){
		
		
		$html .= "<tr>";
			$html .= "<td>".$s->id."</td>";
			$html .= "<td>".$s->league."</td>";
			$html .= "<td>".$s->hometeam."</td>";
			$html .= "<td>".$s->awayteam."</td>";
			$html .= "<td>".$s->homescore."</td>";
			$html .= "<td>".$s->awayscore."</td>";	
		$html .= "</tr>";
	}
	
	$html .= "</table>";
	
	echo $html;
	
	$listHtml = "<br><br>";
	

	
	echo $listHtml;
            
        ?>
    </select>
    
	
</form>
</html>

