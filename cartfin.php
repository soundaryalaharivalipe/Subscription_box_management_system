<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");


if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="cartfin.php"</script>';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
<h3>Order Details</h3>
<body>
			<div style="clear:both"></div>
			<br />
			<div class="table-responsive">
				
					<TABLE BORDER=10 BORDERCOLOR=BLACK>
					<tr>
						<th width="10%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="10%">Price</th>
						<th width="10%">Total</th>
						<th width="10%">Action</th>
					</tr>
					<?php
						
					global $pdfarray;
					$pdfarray=array();
					
					$_SESSION['dpdfarray'] = array();
					

					
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
							
							
							array_push($_SESSION['dpdfarray'],$values["item_name"]);
							
			
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="cartfin.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
							$_SESSION['dpdftotal'] = $total;
					
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					
					
					
					?>
						
				</table>
				<div id="paypal-button"></div>
				


<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
var num = <?php echo $total ?>;
var success=0;

  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'demo_sandbox_client_id',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: num,
            currency: 'USD'
          }
        }]
		
      });
    },
	
	 redirect_urls :
  {
    return_url : "http://www.google.com",
	cancel_url : "http://youreturnurl.com/canceled"
  }, 
  
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
		//success=1;
		//document.write("Payment success");
		//for(var i=0;i<10000000;i++);
		//await sleep(2000);
		window.location.href = "paysuccess.php";
        //window.alert('Thank you for your purchase!')
		
      });
    }
  }, '#paypal-button');
  
  //if(success == 1)
	  //document.write(success);
  
   /* onAuthorize: function (data, actions) {
    // Get the payment details
    return actions.payment.get()
      .then(function (paymentDetails) {
		  
		   window.alert('Compra realizada con éxito. Recibirá más detalles por email!');
	       
		// Show a confirmation using the details from paymentDetails
        // Then listen for a click on your confirm button
        
		document.querySelector('#confirm-button')
          .addEventListener('click', function () {
            // Execute the payment
			 
            return actions.payment.execute()
              .then(function () {
				 
			
				
              });
          });
      });
  }
}, '#paypal-button');
 */
</script>

				</div>
				</div>
				</div>
				</body>
				</html>