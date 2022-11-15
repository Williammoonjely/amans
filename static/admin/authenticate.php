<?php 
	require 'config/db.php';
	session_start();
	$username = "";
	$password = "";
	if(isset($_POST['email']))
	{
		$username = $_POST['email'];
	}
	if (isset($_POST['password']))
	{
		$password = sha1($_POST['password']);
	}
	$q = 'SELECT * FROM tbl_users WHERE user_email=:email AND user_password=:password';
		$query = $db->prepare($q);
		$query->execute(array(':email' => $username, ':password' => $password));
	if($query->rowCount() == 0)
	{
		header('Location: login.php?err=1');
	}
	else
	{
	$row = $query->fetch(PDO::FETCH_ASSOC);
	session_regenerate_id();
		$_SESSION['afadminuser_id'] 		= $row['user_id'];
		$_SESSION['afadminuser_username'] 	= $row['user_email'];
		$_SESSION['afadminuser_role'] 		= $row['user_role'];
	ob_start();
		echo $_SESSION['afadminuser_role'];
	ob_end_clean();
	session_write_close();
	if( $_SESSION['afadminuser_role'] == "admin")
	{
		header('Location: index.php');
	}
	else
	{
		header('Location: error.php');
	}
 }
?>