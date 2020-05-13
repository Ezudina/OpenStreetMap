<?php

	session_start();
	require_once("connection.php");

	if (isset( $_POST['username'] ) && isset( $_POST['password'] ) && strlen( $_POST['username'] ) > 0 && strlen( $_POST['password'] ) > 0 ){
		
		
		$user = $_POST['username'];
		$pass = $_POST['password'];
		
		$conn = new Connection("localhost","root","openstreetmap");
		$conn->connect();
		$query = "SELECT * FROM users WHERE username = '".$user."' AND password = '".$pass."'";
		$result = $conn->execute_query($query);

		if(!$result) die($conn->error);
		

		if ($result->num_rows > 0 ){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			setcookie("username", $row['username'], time() + 24 * 60 * 60,false);
			setcookie("password", $row['password'], time() + 24 * 60 * 60,false);
			$_SESSION["log"] = true;
			header ("Location: openstreetmap.php");
		}
		else{
			echo "<script type='text/javascript'>alert('Incorrect username or password');</script>";

		} 
	}

	if (isset( $_COOKIE['username'] ) && isset( $_COOKIE['password'] ) && strlen( $_COOKIE['username'] ) > 0 && strlen( $_COOKIE['password'] ) > 0 ){
		$user = $_COOKIE['username'];
		$pass = $_COOKIE['password'];
		
		
		$conn = new Connection("localhost","root","openstreetmap");
		$conn->connect();
		$query = "SELECT * FROM users WHERE username = '".$user."' AND password = '".$pass."'";
		$result = $conn->execute_query($query);
		
		if(!$result) die($conn->error);
		
		if($result->num_rows > 0) header ("Location: openstreetmap.php");		
		
		
	}


?>



<!DOCTYPE html>
<html>
<head>
	<title>Login form | OpenStreetMap</title>
	<link rel="icon" href="resources/icon.png">
	<meta charset="UTF-8">
	<meta name="description" content="Login form for OpenStreetMap">
	<meta name="keywords" content="OpenStreetMap">
	<meta name="author" content="Mersiha Komic,Emira Sehic,Ezudina Topalovic,Belmin Muhovic">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body{
			background: linear-gradient(to right bottom, #1cc7d0 ,#013ca6, #013ca6,#1cc7d0);
			height: 773px;
		}
		#login_form{
			height: 350px;
			width: 700px;
			border-radius: 50px;

			/* da bi div bio u centru ekrana */
			position: absolute;
			margin:auto;
			left:0; right:0;
        	top:0; bottom:0;

			display: grid;
	        /* with two columns of same width*/
	        grid-template-columns: 1fr 1fr;
	        
	        padding: 5vh 15px;
	        background: rgba(0, 0, 0, 0.22);

		}
		#form_left{
			display: flex;
	        justify-content: center;
	        align-items: center;
		}

		
		#form_right{
			display: grid;
	        /* single column layout */
	        grid-template-columns: 1fr;
	        /* have some gap in between elements*/
	        grid-gap: 20px;
        	text-align: center;
       
        
		}

		#username, #password {
			font-size: 14px;
			color: #000000;
			padding: 12px 12px 12px 40px;
		    width: 70%;
		    border: none;
		    margin-bottom: 12px;
		    letter-spacing: 1px;
		}
		#btn{
			background: #19b9cc;
			border: none;
			color: #fff;
			width: 86%;
			height: 40px;
			text-transform: uppercase;
			font-size: 15px;
			font-weight: bold;
			
		}

		#btn:hover{
			background:#00e5ff;
			cursor: pointer;
		}

		#title{
			color: #fff;
		    font-size: 28px;
		    font-weight: 500;
		    text-transform: uppercase;
		    letter-spacing: 2px;
		}


	</style>
</head>
<body>
	<div id="login_form">
		<div id="form_left">
			<img src="resources/icon.png" width="256" height="256" alt="openstreetmap icon">
		</div>
		<div id="form_right">
			<h3 id="title"> Login form </h3>
			<form action="" method="POST">
			  	<input type="text" name="username" id="username" placeholder="Username"><br>
			  	<input type="password" name="password" id="password" placeholder="Password" style="margin-bottom: 50px;"><br>
			  	<input type="submit" value="Submit" id="btn">
			</form>
		</div>
	</div>
</body>

</html>


