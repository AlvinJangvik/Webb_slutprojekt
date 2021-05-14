<?php
	$post_button = "";
	$login_button = "";
	if(isset($_SESSION['Status']))
	{
		$post_button = "<a href='post.php'>Skriv inlägg</a>";
		$login_button = "Info";
	}
	else
	{
		$login_button = "Logga in";
	}
?>
<nav>
	<a href="index.php">Start</a>
	<?php  
		echo $post_button;
		echo "<a href='login.php'>$login_button</a>";
	?>
</nav>