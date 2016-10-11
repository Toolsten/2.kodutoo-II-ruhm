<?php
	require("../../../config.php");
	require("functions.php");
	
	//kui on juba sisse loginud siis suunan data lehele
	if (isset($_SESSION["userId"])) {
		
		//suunan sisselogimise lehele
		header("Location: data.php");
		exit();
		
		
		
	}
	//echo hash("sha512", "Romil");

	//GET ja POSTI muutujad
	//var_dump($_POST);
	//echo "<br>";
	//var_dump ($_GET);
	//IDEEKS ON TEHA VEEBILEHT, KUST SAAB REAALAJAS JÄLGIDA
	//ERINEVATE SPORDIALADE TULEMUSI
	
	//MUUTUJAD
	$signupEmailError= "";
	$signupEmail = "";
	$loginEmailError = "";
	$loginPasswordError = "";
	$signupEmail = "";
	$signupPassword = "";
	$Eesnimi = "";
	$Perenimi = "";
	$aadress = "";
	$loginEmail = "";
	
	
	//$_post["signupEmail"];
	
	if(isset($_POST["signupEmail"])) {
		
		//jah on olemas
		//kas on tühi
		if(empty($_POST["signupEmail"])) {
			
			$signupEmailError="See väli on kohustuslik";
		} else{
			
			$signupEmail = $_POST["signupEmail"];
			
		}
	}
	
	$signupPasswordError= "";
	
	if(isset($_POST["signupPassword"])) {
		
		if(empty($_POST["signupPassword"])) {
			
			$signupPasswordError="Parool on kohustuslik";
			
		}else{
			
			//siia jõuan siis kui parool oli olemas -isset
			//ja parool ei olnud tühi -empty
			//kas parooli pikkus on väiksem kui 8
			if(strlen($_POST["signupPassword"]) <8){
				
				$signupPasswordError="Parool peab olema vähemalt 8 tähemärki pikk!";
				
			}
			
		}
		
	
		
		
		
	}
	
	$eesnimierror= "";
	
   if(isset($_POST["Eesnimi"])) {
		
		
		if(empty($_POST["Eesnimi"])) {
			
			$eesnimierror="See väli on kohustuslik";
		}else{
			
			$Eesnimi = $_POST["Eesnimi"];
			
		}
	}
	
	$Perenimierror= "";
	
	if(isset($_POST["Perenimi"])) {
		
		
		if(empty($_POST["Perenimi"])) {
			
			$Perenimierror="See väli on kohustuslik";
		}else {
			
			$Perenimi = $_POST["Perenimi"];
			
		}
	}
	
	$Aadresserror= "";
	
	if(isset($_POST["aadress"])) {
		
		
		if(empty($_POST["aadress"])) {
			
			$Aadresserror="See väli on kohustuslik";
		}else{
			
			$aadress = $_POST["aadress"];
			
		}
	}
	
	$loginEmailError = "";
	if(isset($_POST["loginEmail"])) {
		
		
		if(empty($_POST["loginEmail"])) {
			
			$loginEmailError="See väli on kohustuslik";
		}else{
			
			$loginEmail = $_POST["loginEmail"];
			
			
		}
	}
	
	$loginPasswordError = "";
	if(isset($_POST["loginPassword"])) {
		
		
		if(empty($_POST["loginPassword"])) {
			
			$loginPasswordError="See väli on kohustuslik";
			
		}
			
	}
	
	// peab olema email ja parool
	// ühtegi errorit
	
		if ( isset($_POST["signupPassword"]) &&
		isset($_POST["signupEmail"]) &&
		$signupEmailError == "" &&
		empty($signupPasswordError)
		
	
		

		) {
		
		//salvestame andmebaasi
		echo "email: ".$signupEmail."<br>";
		
		echo "password: ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "password hashed: ".$password."<br>";
		
		echo ": ".$Eesnimi."<br>";
		echo ": ".$Perenimi."<br>";
		echo ": ".$aadress."<br>";
		
		//echo $serverUsername;
		
		//Ühendus
		
		signup($signupEmail, $password, $Eesnimi, $Perenimi, $aadress);
		
	}
	$error ="";
	if(isset($_POST["loginEmail"]) && isset($_POST["loginPassword"]) &&
	!empty($_POST["loginEmail"]) && !empty($_POST["loginPassword"])
	) {
		$error = login($_POST["loginEmail"], $_POST["loginPassword"]);
		
		
		
	}
	
	

	
	
	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Logi sisse või loo kasutaja</title>
</head>
<body>

	<h1>Logi sisse </h1>
	<form method="POST">
		<p style="color:red;"><?=$error;?> </p>
		
		<br>
		
		<input name="loginEmail" placeholder="email" type="text" value="<?=$loginEmail;?>"><?php echo $loginEmailError; ?>
		<br><br>
		
		<input name="loginPassword" placeholder="parool" type="password"><?php echo $loginPasswordError; ?>
		<br><br>
		
		<input type="submit" value="Logi sisse">
		
	</form>
	
	
	<h1>Loo kasutaja </h1>
	<form method="POST">
		
		
		<input name="signupEmail" placeholder="E-post "type="text" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
		<br><br>
		
		<input name="signupPassword" placeholder="parool" type="password"> <?php echo $signupPasswordError; ?>
		<br><br>
		
		<input name="Eesnimi" placeholder="Sisestage eesnimi" type="text"> <?php echo $eesnimierror; ?>
		<br><br>
		
		<input name="Perenimi" placeholder="Sisestage Perekonnanimi" type="text"> <?php echo $Perenimierror; ?>
		<br><br>
		
		<input name="aadress" placeholder="Sisestage aadress" type="text"> <?=$Aadresserror; ?>
		<br><br>
		
		
		<input type="submit" value="Loo kasutaja">
		

		
	</form>
	
	
	
	
	
</body>
</html>