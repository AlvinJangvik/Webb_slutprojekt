<?php
	$str = "";
	
	if(isset($_GET['status'])){
		if($_GET['status']==3){
			$str="Felaktig användare";
		}
		elseif($_GET['status']==4){
			$str="Felaktigt lösenord";
		}
		
		// Logga ut
		elseif($_GET['status']==5){
			session_start();
			session_destroy();
			header('Location: login.php');
			exit;
		}
	}
	
	// Logga in
	if(isset($_POST['Username']) && isset($_POST['Password']))
	{
			if(empty($_POST['Username'])||empty($_POST['Password']))
		{
			// ej ifyllda fält
			header("Location:login.php");
		}
	
		require "../Include/connect.php";
	
		// Filtrerar input av säkerhets skäl
		$Username = filter_input(INPUT_POST, 'Username',FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
		$Password = filter_input(INPUT_POST, 'Password',FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	
		$sql = "SELECT Password, Email, Status FROM users WHERE Username=?";
		$res = $dbh->prepare($sql);
		$res->bind_param("s",$Username); // Lägger in variabeln i sql frågan där "?" är
		$res->execute();
	
		$result=$res->get_result();
		$row=$result->fetch_assoc();
	
		if(!$row)
		{
			header("Location:login.php?status=3");
		
		}
		else
		{
			if(password_verify($Password,$row['Password']))
			{
				// echo "Användaren är inloggad"
				session_start();
				$_SESSION['Username']=$Username;
				$_SESSION['Email']=$row['Email'];
				$_SESSION['Status']=$row['Status'];
				header("Location:login.php");
			}
			else
			{
				//echo Felaktigt lösenord
				header("Location:login.php?status=4");
			}
		}
	}
	
	// Ifall man är inloggad
	else if(isset($_SESSION['Status']))
	{
		$str ="<div><p>Välkommen!</p>
		<p>Användarnamn: {$_SESSION['Username']}</p>
		<p>Email: {$_SESSION['Email']}</p>";
		
		// ADMIN
		if($_SESSION['Status'] == 2)
		{
			$str .= "<p>ADMIN KONTO</p>";
		}
		
		$str .= "<a href=\"update.php\">Uppdatera uppgifter</a>
		<a href='login.php?status=5'>Logga ut</a>
		</div>";
	}
	
	// Login form
	else
	{
		$str .= <<<FORM
		<form action="login.php" method="post">
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