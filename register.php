<?php
	$msg = "";
	$x=5;
	
	
	

	if (isset($_POST['submit'])) {
		
		$con =mysqli_connect('localhost', 'root', '', 'testing')  or die("Connect failed: %s\n". $con -> error);
		
		if ($con){
        echo "we are connected";}
	

		//$name = $con->real_escape_string($_POST['name']);
		//$email = $con->real_escape_string($_POST['email']);
		//$password = $con->real_escape_string($_POST['password']);
		//$cPassword = $con->real_escape_string($_POST['cPassword']);
		
		
		$name = $_POST['name'];
		$email =$_POST['email'];
		$password =$_POST['password'];
		$cPassword =$_POST['cPassword'];

		//echo $name;
		
		if ($password != $cPassword)
			$msg = "Please Check Your Passwords!";
		else {
			$hash = password_hash($password, PASSWORD_BCRYPT);
			//echo $hash;
			//$con->query("INSERT INTO users (`name`,`email`,`password`) VALUES ('$name', '$email', '$hash')");
			
			$query = "INSERT INTO users (`name`,`email`,`password`) VALUES ('$name', '$email', '$hash')";
			if (mysqli_query($con, $query))
			{
				echo "New record created successfully";
				
			}
			else
			{				
				die("OOPPS! query failed".mysqli_error($con)); 
			}
			
			// $query = "INSERT INTO howto (do) VALUES ('abc')";
			// if (mysqli_query($con, $query))
			// echo $x;
			// else
			// die("OOPPS! query failed".mysqli_error($con)); 
			
			
			$msg = "You have been registered!";
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Registration</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				

				<?php if ($msg != "") echo $msg . "<br><br>"; ?>

				<form method="post" action="register.php">
					<input class="form-control" minlength="3" name="name" placeholder="Name..."><br>
					<input class="form-control" name="email" type="email" placeholder="Email..."><br>
					<input class="form-control" minlength="5" name="password" type="password" placeholder="Password..."><br>
					<input class="form-control" minlength="5" name="cPassword" type="password" placeholder="Confirm Password..."><br>
					<input class="btn btn-primary" name="submit" type="submit" value="Register..."><br>
				</form>

			</div>
		</div>
	</div>
	<button onclick="window.location.href='home.php'">Home</button>
	<br />
	<button onclick="window.location.href='login.php'">Login</button>
</body>
</html>