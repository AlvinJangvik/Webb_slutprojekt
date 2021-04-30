<?php
	$str="";
	
	if(isset($_GET['name'])){
		$usr = $_GET['name'];
		$str = "Användarnamnet $usr är upptaget";
	}
	if(isset($_GET['mail'])){
		$ma = $_GET['mail'];
		$str = "Mail $ma är upptagen";
	}
	
	if(isset($_POST['username']) && isset($_POST['Email']) && isset($_POST['Password'])){
		$username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$mail = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW);
		$password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

		require "../Include/connect.php";
	
		// Kontrollera om användaren redan finns
		$sql = "SELECT * FROM users WHERE Username = ? OR Email = ?";
		$res = $dbh -> prepare($sql);
		$res -> bind_param("ss",$Username, $Email);
		$res -> execute();
		$result = $res->get_result();
		$row=$result->fetch_assoc();
	
		if($row !== NULL){
			if($row['Username']=== $Username){
				echo "Användaren finns redan";
			}
		
			if($row['Email']=== $Email){
				echo "Emailen finns redan";
			}
		}
	
		else{
			$status = 1;
		
			$sql = "INSERT INTO users(Username, Email, Password, Status) VALUE (?,?,?,?)";
			$res = $dbh -> prepare($sql);
			$res -> bind_param("sssi", $Username, $Email, $Password, $Status);
			$res -> execute();
		
			$str = "Användare Tillagd";
		}
	}
	
	else{
		echo $str;
		$str .=<<<FORM
			<form action="{$_SERVER['PHP_SELF']}" method="post">
				<p><label for="Username">Användarnamn:</label>
				<input type="text" id="Username" name="Username"></p>
				<p><label for="Email">Email:</label>
				<input type="email" id="Email" name="Email"></p>
				<p><label for="Password">Lössenord:</label>
				<input type="password" id="Password" name="Password"></p>
				<p><input type="submit" value="Skapa användare"></p>
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
			echo $str;
			require "footer.php";
		?>
	</body>
</html>