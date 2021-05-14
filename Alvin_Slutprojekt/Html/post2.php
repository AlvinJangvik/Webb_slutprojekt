<?php
	session_start();

	require "../Include/connect.php";

	if($_POST["Title"] != null && $_POST["Text"] != null)
	{
		// Lägger till inlägg
		$sql = "INSERT INTO posts(User, Titel, Text) VALUE (?,?,?)";
		$res = $dbh -> prepare($sql);
		$res -> bind_param("sss", $_SESSION['Username'], $_POST['Title'], $_POST['Text']);
		$res -> execute();
		header('Location: index.php');
	}
	
	else
	{
		header('Location: post.php');
	}

?>