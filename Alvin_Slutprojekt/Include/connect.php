<?php
	$dbh = new mysqli("localhost", "DbUser", "qwe123", "alvin_blogg");
	
	if(!$dbh){
		echo "Ingen kontakt med databasen";
		exit;
	}
?>