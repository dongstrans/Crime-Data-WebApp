<?php

// This php file will check if the user has successfully logged in ot not.

	include("connect.php");
	if(isset($_POST['submit']))
	{
		$username = $_POST['user'];
		$password = $_POST['pass'];

		$sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if($count == 1)
		{
			header("Location:sql_query.php");
		}
		else
		{
			echo '<script>
					window.location.href = "login_page.php";
					alert("Login failed. Invalid username or password")
				</script>';
		}
	}
?>