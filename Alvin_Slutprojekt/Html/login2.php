<?php
	if(empty($_POST['Username'])||empty($_POST['Password']))
	{
		// ej ifyllda fält
		header("Location:login.php");
	}
	
	require "../Include/connect.php";
	
	$Username = filter_input(INPUT_POST, 'Username',FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	$Password = filter_input(INPUT_POST, 'Password',FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	
	$sql = "SELECT password, status FROM users WHERE Username=?";
	$res = $dbh->prepare($sql);
	$res->bind_param("s",$Username);
	$res->execute();
	
	$result=$res->get_result();
	$row=$result->fetch_assoc();
	
	if(!$row)
	{
		echo "Avändaren finns inte";
		// header("Location:login.php?status=3");
		
	}
	else
	{
		if($row['password']==$password)
		{
			// echo "Användaren är inloggad"
			session_start();
			$_SESSION['Username']=$username;
			$_SESSION['status']=$row['status'];
			header("Location:login.php");
		}
		else
		{
			//echo Felaktigt lösenord
			header("Location:login.php?status=4");
		}
	}
?>