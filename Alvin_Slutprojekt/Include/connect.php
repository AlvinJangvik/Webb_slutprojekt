<?php
	$dbh = new mysqli("localhost", "DbUser", "123qwe", "alvins_blogg");
	
	if(!$dbh){
		echo "Ingen kontakt med databasen";
		exit;
	}
?>