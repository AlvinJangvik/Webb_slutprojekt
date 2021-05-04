<?php
	$dbh = new mysqli("localhost", "DbUser", "123qwe", "alvin_blogg");
	
	if(!$dbh){
		echo "Ingen kontakt med databasen";
		exit;
	}
?>