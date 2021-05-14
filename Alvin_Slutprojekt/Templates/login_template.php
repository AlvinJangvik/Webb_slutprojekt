<?php
	$str = "";
	
	if(isset($_GET['status'])){
		if($_GET['status']==3){
			$str="Felaktig användare";
		}
		elseif($_GET['status']==4){
			$str="Felaktigt lösenord";
		}
	}
	
	// Ifall man är inloggad
	if(isset($_SESSION['Status']))
	{
		$str ="<div><p>Välkommen!</p>
		<p>Användarnamn: {$_SESSION['Username']}</p>
		<p>Email: {$_SESSION['Email']}</p>";
		
		// ADMIN
		if($_SESSION['Status'] == 2)
		{
			$str .= "<p>ADMIN KONTO</p>";
		}
		
		$str .= "<a href=\"update.php\">Uppdater uppgifter</a>
		<a href=\"Logout.php\">Logga ut</a>
		</div>";
	}
	
	// Login form
	else
	{
		$str .= <<<FORM
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
			
			require "footer.php";
		?>
	</body>
</html>