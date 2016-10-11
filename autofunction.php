

<?php

session_start();




function saveCar($color, $plate) {
		
		$error = "";
		$database = "if16_StenT_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("INSERT INTO Cars (color, plate) VALUES(?, ?)");
		$stmt->bind_param("ss", $color, $plate);
		
		if ($stmt->execute()) {
			
			echo "salvestamine õnnestus";
		} else {
			
			echo "ERROR".$stmt->error;
		}
		
		
		
		$stmt->close();
		$mysqli->close();
		
}
	
function getAllCars() {
		$database = "if16_StenT_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("
			SELECT id, color, plate
			FROM Cars
		");
		$stmt->bind_result($id, $color, $plate);
		$stmt->execute();
		
		
		//tekitan massiivi
		$result = array();
		//tee seda seni, kuni on rida andmeid
		//mis vastab select lausele.
		while ($stmt->fetch()) {
			
			//tekitan objekti
			$car = new Stdclass();
			
			$car->id = $id;
			$car->plate = $plate;
			$car->color = $color;
			
			//echo $plate."<br>";
			//iga kord massiivi lisatakse numbrimärk
			array_push($result, $car);
			
		}
		
	
		
		$stmt->close();
		$mysqli->close();
		
		return $result;
	}
	
	function cleanInput($input) {
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
	
?>