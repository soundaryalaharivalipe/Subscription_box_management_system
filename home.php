

<!DOCTYPE html>

<head>
<div class="container1">
<button class="btnt btn1" onclick="window.location.href='about.php'">About</button>
<button class="btnt btn2" onclick="window.location.href='cartfin.php'">Cart</button>
<?php
session_start();

if(isset($_SESSION['email']))
{
	echo "<p><font color=white> You are logged in</font> </p>" ;
	
	echo '<a style="color:white;" href="logout.php">LOGOUT</a>';
	
}
else
{				echo '<br>';
				echo '<a style="color:white;" href="register.php">REGISTER</a>';
				echo '<br><br>';
				echo '<a style="color:white;" href="login.php">LOGIN</a>';
		
}		  
?>
</div>

<h1 style="color:white;text-align:center;"> SUBSCRIPTION BOX </h1>
<!-- <link rel="stylesheet" href="css/stylesh.css"> -->
<link rel="stylesheet" href="css/stylesh1.css"> 
</head> 

<div class="container">
<button class="btn btn1" onclick="window.location.href='index.php'">GADGETS</button>
<button class="btn btn2" onclick="window.location.href='ind.php'">CLOTHES</button>
<button class="btn btn1" onclick="window.location.href='i.php'">SKINCARE</button>
<button class="btn btn2" onclick="window.location.href='int.php'">JEWELLERY</button>
</div>

</html>


