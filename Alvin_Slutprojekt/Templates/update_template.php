<?php
	$str="";
	
	if(isset($_GET['Email'])){
		$ma = $_GET['Email'];
		$str = "Mail $ma är upptagen";
	}
	
	if(isset($_POST['Email']) or isset($_POST['Password']))
	{
		$email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW);
		$Password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		
		require "../Include/connect.php";
		
		
		
		// Byt lössenord
		if($_POST['Password'] != ""){
			$Password = password_hash($Password, PASSWORD_DEFAULT);
			
			$sql = "UPDATE users SET Password = ? WHERE Username = ?";
			$res = $dbh -> prepare($sql);
			$res -> bind_param("ss", $Password, $_SESSION['Username']);
			$res -> execute();
			
			$str .= "<p>Lössenord uppdaterat</p>";
		}
		
		//Byt email
		if($_SESSION['Email']=== $email){
			$str = $str."Samma email";
		}
		else if($_POST['Email'] != ""){
			$sql = "UPDATE users SET Email = ? WHERE Username = ?";
			$res = $dbh -> prepare($sql);
			$res -> bind_param("ss", $email, $_SESSION['Username']);
			$res -> execute();
			
			$_SESSION['Email'] = $email;
			
			$str .= "<p>Email uppdaterat</p>";
		}
	}
	
	else{
		echo $str;
		$str .=<<<FORM
			<form action="{$_SERVER['PHP_SELF']}" method="post">
				<p><label for="Email">Email:</label>
				<input type="email" id="Email" name="Email"></p>
				<p><label for="Password">Lössenord:</label>
				<input type="password" id="Password" name="Password"></p>
				<p><input type="submit" value="Uppdatera"></p>
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