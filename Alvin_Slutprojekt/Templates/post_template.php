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
	
		<form action="post.php" method="post">
			<p><label for="title">Titel</label>
			<input type="text" id="title" name="title"></p>
			<p><label for="text">Brödtext:</label>
			<textarea rows="5" cols="50" id="text" name="text"></textarea></p>
			<p><input type="submit" value="Lägg upp"></p>
		</form>
		
		<?php
			require "footer.php";
		?>
	</body>
</html>