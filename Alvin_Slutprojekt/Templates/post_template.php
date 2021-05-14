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
		<form action="post2.php" method="post">
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