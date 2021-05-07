<?php

	require "../Include/connect.php";

	$sql = "SELECT * FROM users WHERE username=? AND Status=?";
	$res = $dbh->prepare($sql);
	$res->bind_param("si",$username, $status);
	$res->execute();
	$result=$res->get_result();

	$row = $result->fetch_assoc();
	$str = "";
	
	if($_SESSION['status'] == 1)
	{
		$str = "Välkommen ".$username."!";
	}
	
	else
	{
		$str = <<<FORM
		<form action="login2.php" method="post">
			<p><label for="Username">Användarnamn:</label>
			<input type="text" id="Username" name="Username"></p>
			<p><label for="Password">Lössenord:</label>
			<input type="password" id="Password" name="Password"></p>
			<p>
				<a href="createUser.php">
					Skapa användare
				</a>
				<input type="submit" value="Logga in">
			</p>
		</form>
FORM;
	}
?>
<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="utf-8">
		<title>Logga in</title>
		<link rel="stylesheet" href="css/stilmall.css">
		<link rel="icon" type="image/png" href="bilder/favicon-32x32.png"/>
	</head>
	<body>
		<?php
			require "menu.php";
		?>
		
		<?php
			echo $str;
		?>
	
		<?php
			if(isset($_GET['status'])){
				if($_GET['status']==3){
					$str="Felaktig användare";
				}
				elseif($_GET['status']==4){
					$str="Felaktigt lösenord";
				}
			}
			
			require "footer.php";
		?>
	</body>
</html>