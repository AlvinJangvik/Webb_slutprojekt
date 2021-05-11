<?php
	$str="";
	
		
	if(isset($_GET['Username'])){
		$usr = $_GET['Username'];
		$str = "Användarnamnet $usr är upptaget";
	}
	if(isset($_GET['Email'])){
		$ma = $_GET['Email'];
		$str = "Mail $ma är upptagen";
	}
	
	if(isset($_POST['Username']) && isset($_POST['Email']) && isset($_POST['Password']))
	{
		$username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW);
		$Password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		
		require "../Include/connect.php";
		
		// Kontrollera om användaren redan finns
		$sql = "SELECT * FROM users WHERE Username = ? OR Email = ?";
		$res = $dbh -> prepare($sql);
		$res -> bind_param("ss",$username, $email);
		$res -> execute();
		$result = $res->get_result();
		$row=$result->fetch_assoc();
		if($row !== NULL){
			if($row['Username']=== $username){
				$str = $str." Användaren finns redan";
			}
		
			if($row['Email']=== $email){
				$str = $str." Emailen finns redan";
			}
		}
	
		// Lägg till användaren
		else{
			$Password = password_hash($Password, PASSWORD_DEFAULT);
			$status = 1;
		
			$sql = "INSERT INTO users(Username, Email, Password, Status) VALUE (?,?,?,?)";
			$res = $dbh -> prepare($sql);
			$res -> bind_param("sssi", $username, $email, $Password, $status);
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