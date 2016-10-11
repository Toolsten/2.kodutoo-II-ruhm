<?php
	// functions.php
	
	// see fail peab olema kıigil lehtedel kus
	// tahan kasutada SESSION muutujat
	session_start();

	
	//****** SIGNUP******
	
	function signup($email, $parool, $eesnimi, $perenimi, $aadress) {
		
		$database = "if16_StenT_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("INSERT INTO database1 (email, parool, eesnimi, perenimi, aadress) VALUES (?, ?, ?, ?, ?)");
		
		echo $mysqli->error;
		
		$stmt->bind_param("sssss", $email, $parool, $eesnimi, $perenimi, $aadress);
		
		if ($stmt->execute()) {
			
			echo "salvestamine ınnestus";
		} else {
			
			echo "ERROR".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
	$error = "";
	
	function login ($email, $password) {
		
		$database = "if16_StenT_2";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $database);
		
		$stmt = $mysqli->prepare("SELECT id, email, password, created FROM user_sample WHERE email = ?");
		
		echo $mysqli->error;
		
		//asendan k¸sim‰rgi
		$stmt->bind_param("s", $email);
		
		//m‰‰ran v‰‰rtused muutujatesse
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		
		$stmt->execute();
		
		//andmed tulid andmebaasist vıi mitte
		// on tıene kui tuli v‰hemalt ¸ks vaste
		if($stmt->fetch()) {
			
			//oli sellise meiliga kasutaja
			// password millega proovitakse sisse logida
			$hash = hash("sha512", $password);
			if ($hash == $passwordFromDb) {
				echo"kasutaja logis sisse".$id;
				
				//m‰‰ran sessiooni muutujad, millele saan ligi teistelt lehtedelt
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				$_SESSION["message"] = "<h1> Tere Tulemast!</h1>";
				
				header("Location: data.php");
				exit();
				
				
				}else{
					$error = "Vale parool";
				}
				
				
		}else{
			
			//ei leidnud kasutajat selle meiliga
			$error = "ei ole sellist emaili";
		}
		
		return $error;
		
	};
	

	function cleanInput($input) {
		
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		
		return $input;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*function sum($x, $y) {
		
		return $x + $y;
		
		
	}

	function hello($firstname, $lastname) {
		
		return "Tere tulemast ".$firstname."".$lastname."!";
	}
	
	
	echo sum("Sten","Tool");
	echo "<br>";
	echo hello("Sten", "Tool");
	echo "<br>";
	
	*/
	
	




?>