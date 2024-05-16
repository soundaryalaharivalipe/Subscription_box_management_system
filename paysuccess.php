<script>
document.write("Payment success");
</script>

<?php 
session_start();
$dbhost = 'localhost';   
$dbname='testing'; 
$dbuser = 'root'; 
$dbpass = ''; 

$conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname); 
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}	

if(isset($_SESSION['email']))
{
	$emu= $_SESSION['email'];
	$myDate = date('d/m/Y');
	$total = $_SESSION['dpdftotal'] ;
	
	
	$sql = "INSERT INTO orders(email,dateo,totalprice) VALUES('$emu','$myDate','$total')";
	
	
	if ($conn->query($sql) === TRUE) 
	{
	echo "<br>";
    echo "Thanks for your purchase.Your order details have been recorded";
	echo "<br>";
	}
	else {
	echo "<br>";	
    echo "Error: " . $sql . "<br>" . $conn->error;
		 }
		echo " To download order summary:"; 
		echo '<a style="color:black;" href="pdf.php" target="_blank">Click here</a>';

$conn->close();
	
}


?>