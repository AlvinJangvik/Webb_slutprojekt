<?php
	require "../Include/connect.php";

	if(isset($_POST["Title"])){
		if($_POST["Title"] != null && $_POST["Text"] != null)
		{
			$Title = filter_input(INPUT_POST, "Title",FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
			$Text = filter_input(INPUT_POST, "Text",FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	
			// Lägger till inlägg
			$sql = "INSERT INTO posts(User, Titel, Text) VALUE (?,?,?)";
			$res = $dbh -> prepare($sql);
			$res -> bind_param("sss", $_SESSION['Username'], $Title, $Text);
			$res -> execute();
			header('Location: index.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="utf-8">
		<title>Posta inlägg</title>
		<link rel="stylesheet" href="css/stilmall.css">
		<link rel="icon" type="image/png" href="bilder/favicon-32x32.png"/>
	</head>
	<body>
		<?php
			require "menu.php";
		?>
		
		<!--Formulär-->
		<form action="post.php" method="post">
			<p><label for="Title">Titel</label>
			<input type="text" id="Title" name="Title"></p>
			<p><label for="Text">Brödtext:</label>
			<textarea rows="5" cols="50" id="Text" name="Text"></textarea></p>
			<p><input type="submit" value="Lägg upp"></p>
		</form>
		
		<?php
			require "footer.php";
		?>
	</body>
</html>