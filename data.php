<?php

	require("functions.php");

	//kui ei ole kasutaja id-d
	if (!isset($_SESSION["userId"])) {
		
		//suunan sisselogimise lehele
		header("Location: login.php");
		exit();
		
		
		
	}
	
	//kui on ?logout aadressireal ss login välja
	if (isset($_GET["logout"])) {
		
		session_destroy();
		header("Location: login.php");
	}
	
	$msg = "";
	if(isset($_SESSION["message"])) {
		
		$msg = $_SESSION["message"];
		
		unset($_SESSION["message"]);
	}
	

?>

<h1>DATA</h1>
<?=$msg;?>
<p>Tere Tulemast <?=$_SESSION["userEmail"];?>!</p>
<a href="?logout=1">Logi välja</a>

