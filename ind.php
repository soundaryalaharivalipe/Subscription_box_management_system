<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}


?>
<!DOCTYPE html>
<html>
	<head>
	<style>
	body {
 margin : 0;
 padding : 0;
 background-image: url(images/clothes.jpg);
 height : 100%;
 background-repeat: no-repeat;
 background-size: cover;
  }
  
    .container1
{
	text-align : right ;
	margin-right : 100px;
	margin-top : 10px;
} 

.btnt {
	 border : 1px solid #000000;
	 background : none;
	 padding : 20px 20px ;
	 font-size : 20px;
	 color : white;
	 font-family : "montserrat";
	 cursor : pointer ;
	 margin: 10px;
	 
}

.btn1,.btn2 {
	color : #000000; 
}

.btn1::before,.btn2::before{
	top : 0;
	border-radius : 0 0 50% 50%;
}

.btn1:hover::before,.btn2:hover::before{
	height : 180%;
}
  
	</style>
	
	<div class="container1">
<button class="btnt btn1" onclick="window.location.href='home.php'">HOME</button>
<button class="btnt btn2" onclick="window.location.href='cartfin.php'">CART</button>
</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<h1 align="center">CLOTHES</h1><br />
			<?php
				$query = "SELECT * FROM tbl_product where categ=2";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="ind.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

						<input type="hidden" name="quantity" value=1 class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>				
			
		<br />
		
	</body>
		
	
</html>

