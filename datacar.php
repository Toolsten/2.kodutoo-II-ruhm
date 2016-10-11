<?php
	require("autofunction.php");
	require("../../../config.php");
	

	$plate = "";
	$color = "";
	
	if(isset($_POST["plate"]) &&
		isset($_POST["color"]) &&
		!empty($_POST["plate"]) &&
		!empty($_POST["color"])

	) {
		saveCar(cleanInput($_POST["color"]), cleanInput ($_POST["plate"]);
	}
	
	//saan kõik auto andmed
	$carData = getAllCars();
	echo "<pre>";
	var_dump($carData);
	echo "</pre>";
?>

	<h1>Sisesta auto nr ja värv</h1>
	
	<form method="POST">
		
		<br>
		
		<input name="color" placeholder="sisesta värv" type="color" value="<?=$color;?>">
		<br><br>
		
		<input name="plate" placeholder="number" type="text" value="<?=$plate;?>">
		<br><br>
		
		<input type="submit" value="kinnita">
		
	</form>
	
<h2>AUTOOD</h2>

<?php

	$html = "<table>";
	
	$html .= "<tr>";
		$html .= "<th>id</th>";
		$html .= "<th>color</th>";
		$html .= "<th>plate</th>";
	$html .= "</tr>";

	//iga liikme kohta massiivis
	foreach($carData as $c) {
		//iga auto on $c
		//echo $c->plate."<br>";
		
	$html .= "<tr>";
		$html .= "<td>".$c->id."</td>";
		$html .= "<td style='background-color:".$c->color."'>".$c->color."</td>";
		$html .= "<td>".$c->plate."</td>";
	$html .= "</tr>";
		
	}

	
	$html .= "</table>";
	
	echo $html;
	
	$listHtml  = "<br><br>";
	
	foreach($carData as $c) {
		
		$listHtml.= "<h1 style='color:".$c->color."'>".$c->plate."</h1>";
		$listHtml .="<p>color = ".$c->color."</p>";
		
			
	}
	
	echo $listHtml;
?>



